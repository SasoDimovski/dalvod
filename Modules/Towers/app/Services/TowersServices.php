<?php

namespace Modules\Towers\Services;


use App\Models\Towers;
use App\Services\Responses\ResponseError;
use App\Services\Responses\ResponseSuccess;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Modules\Towers\Dto\TowersDto;
use Modules\Towers\Repositories\TowersRepositories;

class TowersServices
{
    protected ?string $classPath;
    public function __construct(public towersRepositories $towersRepositories)
    {
        $this->classPath = __DIR__ . '/' . class_basename(__CLASS__) . '.php';
    }

    public function index($params): array
    {
        $towers = $this->towersRepositories->getAllTowers($params);
        $voltages = $this->towersRepositories->getAllVoltages();
        return ['data' => [
            'towers' => $towers,
            'voltages' => $voltages,
        ]];
    }

    public function show($id): array
    {

        $tower = $this->towersRepositories->getTowerById($id);
        //dd($tower);
        $voltages = $this->towersRepositories->getAllVoltages();
        return ['data' => [
            'tower' => $tower,
            'voltages' => $voltages,
        ]];

    }

    public function edit($id): array
    {

        $tower = $this->towersRepositories->getTowerById($id);
        $voltages = $this->towersRepositories->getAllVoltages();
        return ['data' => [
            'tower' => $tower,
            'voltages' => $voltages,
        ]];

    }

    public function store(TowersDto $towersDto): ResponseError|ResponseSuccess
    {
        $methodName = 'store(TowersDto $TowersDto)';
        $path = 'towers/';

        //CREATE PICTURE NAME
        $picture_name = '';
        if (!empty($towersDto->picture)) {
            $extension = strtolower($towersDto->picture->getClientOriginalExtension());
            $picture_name = date('Ymd_His') . '_'.Str::random(3) .'.'. $extension;
        }

        // STORE TOWER
        $tower = $this->towersRepositories->storeTower($towersDto,$picture_name);
        if (!$tower) {
            //__('global.store_error')
            return new ResponseError($methodName,  $this->classPath, ['id_error'=>'1']);
        }

        // STORE PICTURE
        if ($tower && !empty($towersDto->picture)) {
            Storage::disk('publish')->makeDirectory($path . $tower->id, 0777, true);
            $image = ImageManager::imagick()->read($towersDto->picture);
            $image_tn = ImageManager::imagick()->read($towersDto->picture);
            $width = $image->width();
            if (($width > 1200)) {
                $image->scaleDown(width: 1200);
            }
            $image_tn = $image_tn->scaleDown(width: 300);
            $image_tn->save(Storage::disk('publish')->path($path . $tower->id . '/tn_' . $picture_name));
            $image->save(Storage::disk('publish')->path($path . $tower->id . '/' . $picture_name));
        }
        //dd($tower);
        return new ResponseSuccess($methodName, $this->classPath,['id'=>$tower->id]);
    }

    public function create(): array
    {
        $tower = new Towers();
        $voltages = $this->towersRepositories->getAllVoltages();
        return ['data' => [
            'tower' => $tower,
            'voltages' => $voltages,
        ]];
    }


    public function update(?String $file_name_hidden,TowersDto $towersDto): ResponseSuccess|ResponseError
    {
        $methodName = 'update(TowersDto $towersDto)';
        $id = $towersDto->id;

        $picture_name = '';
        $path = 'towers/';

        // CHECK IF RECORD EXIST ///////////////////////////////////////////////
        $isTower = $this->towersRepositories->getTowerById($id);
        if (!$isTower) {
            // __('towers.towersController.error_tower_not_exis')
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'1']);
        }

        if (!empty($towersDto->picture) && !empty($file_name_hidden)) {

            /*get old picture name ------------------------------------------------------------------------------------------*/
            $tower = $this->towersRepositories->getTowerById($id);
            $picture_name_old = (!empty($towersDto->picture) ) ? $tower->picture : '';
            /*end get old picture name ------------------------------------------------------------------------------------------*/
            /*create picture name ------------------------------------------------------------------------------------------*/
            $extension = strtolower($towersDto->picture->getClientOriginalExtension());
            $picture_name = date('Ymd_His') . '_' . Str::random(8) . '.' . $extension;
            /*end create picture name ------------------------------------------------------------------------------------------*/
            Storage::disk('publish')->makeDirectory($path.$tower->id, 0777, true);
            $towerDirectory = $path . $tower->id;
            $filesToDelete = [$picture_name_old, 'tn_'.$picture_name_old,]; // Имена на фајловите за бришење
            foreach ($filesToDelete as $file) {
                if (Storage::disk('publish')->exists($towerDirectory . '/' .$file )) {
                    Storage::disk('publish')->delete($towerDirectory . '/' .$file );
                }
            }
            $image = ImageManager::imagick()->read($towersDto->picture);
            $image_tn = ImageManager::imagick()->read($towersDto->picture);
            $width = $image->width();
            if (($width > 1200)) {
                $image->scaleDown(width: 1200);
            }
            $image_tn = $image_tn->scaleDown(width: 300);
            $image_tn->save(Storage::disk('publish')->path($path . $tower->id . '/tn_' . $picture_name));
            $image->save(Storage::disk('publish')->path($path . $tower->id . '/' . $picture_name));
        }

        if (empty($towersDto->picture) && empty($file_name_hidden)) {
            $picture_name = '';
            /*get old picture name ------------------------------------------------------------------------------------------*/
            $tower = $this->towersRepositories->getTowerById($id);
            $picture_name_old = $tower->picture;
            /*end get old picture name ------------------------------------------------------------------------------------------*/
            $towerDirectory = $path . $tower->id;
            $filesToDelete = [$picture_name_old, 'tn_'.$picture_name_old,]; // Имена на фајловите за бришење
            foreach ($filesToDelete as $file) {
                if (Storage::disk('publish')->exists($towerDirectory . '/' .$file )) {
                    Storage::disk('publish')->delete($towerDirectory . '/' .$file );
                }
            }
        }

        if (empty($towersDto->picture) && !empty($file_name_hidden)) {
            $picture_name = $file_name_hidden;
        }

        // UPDATE RECORD
        $tower = $this->towersRepositories->updateTower($id, $towersDto, $picture_name);
        if (!$tower) {
            //__('global.update_error')
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'2']);
        }

        return new ResponseSuccess($methodName, $this->classPath,[]);
    }

    public function delete($id): ResponseSuccess|ResponseError
    {
        $methodName = 'delete($id)';
        $isUsed= $this->towersRepositories->isUsed($id);
        if ($isUsed) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'2']);
        }

        $return= $this->towersRepositories->delete($id);
        if (!$return) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'1']);
        }
        return new ResponseSuccess($methodName, $this->classPath,[]);
    }



}
