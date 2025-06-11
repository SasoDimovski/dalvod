<?php

namespace Modules\Users\Services;

use App\Models\Groups;
use App\Services\Responses\ResponseError;
use App\Services\Responses\ResponseSuccess;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Modules\Users\Dto\UsersDto;
use Modules\Users\Emails\UsersRegistrationMail;
use Modules\Users\Http\Requests\UsersUpdateRequest;
use Modules\Users\Repositories\UsersAdministrationRepositories;
use Modules\Users\Repositories\UsersRepositories;

class UsersServices
{
    protected ?string $classPath;
    public function __construct(public UsersRepositories $usersRepositories, public UsersAdministrationRepositories $usersAdministrationRepositories)
    {
        $this->classPath = __DIR__ . '/' . class_basename(__CLASS__) . '.php';
    }

    public function index($params): array
    {
        $users = $this->usersRepositories->getAllUsers($params);
        $countries = $this->usersRepositories->getAllCountries();
        $expiration_time = $this->usersRepositories->getAllExpirationTime();
        $activeUsers = $this->usersRepositories->getActiveUsers();
        $nonactiveUsers = $this->usersRepositories->getNonactiveUsers();

        //dd($activeUsers);

        return ['data' => [
            'users' => $users,
            'countries' => $countries,
            'expiration_time' => $expiration_time,
            'activeUsers' => $activeUsers,
            'nonactiveUsers' => $nonactiveUsers,
        ]];
    }


    public function store(UsersDto $usersDto): ResponseError|ResponseSuccess
    {
        $methodName = 'store(UsersDto $usersDto)';
        $path = 'users/';

        //CREATE PICTURE NAME
        $picture_name = '';
        if (!empty($usersDto->picture)) {
            $extension = strtolower($usersDto->picture->getClientOriginalExtension());
            $picture_name = date('Ymd_His') . '_'.Str::random(3) .'.'. $extension;
        }

        // STORE USER
        $user = $this->usersRepositories->storeUser($usersDto,$picture_name);
        if (!$user) {
            //__('users.UsersController.error_store_user')
            return new ResponseError($methodName,  $this->classPath, ['id_error'=>'1']);
        }

        // STORE PICTURE
        if ($user && !empty($usersDto->picture)) {
            Storage::disk('publish')->makeDirectory($path . $user->id, 0777, true);
            $image = ImageManager::imagick()->read($usersDto->picture);
            $image_tn = ImageManager::imagick()->read($usersDto->picture);
            $width = $image->width();
            if (($width > 1200)) {
                $image->scaleDown(width: 1200);
            }
            $image_tn = $image_tn->scaleDown(width: 300);
            $image_tn->save(Storage::disk('publish')->path($path . $user->id . '/tn_' . $picture_name));
            $image->save(Storage::disk('publish')->path($path . $user->id . '/' . $picture_name));
        }


        // CREATE AND SAVE HASH
        $uniqueHash = md5($usersDto->email . '-' . Carbon::now()->toDateTimeString());
        $hash = $this->usersRepositories->storeNewHash($uniqueHash, $user->id, 'registration', Carbon::now());
        if (!$hash) {
            //users.UsersController.error_create_save_hash
            return new ResponseError($methodName,   $this->classPath, ['id_error'=>'2']);
        }

        // FUNCTIONALITY SEND EMAIL ///////////////////////////////////////////////
        if (config('config.users_send_registration_email') == 1) {
            //SEND EMAIL
            $subject = __('users.UsersController.email_subject');
            $url_mail = url("/registration?hash={$uniqueHash}");
            $sendEmail = Mail::to($usersDto->email )->send(new UsersRegistrationMail($subject, $url_mail, $user->username, $user->name, $user->surname, $user->email));
            if (!$sendEmail) {
                //users.UsersController.error_send_email
                return new ResponseError($methodName, $this->classPath, ['id_error'=>'3']);
            }
        }

        // FUNCTIONALITY ENABLE PASSWORD///////////////////////////////////////////////
        if (config('config.users_enable_pass_new') == 1) {

            // SAVE PASS FOR NEW USER
            if ($usersDto->password !== null) {

                //SAVE PASSWORD IN PASSWORDS
                $password = Hash::make($usersDto->password);
                $storePasswordPasswords = $this->usersRepositories->storePasswordPasswords($user->id, $password);
                if (!$storePasswordPasswords) {
                    //__('users.UsersController.error_update_paas_in_pass')
                    return new ResponseError($methodName,   $this->classPath, ['id_error'=>'4']);
                }
                //SAVE PASSWORD IN USERS
                $storePasswordUsers = $this->usersRepositories->storePasswordUsers($user->id, $password);
                if (!$storePasswordUsers) {
                    //__('users.UsersController.error_update_paas_in_users')
                    return new ResponseError($methodName,   $this->classPath, ['id_error'=>'5']);
                }
            } else {
                $password = Hash::make(Str::random(8));
                $storePassword = $this->usersRepositories->storePasswordUsers($user->id, $password);
                if (!$storePassword) {
                    //__('users.UsersController.error_update_paas_in_users')
                    return new ResponseError($methodName,   $this->classPath, ['id_error'=>'6']);
                }
            }
        }

        // FUNCTIONALITY ENABLE PASSWORD///////////////////////////////////////////////
        if (config('config.users_enable_pass_new') == 0) {

            //SAVE PASSWORD IN USERS
            if ($usersDto->password !== null) {
                $password = Hash::make(Str::random(8));
                $storePassword = $this->usersRepositories->storePasswordUsers($user->id, $password);
                if (!$storePassword) {
                    //__('users.UsersController.error_update_paas_in_users')
                    return new ResponseError($methodName,   $this->classPath, ['id_error'=>'6']);
                }
            }

        }
        $storePrivileges = $this->usersRepositories->storePrivileges($user->id,$user->user_type);
        return new ResponseSuccess(['id'=>$user->id]);
    }

    public function create(): array
    {
        $countries = $this->usersRepositories->getAllCountries();
        $expiration_time = $this->usersRepositories->getAllExpirationTime();
        return ['data' => [
            'countries' => $countries,
            'expiration_time' => $expiration_time,
        ]];
    }

    public function show($id): array
    {
        $user = $this->usersRepositories->getUserById($id);
        return ['data' => [
            'user' => $user,
        ]];

    }

    public function edit(String $lang, int $id): array
    {
        $user = $this->usersRepositories->getUserById($id);
        $countries = $this->usersRepositories->getAllCountries();
        $expiration_time = $this->usersRepositories->getAllExpirationTime();
        $id_language = $this->usersRepositories->getLanguagesByLang($lang)->id;
        //++++++++++++++++++++++++++++++++++++++++++++++++++
        //ДОДЕЛЕНИ МОДУЛИ
        $assignedModulesAll = $this->usersAdministrationRepositories->assignedModulesAll($id,$id_language);
        //ДОДЕЛЕНИ МОДУЛИ ПРЕКУ МОДУЛИ
        $assignedModulesModules = $this->usersAdministrationRepositories->assignedModulesModules($id,$id_language);
        //НЕДОДЕЛЕНИ МОДУЛИ ПРЕКУ МОДУЛИ
        $unassignedModulesModules = $this->usersAdministrationRepositories->unassignedModulesModules($id,$id_language);
        //СИТЕ МОДУЛИ
        $modules = $this->usersAdministrationRepositories->allModules($id_language);
        //СИТЕ ГРУПИ
        $groups = $this->usersAdministrationRepositories->allGroups($id_language);
        //ДОДЕЛЕНИ ГРУПИ
        $assignedGroups = $this->usersAdministrationRepositories->assignedGroups($id,$id_language);
        //НЕДОДЕЛЕНИ ГРУПИ
        $unassignedGroups = $this->usersAdministrationRepositories->unassignedGroups($id,$id_language);


        //return new SuccessResponse(__('global.update_success'), ['data' => ['user' => $user, 'countries' => $countries, 'expiration_time' => $expiration_time]], ['reason' => 'user_update_success']);
        return ['data' => [
            'user' => $user,
            'countries' => $countries,
            'expiration_time' => $expiration_time,
            'assignedModulesAll' => $assignedModulesAll,
            'assignedModulesModules' => $assignedModulesModules,
            'unassignedModulesModules' => $unassignedModulesModules,
            'assignedGroups' => $assignedGroups,
            'unassignedGroups' => $unassignedGroups,
            'modules' => $modules,
            'groups' => $groups,
            ]];
    }


    public function update(?String $file_name_hidden, UsersDto $usersDto): ResponseSuccess|ResponseError
    {
        $methodName = 'update(?String $file_name_hidden, UsersDto $usersDto)';
        $id = $usersDto->id;
        $picture_name = '';
        $path = 'users/';

        // CHECK IF USER EXIST ///////////////////////////////////////////////
        $isUser = $this->usersRepositories->getUserById($id);
        if (!$isUser) {
            // __('users.UsersController.error_user_not_exist')
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'1']);
        }

        // FUNCTIONALITY PASSWORD USED ///////////////////////////////////////////////
        if ($usersDto->password !== null) {
            if (config('config.users_password_used') == 1) {
                $previousPasswords = $this->usersRepositories->previousPasswords($id);
                foreach ($previousPasswords as $hashedPassword) {
                    if (Hash::check($usersDto->password, $hashedPassword)) {
                        //__('users.UsersController.error_password_used')
                        return new ResponseError($methodName, $this->classPath, ['id_error'=>'2']);
                    }
                }
            }
        }

        if (!empty($usersDto->picture) && !empty($file_name_hidden)) {

            /*get old picture name ------------------------------------------------------------------------------------------*/
            $user = $this->usersRepositories->getUserById($id);
            $picture_name_old = (!empty($usersDto->picture) ) ? $user->picture : '';
            /*end get old picture name ------------------------------------------------------------------------------------------*/
            /*create picture name ------------------------------------------------------------------------------------------*/
            $extension = strtolower($usersDto->picture->getClientOriginalExtension());
            $picture_name = date('Ymd_His') . '_' . Str::random(8) . '.' . $extension;
            /*end create picture name ------------------------------------------------------------------------------------------*/
            Storage::disk('publish')->makeDirectory($path.$user->id, 0777, true);
            $userDirectory = $path . $user->id;
            $filesToDelete = [$picture_name_old, 'tn_'.$picture_name_old,]; // Имена на фајловите за бришење
            foreach ($filesToDelete as $file) {
                if (Storage::disk('publish')->exists($userDirectory . '/' .$file )) {
                    Storage::disk('publish')->delete($userDirectory . '/' .$file );
                }
            }
            $image = ImageManager::imagick()->read($usersDto->picture);
            $image_tn = ImageManager::imagick()->read($usersDto->picture);
            $width = $image->width();
            if (($width > 1200)) {
                $image->scaleDown(width: 1200);
            }
            $image_tn = $image_tn->scaleDown(width: 300);
            $image_tn->save(Storage::disk('publish')->path($path . $user->id . '/tn_' . $picture_name));
            $image->save(Storage::disk('publish')->path($path . $user->id . '/' . $picture_name));
        }

        if (empty($usersDto->picture) && empty($file_name_hidden)) {
            $picture_name = '';
            /*get old picture name ------------------------------------------------------------------------------------------*/
            $user = $this->usersRepositories->getUserById($id);
            $picture_name_old = $user->picture;
            /*end get old picture name ------------------------------------------------------------------------------------------*/
            $userDirectory = $path . $user->id;
            $filesToDelete = [$picture_name_old, 'tn_'.$picture_name_old,]; // Имена на фајловите за бришење
            foreach ($filesToDelete as $file) {
                if (Storage::disk('publish')->exists($userDirectory . '/' .$file )) {
                    Storage::disk('publish')->delete($userDirectory . '/' .$file );
                }
            }
        }

        if (empty($usersDto->picture) && !empty($file_name_hidden)) {
            $picture_name = $file_name_hidden;
        }

        // UPDATE USER
        $user = $this->usersRepositories->updateUser($id, $usersDto, $picture_name);
        if (!$user) {
            //__('users.UsersController.error_update_user')
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'3']);
        }

        //STORE PASS
        if ($usersDto->password !== null) {
            $password = Hash::make($usersDto->password);
            $storePasswordPasswords = $this->usersRepositories->storePasswordPasswords($user->id, $password);
            if (!$storePasswordPasswords) {
                //__('users.UsersController.error_update_paas_in_pass')
                return new ResponseError($methodName, $this->classPath, ['id_error'=>'4']);
            }
            $storePasswordUsers = $this->usersRepositories->storePasswordUsers($user->id, $password);
            if (!$storePasswordUsers) {
                //__('users.UsersController.error_update_paas_in_users')
                return new ResponseError($methodName, $this->classPath, ['id_error'=>'5']);
            }
        }

        $storePrivileges = $this->usersRepositories->storePrivileges($user->id,$user->user_type);
        return new ResponseSuccess($methodName, $this->classPath,[]);
    }

    public function sendEmailReg($id): ResponseSuccess|ResponseError
    {
        $methodName = 'sendEmailReg($id)';
        // CHECK IF USER EXIST ///////////////////////////////////////////////
        $user = $this->usersRepositories->getUserById($id);
        if (!$user) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'1']);
        }

        // CREATE AND SAVE HASH
        $uniqueHash = md5($user->email . '-' . Carbon::now()->toDateTimeString());
        $hash = $this->usersRepositories->storeNewHash($uniqueHash, $user->id, 'registration', Carbon::now());
        if (!$hash) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'2']);
        }

        //SEND EMAIL
        $subject = __('users.UsersController.email_subject');
        $url_mail = url("/registration?hash={$uniqueHash}");
        $sendEmail = Mail::to($user->email)->send(new UsersRegistrationMail($subject, $url_mail, $user->username, $user->name, $user->surname, $user->email));
        if (!$sendEmail) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'3']);
        }

        return new ResponseSuccess($methodName, $this->classPath,[]);
    }

    public function deleteUser($id): ResponseSuccess|ResponseError
    {
        $methodName = 'deleteUser($id)';
        $return= $this->usersRepositories->deleteUser($id);
        if (!$return) {
            return new ResponseError($methodName, $this->classPath, ['id_error'=>'1']);
        }
        return new ResponseSuccess($methodName, $this->classPath,[]);
    }


    public function addGroupToUser( $id_user, $id_group): ResponseSuccess|ResponseError
    {
        $addGroupToUser = $this->usersRepositories->addGroupToUser( $id_user, $id_group);
        if (!$addGroupToUser) {
            return new ResponseError('method: addGroupToUser( $id_user, $id_group)',  __DIR__ . '/' . class_basename(__CLASS__) . '.php');
        }
        return new ResponseSuccess([]);
    }

    public function removeGroupToUser(int $id_user, int $id_group): ResponseSuccess|ResponseError
    {
        $addGroupToUser = $this->usersRepositories->removeGroupToUser( $id_user, $id_group);
        if (!$addGroupToUser) {
            return new ResponseError('method: removeGroupToUser( $id_user, $id_group)',  __DIR__ . '/' . class_basename(__CLASS__) . '.php');
        }
        return new ResponseSuccess([]);
    }


}
