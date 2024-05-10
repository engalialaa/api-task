<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getUserNameAndId(): \Illuminate\Database\Eloquent\Collection|array
    {
        return User::query()

            ->select(
                'id',
                'name',
            )
            ->with('roles')
            ->whereHas('roles' , function($query)  {
                $query->where('name', '<>' , 'admin');
          })
            ->get();
    }
}
