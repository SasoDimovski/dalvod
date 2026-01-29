<?php

namespace Modules\Conductors\Services;


use App\Models\Conductors;
use App\Services\Responses\ResponseError;
use App\Services\Responses\ResponseSuccess;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Modules\Conductors\Dto\ConductorsDto;
use Modules\Conductors\Repositories\ConductorsRepositories;

class ConductorsServices
{
    protected ?string $classPath;
    public function __construct(public ConductorsRepositories $conductorsRepositories)
    {
        $this->classPath = __DIR__ . 'ConductorsServices.php/' . class_basename(__CLASS__) . '.php';
    }

    public function index($params): array
    {
        $conductors = $this->conductorsRepositories->getAllConductors($params);
        return ['data' => [
            'conductors' => $conductors,
        ]];
    }

    public function show($id): array
    {

        $conductor = $this->conductorsRepositories->getConductorById($id);
        return ['data' => [
            'conductor' => $conductor,
        ]];

    }

    public function edit($id): array
    {
        $conductor = $this->conductorsRepositories->getConductorById($id);
        return ['data' => [
            'conductor' => $conductor,
        ]];

    }

    public function store(ConductorsDto $conductorsDto): ResponseError|ResponseSuccess
    {
        $methodName = 'store(ConductorsDto $conductorsDto)';
        $path = 'conductors/';

        //CREATE PICTURE NAME
        $picture_name = '';
        if (!empty($conductorsDto->picture)) {
            $extension = strtolower($conductorsDto->picture->getClientOriginalExtension());
            $picture_name = date('Ymd_His') . '_'.Str::random(3) .'.'. $extension;
        }

        // STORE INSULATOR
        $conductor = $this->conductorsRepositories->storeConductor($conductorsDto,$picture_name);
        if (!$conductor) {
            //__('global.store_error')
            return new ResponseError($methodName,  $this->classPath, ['id_error'=>'1']);
        }

        // STORE PICTURE
        if ($conductor && !empty($conductorsDto->picture)) {
            Storage::disk('publish')->makeDirectory($path . $conductor->id, 0777, true);
            $image = ImageManager::imagick()->read($conductorsDto->picture);
            $image_tn = ImageManager::imagick()->read($conductorsDto->picture);
            $width = $image->width();
            if (($width > 1200)) {
                $image->scaleDown(width: 1200);
            }
            $image_tn = $image_tn->scaleDown(width: 300);
            $image_tn->save(Storage::disk('publish')->path($path . $conductor->id . '/tn_' . $picture_name));
            $image->save(Storage::disk('publish')->path($path . $conductor->id . '/' . $picture_name));
        }



        return new ResponseSuccess($methodName, $this->classPath,['id'=>$conductor->id]);
    }

    public function create(): array
    {
        $conductor = new Conductors();

        return ['data' => [
            'conductor' => $conductor,
        ]];
    }


    public function update(?String $file_name_hidden, ConductorsDto $conductorsDto): ResponseSuccess|ResponseError
    {
        $methodName = 'update(ConductorsDto $conductorsDto)';
        $id = $conductorsDto->id;


        $picture_name = '';
        $path = 'conductors/';

        // CHECK IF RECORD EXIST ///////////////////////////////////////////////
        $isConductor = $this->conductorsRepositories->getConductorById($id);
        if (!$isConductor) {
            // __('conductors.conductorsController.error_conductor_not_exis')
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'1']);
        }

//dd($conductorsDto->picture);
        if (!empty($conductorsDto->picture) && !empty($file_name_hidden)) {

            /*get old picture name ------------------------------------------------------------------------------------------*/
            $conductor = $this->conductorsRepositories->getConductorById($id);
            $picture_name_old = (!empty($conductorsDto->picture) ) ? $conductor->picture : '';
            /*end get old picture name ------------------------------------------------------------------------------------------*/
            /*create picture name ------------------------------------------------------------------------------------------*/
            $extension = strtolower($conductorsDto->picture->getClientOriginalExtension());
            $picture_name = date('Ymd_His') . '_' . Str::random(8) . '.' . $extension;
            //dd($picture_name);
            /*end create picture name ------------------------------------------------------------------------------------------*/
            Storage::disk('publish')->makeDirectory($path.$conductor->id, 0777, true);
            $conductorDirectory = $path . $conductor->id;
            $filesToDelete = [$picture_name_old, 'tn_'.$picture_name_old,]; // Имена на фајловите за бришење
            //dd($filesToDelete);
            foreach ($filesToDelete as $file) {
                if (Storage::disk('publish')->exists($conductorDirectory . '/' .$file )) {
                    Storage::disk('publish')->delete($conductorDirectory . '/' .$file );
                }
            }
            $image = ImageManager::imagick()->read($conductorsDto->picture);
            $image_tn = ImageManager::imagick()->read($conductorsDto->picture);
            $width = $image->width();
            if (($width > 1200)) {
                $image->scaleDown(width: 1200);
            }
            $image_tn = $image_tn->scaleDown(width: 300);
            $image_tn->save(Storage::disk('publish')->path($path . $conductor->id . '/tn_' . $picture_name));
            $image->save(Storage::disk('publish')->path($path . $conductor->id . '/' . $picture_name));
        }

        if (empty($conductorsDto->picture) && empty($file_name_hidden)) {
            $picture_name = '';
            /*get old picture name ------------------------------------------------------------------------------------------*/
            $conductor = $this->conductorsRepositories->getConductorById($id);
            $picture_name_old = $conductor->picture;
            /*end get old picture name ------------------------------------------------------------------------------------------*/
            $conductorDirectory = $path . $conductor->id;
            $filesToDelete = [$picture_name_old, 'tn_'.$picture_name_old,]; // Имена на фајловите за бришење
            foreach ($filesToDelete as $file) {
                if (Storage::disk('publish')->exists($conductorDirectory . '/' .$file )) {
                    Storage::disk('publish')->delete($conductorDirectory . '/' .$file );
                }
            }
        }

        if (empty($conductorsDto->picture) && !empty($file_name_hidden)) {
            $picture_name = $file_name_hidden;
        }


        // UPDATE RECORD
        $conductor = $this->conductorsRepositories->updateConductor($id, $conductorsDto, $picture_name);
        if (!$conductor) {
            //__('global.update_error')
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'2']);
        }

        return new ResponseSuccess($methodName, $this->classPath,[]);
    }

    public function delete($id): ResponseSuccess|ResponseError
    {
        $methodName = 'delete($id)';
        $isUsed= $this->conductorsRepositories->isUsed($id);
        if ($isUsed) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'2']);
        }

        $return= $this->conductorsRepositories->delete($id);
        if (!$return) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'1']);
        }
        return new ResponseSuccess($methodName, $this->classPath,[]);
    }



}
