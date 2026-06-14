<?php

namespace App\Services;

use Throwable;
use App\Models\User;

class UserService
{
    /**
     * getUsers
     *
     * @param  mixed $params
     * @return mixed
     */
    public static function getUsers($params = array())
    {
        try {
            $user = User::select("id", "name", "email", "role_id", "country_code", "phone_number", "is_complete_profile");

            if (isset($params['role']) && !empty($params['role'])) {
                $user->where('role_id', $params['role']);
            }

            if (isset($params['id']) && !empty($params['id'])) {
                return $user->where('id', $params['id'])->first();
            }
            return $user->get();
        } catch (Throwable $e) {
            report($e);
            return "";
        }
    }

    public static function updateLastActive($user)
    {
        try {
            $user->last_active_at = date('Y-m-d H:i:s');
            $user->save();
            return true;
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public static function generateUniqueVerificationCode()
    {
        do {
            $verificationCode = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (User::where('reset_code', $verificationCode)->exists());

        return $verificationCode;
    }

    public static function generateRandomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $pass = implode($pass);
        return $pass;
    }
}
