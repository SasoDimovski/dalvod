<?php

namespace Modules\GroundWires\Services;


use App\Models\GroundWires;
use App\Services\Responses\ResponseError;
use App\Services\Responses\ResponseSuccess;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Modules\GroundWires\Dto\GroundWiresDto;
use Modules\GroundWires\Repositories\GroundWiresRepositories;

class GroundWiresServices
{
    protected ?string $classPath;
    public function __construct(public GroundWiresRepositories $groundwiresRepositories)
    {
        $this->classPath = __DIR__ . 'GroundWiresServices.php/' . class_basename(__CLASS__) . '.php';
    }

    public function index($params): array
    {
        $groundwires = $this->groundwiresRepositories->getAllGroundWires($params);
        return ['data' => [
            'groundwires' => $groundwires,
        ]];
    }

    public function show($id): array
    {

        $groundwire = $this->groundwiresRepositories->getGroundWireById($id);
        return ['data' => [
            'groundwire' => $groundwire,
        ]];

    }

    public function edit($id): array
    {
        $groundwire = $this->groundwiresRepositories->getGroundWireById($id);
        return ['data' => [
            'groundwire' => $groundwire,
        ]];

    }

    public function store(GroundWiresDto $groundwiresDto): ResponseError|ResponseSuccess
    {
        $methodName = 'store(GroundWiresDto $groundwiresDto)';
        $path = 'groundwires/';

        //CREATE PICTURE NAME
        $picture_name = '';
        if (!empty($groundwiresDto->picture)) {
            $extension = strtolower($groundwiresDto->picture->getClientOriginalExtension());
            $picture_name = date('Ymd_His') . '_'.Str::random(3) .'.'. $extension;
            //dd($picture_name);
        }

        // STORE INSULATOR
        $groundwire = $this->groundwiresRepositories->storeGroundWire($groundwiresDto,$picture_name);
        if (!$groundwire) {
            //__('global.store_error')
            return new ResponseError($methodName,  $this->classPath, ['id_error'=>'1']);
        }

        // STORE PICTURE
        if ($groundwire && !empty($groundwiresDto->picture)) {
            Storage::disk('publish')->makeDirectory($path . $groundwire->id, 0777, true);
            $image = ImageManager::imagick()->read($groundwiresDto->picture);
            $image_tn = ImageManager::imagick()->read($groundwiresDto->picture);
            $width = $image->width();
            if (($width > 1200)) {
                $image->scaleDown(width: 1200);
            }
            $image_tn = $image_tn->scaleDown(width: 300);
            $image_tn->save(Storage::disk('publish')->path($path . $groundwire->id . '/tn_' . $picture_name));
            $image->save(Storage::disk('publish')->path($path . $groundwire->id . '/' . $picture_name));
        }



        return new ResponseSuccess($methodName, $this->classPath,['id'=>$groundwire->id]);
    }

    public function create(): array
    {
        $groundwire = new GroundWires();

        return ['data' => [
            'groundwire' => $groundwire,
        ]];
    }


    public function update(?String $file_name_hidden, GroundWiresDto $groundwiresDto): ResponseSuccess|ResponseError
    {
        $methodName = 'update(GroundWiresDto $groundwiresDto)';
        $id = $groundwiresDto->id;


        $picture_name = '';
        $path = 'groundwires/';

        // CHECK IF RECORD EXIST ///////////////////////////////////////////////
        $isGroundWire = $this->groundwiresRepositories->getGroundWireById($id);
        if (!$isGroundWire) {
            // __('groundwires.groundwiresController.error_groundwire_not_exis')
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'1']);
        }

//dd($groundwiresDto->picture);
        if (!empty($groundwiresDto->picture) && !empty($file_name_hidden)) {

            /*get old picture name ------------------------------------------------------------------------------------------*/
            $groundwire = $this->groundwiresRepositories->getGroundWireById($id);
            $picture_name_old = (!empty($groundwiresDto->picture) ) ? $groundwire->picture : '';
            /*end get old picture name ------------------------------------------------------------------------------------------*/
            /*create picture name ------------------------------------------------------------------------------------------*/
            $extension = strtolower($groundwiresDto->picture->getClientOriginalExtension());
            $picture_name = date('Ymd_His') . '_' . Str::random(8) . '.' . $extension;
            //dd($picture_name);
            /*end create picture name ------------------------------------------------------------------------------------------*/
            Storage::disk('publish')->makeDirectory($path.$groundwire->id, 0777, true);
            $groundwireDirectory = $path . $groundwire->id;
            $filesToDelete = [$picture_name_old, 'tn_'.$picture_name_old,]; // Имена на фајловите за бришење
            //dd($filesToDelete);
            foreach ($filesToDelete as $file) {
                if (Storage::disk('publish')->exists($groundwireDirectory . '/' .$file )) {
                    Storage::disk('publish')->delete($groundwireDirectory . '/' .$file );
                }
            }
            $image = ImageManager::imagick()->read($groundwiresDto->picture);
            $image_tn = ImageManager::imagick()->read($groundwiresDto->picture);
            $width = $image->width();
            if (($width > 1200)) {
                $image->scaleDown(width: 1200);
            }
            $image_tn = $image_tn->scaleDown(width: 300);
            $image_tn->save(Storage::disk('publish')->path($path . $groundwire->id . '/tn_' . $picture_name));
            $image->save(Storage::disk('publish')->path($path . $groundwire->id . '/' . $picture_name));
        }

        if (empty($groundwiresDto->picture) && empty($file_name_hidden)) {
            $picture_name = '';
            /*get old picture name ------------------------------------------------------------------------------------------*/
            $groundwire = $this->groundwiresRepositories->getGroundWireById($id);
            $picture_name_old = $groundwire->picture;
            /*end get old picture name ------------------------------------------------------------------------------------------*/
            $groundwireDirectory = $path . $groundwire->id;
            $filesToDelete = [$picture_name_old, 'tn_'.$picture_name_old,]; // Имена на фајловите за бришење
            foreach ($filesToDelete as $file) {
                if (Storage::disk('publish')->exists($groundwireDirectory . '/' .$file )) {
                    Storage::disk('publish')->delete($groundwireDirectory . '/' .$file );
                }
            }
        }

        if (empty($groundwiresDto->picture) && !empty($file_name_hidden)) {
            $picture_name = $file_name_hidden;
        }


        // UPDATE RECORD
        $groundwire = $this->groundwiresRepositories->updateGroundWire($id, $groundwiresDto, $picture_name);
        if (!$groundwire) {
            //__('global.update_error')
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'2']);
        }

        return new ResponseSuccess($methodName, $this->classPath,[]);
    }

    public function delete($id): ResponseSuccess|ResponseError
    {
        $methodName = 'delete($id)';
        $isUsed= $this->groundwiresRepositories->isUsed($id);
        if ($isUsed) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'2']);
        }

        $return= $this->groundwiresRepositories->delete($id);
        if (!$return) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'1']);
        }
        return new ResponseSuccess($methodName, $this->classPath,[]);
    }



}
