<?php

namespace Modules\Users\Repositories;


use App\Models\Countries;
use App\Models\ExpirationTime;
use App\Models\GroupsUsers;
use App\Models\Languages;
use App\Models\ModulesUsers;
use App\Models\Passwords;
use App\Models\Users;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Users\Dto\UsersDto;

class UsersRepositories
{
    public function getAllUsers($params): \Illuminate\Pagination\LengthAwarePaginator
    {
        $users = Users::with(['country', 'expirationTime', 'lastPassword'])
            ->where('users.deleted', 0);

        // Like filters
        $likeFilters = ['id', 'name', 'surname', 'username', 'email'];
        foreach ($likeFilters as $field) {
            if (!empty($params[$field])) {
                $users->where($field, 'like', '%' . $params[$field] . '%');
            }
        }

        // Exact match filters
        $exactFilters = ['id_country', 'id_expiration_time'];
        foreach ($exactFilters as $field) {
            if (!empty($params[$field])) {
                $users->where($field, $params[$field]);
            }
        }

        // Active / Deactivated logic
        if (array_key_exists('active', $params) && empty($params['deactivated'])) {
            $users->where('active', $params['active']);
        }
        if (array_key_exists('deactivated', $params) && empty($params['active'])) {
            $users->where('active', 0);
        }

        // Allowed sort fields and their real columns (if joined)
        $sortField = $params['order'] ?? 'id';
        $sortDirection = $params['sort'] ?? 'DESC';

        // Сортирање по поврзани модели – мора да join-уваме
        if (in_array($sortField, ['expiration_time_name', 'country_name'])) {
            // Join табелите и сортирај по нив
            if ($sortField === 'expiration_time_name') {
                $users->leftJoin('_expiration_time', '_expiration_time.id', '=', 'users.id_expiration_time');
                $users->orderBy('_expiration_time.name', $sortDirection);
            } elseif ($sortField === 'country_name') {
                $users->leftJoin('_countries', '_countries.id', '=', 'users.id_country');
                $users->orderBy('_countries.name', $sortDirection);
            }

            // Select only columns from users to avoid issues
            $users->select('users.*');
        } else {
            // Сортирање по колона од users
            $users->orderBy($sortField, $sortDirection);
        }

        // Pagination
        $defaultListing = config('users.pagination');
        $listing = $params['listing'] ?? $defaultListing;

        if ($listing === 'a') {
            $listing = $users->count(); // All
        }

        $paginated = $users->paginate($listing);

        $applyExpiredFilter = !empty($params['expired']) && empty($params['no_expired']);
        $applyNonExpiredFilter = !empty($params['no_expired']) && empty($params['expired']);

        if ($applyExpiredFilter || $applyNonExpiredFilter) {
            $now = new DateTime();

            $filtered = $paginated->getCollection()->filter(function ($user) use ($now, $applyExpiredFilter) {
                $createdAt = $user->lastPassword?->updated_at;
                $validMonths = $user->expirationTime?->value;

                // Игнорирај ако нема податоци или никогаш не истекува
                if (!$createdAt || !$validMonths) {
                    return false;
                }

                $expiresAt = (new DateTime($createdAt))->modify("+{$validMonths} months");

                // Филтер логика
                if ($applyExpiredFilter) {
                    return $expiresAt < $now;
                }

                return $expiresAt >= $now;
            });

            $paginated->setCollection($filtered->values());
        }

        return $paginated;
    }


    public function getActiveUsers()
    {
        $count = Users::where('deleted', 0)->where('active', 1)->count();
        return $count > 0 ? $count : 0;
    }
    public function getNonactiveUsers()
    {
        $count = Users::where('deleted', 0)->where('active', 0)->count();
        return $count > 0 ? $count : 0;
    }
    public function getUserById($id)
    {
        $user = Users::where('id', '=', $id)->first();
        if ($user){
            return $user;
        }
        return null;
    }


    public function storeUser($usersDto, $picture_name)
    {
//            $active = (isset($data['active'])) ? 1  : 0;

      $user= Users::create([
            'id_user_logged' => $usersDto->id_user_logged,
            'name' => $usersDto->name,
            'surname' => $usersDto->surname,
            'username' => $usersDto->username,
            'comment' => $usersDto->comment,
            'email' => $usersDto->email,
            'address' => $usersDto->address,
            'phone' => $usersDto->phone,
            'picture' => $picture_name,
            'id_country' => $usersDto->id_country,
            'id_expiration_time' => $usersDto->id_expiration_time,
            'user_type' => $usersDto->user_type,
            'active' => $usersDto->active,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return $user;

    }
    public function updateUser($id, UsersDto $data, $picture_name)
    {
        $user = Users::where('id', '=', $id)->first();

        if($user) {
            $user->name = $data->name;
            $user->surname = $data->surname;
            $user->comment = $data->comment;
            $user->username = $data->username;
            $user->email = $data->email;
            $user->address = $data->address;
            $user->id_country = $data->id_country;
            $user->phone = $data->phone;
            $user->picture = $picture_name;
            $user->id_expiration_time = $data->id_expiration_time;
            $user->user_type = $data->user_type;
            $user->updated_by = Auth::id();

            if(isset($data->password)) {
                $user->password = Hash::make($data->password);
            }
            $user->active = $data->active;

            if ($user->save()) {
                return $user;
            }
        }
        return null;
    }

    public function storePasswordUsers($id,$password)
    {
        $user = $this->getUserById($id);
        if($user) {
            $user->password =$password;
            return $user->save();
        }
        return null;
    }
    public function storePasswordPasswords($id, $password)
    {
        if (isset($password) && isset($id)) {
            $user = $this->getUserById($id);
            if ($user) {
                $password = Passwords::create([
                    'id_user' => $id,
                    'password' => $password]);
                if ($password) {
                    return $password;
                }
                return null;
            }
            return null;
        }
        return null;
    }
    public function previousPasswords($id_user)
    {
        $previousPasswords = Passwords::where('id_user', $id_user)->pluck('password');
        if ($previousPasswords) {
            return $previousPasswords;
        }
        return null;
    }
    public function deleteUser($id)
    {
        $users = $this->getUserById($id);
        if($users) {

            Users::where('id', '=', $id)->delete();
            if (Storage::disk('publish')->exists('users/' .$id )) {
                Storage::disk('publish')->delete('users/' .$id );
            }

            return $users;
//          $users->deleted = 1;
//          return $users->save();
        }
        return null;
    }
    public function getAllCountries()
    {
        $countries = Countries::where('active', '=', '1')->get();;
        if ($countries) {
            return $countries;
        }
        return null;
    }
    public function getAllExpirationTime()
    {
        $expirationTime = ExpirationTime::where('active', '=', '1')->get();;
        if ($expirationTime) {
            return $expirationTime;
        }
        return null;
    }
    public function storeNewHash($hash,$id_user,$type, $date)
    {
        $user = $this->getUserById($id_user);
        if($user) {
            $user->password_reset_hash =$hash;
            $user->password_reset_type =$type;
            $user->password_reset_hash_date =$date;
            return $user->save();
        }
        return null;
    }
    public function storePrivileges($id_user,$user_type): null
    {
        $user = $this->getUserById($id_user);
            $user = Users::find($id_user);
            $user->modules()->detach();
            $user->groups()->detach();
        if($user_type==1) {
            $newModules = [11]; // IDs на новите модули
        }
        if($user_type==2) {
            $newModules = [2,11]; // IDs на новите модули
        }
            foreach ($newModules as $moduleId) {
                ModulesUsers::create([
                    'user_id' => $id_user,
                    'module_id' => $moduleId,
                    'active' => true,
                    'deleted' => false,
                ]);
        }
        return null;
    }

    public function addGroupToUser(int $userId, int $groupId): ?GroupsUsers
    {
        $exists = GroupsUsers::where('user_id', $userId)
            ->where('group_id', $groupId)
            ->exists();

        if (!$exists) {
            // Ако не постои, внеси нов запис
            return GroupsUsers::create([
                'user_id' => $userId,
                'group_id' => $groupId,
                'active' => true,       // Дополнителни полиња при креирање
                'deleted' => false,
            ]);
        }
        return null;
    }

    public function removeGroupToUser(int $userId, int $groupId): ?int
    {
        $records = GroupsUsers::where('user_id', $userId)
            ->where('group_id', $groupId)
            ->get();

        if ($records->isNotEmpty()) {
           return GroupsUsers::where('user_id', $userId)
                ->where('group_id', $groupId)
                ->delete();
        }
return null;

    }

    public function getLanguagesByLang($lang)
    {
        return Languages::where('lang', '=', $lang)->first();
    }

}
