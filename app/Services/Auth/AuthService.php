<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\Auth\InvalidCreidintial;

class AuthService
{

    public function userAttempt(string $username, string $password)
    {

        $user = User::with('roles')->where(['username' => $username])->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new InvalidCreidintial();
        }

        $token = $user->createToken($username)->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function AdminAttempt(string $username, string $password)
    {

        $admin = Admin::with('roles')->where(['username' => $username])->first();

        if (!$admin || !Hash::check($password, $admin->password)) {
            throw new InvalidCreidintial();
        }

        $token = $admin->createToken($username)->plainTextToken;

        return [
            'admin' => $admin,
            'token' => $token
        ];
    }
}
