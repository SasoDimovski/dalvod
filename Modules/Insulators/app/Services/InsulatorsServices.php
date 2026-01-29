<?php

namespace Modules\Insulators\Services;


use App\Models\Insulators;
use App\Models\Towers;
use App\Services\Responses\ResponseError;
use App\Services\Responses\ResponseSuccess;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Modules\Insulators\Dto\InsulatorsDto;
use Modules\Insulators\Repositories\InsulatorsRepositories;

class InsulatorsServices
{
    protected ?string $classPath;
    public function __construct(public InsulatorsRepositories $insulatorsRepositories)
    {
        $this->classPath = __DIR__ . 'InsulatorsServices.php/' . class_basename(__CLASS__) . '.php';
    }

    public function index($params): array
    {
        $insulators = $this->insulatorsRepositories->getAllInsulators($params);
        $voltages = $this->insulatorsRepositories->getAllVoltages();
        $insulator_chain = $this->insulatorsRepositories->getAllInsulatorChain();
        return ['data' => [
            'insulators' => $insulators,
            'voltages' => $voltages,
            'insulator_chain' => $insulator_chain,
        ]];
    }

    public function show($id): array
    {

        $insulator = $this->insulatorsRepositories->getInsulatorById($id);
        //dd($insulator);
        $voltages = $this->insulatorsRepositories->getAllVoltages();
        return ['data' => [
            'insulator' => $insulator,
            'voltages' => $voltages,
        ]];

    }

    public function edit($id): array
    {

        $insulator = $this->insulatorsRepositories->getInsulatorById($id);
        $voltages = $this->insulatorsRepositories->getAllVoltages();
        $insulator_chain = $this->insulatorsRepositories->getAllInsulatorChains();

        return ['data' => [
            'insulator' => $insulator,
            'voltages' => $voltages,
            'insulator_chain' => $insulator_chain,
        ]];

    }

    public function store(InsulatorsDto $insulatorsDto): ResponseError|ResponseSuccess
    {
        $methodName = 'store(InsulatorsDto $insulatorsDto)';
        $path = 'insulators/';

        //CREATE PICTURE NAME
        $picture_name = '';
        if (!empty($insulatorsDto->picture)) {
            $extension = strtolower($insulatorsDto->picture->getClientOriginalExtension());
            $picture_name = date('Ymd_His') . '_'.Str::random(3) .'.'. $extension;
        }

        // STORE INSULATOR
        $insulator = $this->insulatorsRepositories->storeInsulator($insulatorsDto,$picture_name);
        if (!$insulator) {
            //__('global.store_error')
            return new ResponseError($methodName,  $this->classPath, ['id_error'=>'1']);
        }

        // STORE PICTURE
        if ($insulator && !empty($insulatorsDto->picture)) {
            Storage::disk('publish')->makeDirectory($path . $insulator->id, 0777, true);
            $image = ImageManager::imagick()->read($insulatorsDto->picture);
            $image_tn = ImageManager::imagick()->read($insulatorsDto->picture);
            $width = $image->width();
            if (($width > 1200)) {
                $image->scaleDown(width: 1200);
            }
            $image_tn = $image_tn->scaleDown(width: 300);
            $image_tn->save(Storage::disk('publish')->path($path . $insulator->id . '/tn_' . $picture_name));
            $image->save(Storage::disk('publish')->path($path . $insulator->id . '/' . $picture_name));
        }



        return new ResponseSuccess($methodName, $this->classPath,['id'=>$insulator->id]);
    }

    public function create(): array
    {
        $insulator = new Insulators();
        $voltages = $this->insulatorsRepositories->getAllVoltages();
        $insulator_chain = $this->insulatorsRepositories->getAllInsulatorChains();
        return ['data' => [
            'insulator' => $insulator,
            'voltages' => $voltages,
            'insulator_chain' => $insulator_chain,
        ]];
    }


    public function update(?String $file_name_hidden, InsulatorsDto $insulatorsDto): ResponseSuccess|ResponseError
    {
        $methodName = 'update(InsulatorsDto $insulatorsDto)';
        $id = $insulatorsDto->id;


        $picture_name = '';
        $path = 'insulators/';

        // CHECK IF RECORD EXIST ///////////////////////////////////////////////
        $isInsulator = $this->insulatorsRepositories->getInsulatorById($id);
        if (!$isInsulator) {
            // __('insulators.insulatorsController.error_insulator_not_exis')
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'1']);
        }

//dd($insulatorsDto->picture);
        if (!empty($insulatorsDto->picture) && !empty($file_name_hidden)) {

            /*get old picture name ------------------------------------------------------------------------------------------*/
            $insulator = $this->insulatorsRepositories->getInsulatorById($id);
            $picture_name_old = (!empty($insulatorsDto->picture) ) ? $insulator->picture : '';
            /*end get old picture name ------------------------------------------------------------------------------------------*/
            /*create picture name ------------------------------------------------------------------------------------------*/
            $extension = strtolower($insulatorsDto->picture->getClientOriginalExtension());
            $picture_name = date('Ymd_His') . '_' . Str::random(8) . '.' . $extension;
            //dd($picture_name);
            /*end create picture name ------------------------------------------------------------------------------------------*/
            Storage::disk('publish')->makeDirectory($path.$insulator->id, 0777, true);
            $insulatorDirectory = $path . $insulator->id;
            $filesToDelete = [$picture_name_old, 'tn_'.$picture_name_old,]; // Имена на фајловите за бришење
            //dd($filesToDelete);
            foreach ($filesToDelete as $file) {
                if (Storage::disk('publish')->exists($insulatorDirectory . '/' .$file )) {
                    Storage::disk('publish')->delete($insulatorDirectory . '/' .$file );
                }
            }
            $image = ImageManager::imagick()->read($insulatorsDto->picture);
            $image_tn = ImageManager::imagick()->read($insulatorsDto->picture);
            $width = $image->width();
            if (($width > 1200)) {
                $image->scaleDown(width: 1200);
            }
            $image_tn = $image_tn->scaleDown(width: 300);
            $image_tn->save(Storage::disk('publish')->path($path . $insulator->id . '/tn_' . $picture_name));
            $image->save(Storage::disk('publish')->path($path . $insulator->id . '/' . $picture_name));
        }

        if (empty($insulatorsDto->picture) && empty($file_name_hidden)) {
            $picture_name = '';
            /*get old picture name ------------------------------------------------------------------------------------------*/
            $insulator = $this->insulatorsRepositories->getInsulatorById($id);
            $picture_name_old = $insulator->picture;
            /*end get old picture name ------------------------------------------------------------------------------------------*/
            $insulatorDirectory = $path . $insulator->id;
            $filesToDelete = [$picture_name_old, 'tn_'.$picture_name_old,]; // Имена на фајловите за бришење
            foreach ($filesToDelete as $file) {
                if (Storage::disk('publish')->exists($insulatorDirectory . '/' .$file )) {
                    Storage::disk('publish')->delete($insulatorDirectory . '/' .$file );
                }
            }
        }

        if (empty($insulatorsDto->picture) && !empty($file_name_hidden)) {
            $picture_name = $file_name_hidden;
        }


        // UPDATE RECORD
        $insulator = $this->insulatorsRepositories->updateInsulator($id, $insulatorsDto, $picture_name);
        if (!$insulator) {
            //__('global.update_error')
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'2']);
        }

        return new ResponseSuccess($methodName, $this->classPath,[]);
    }

    public function delete($id): ResponseSuccess|ResponseError
    {
        $methodName = 'delete($id)';
        $isUsed= $this->insulatorsRepositories->isUsed($id);
        if ($isUsed) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'2']);
        }

        $return= $this->insulatorsRepositories->delete($id);
        if (!$return) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'1']);
        }
        return new ResponseSuccess($methodName, $this->classPath,[]);
    }



}
