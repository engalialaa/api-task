<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();


        $admin = \Spatie\Permission\Models\Role::create([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        $useRole = \Spatie\Permission\Models\Role::create([
            'name' => 'User',
            'guard_name' => 'web'
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name' => 'create',
            'guard_name' => 'web'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'update',
            'guard_name' => 'web'
        ]);

        \Spatie\Permission\Models\Permission::create([
            'name' => 'delete',
            'guard_name' => 'web'
        ]);
        \Spatie\Permission\Models\Permission::create([
            'name' => 'hide',
            'guard_name' => 'web'
        ]);

        $user = user::first();
        $user->username = "admin";
        $user->save();

        $users = User::query()->where('id' , '<>', $user->id)->get();

        $user->assignRole($admin);

        foreach ($users as $key => $user) {
            $user->assignRole($useRole);
            $user->username = "user-$key";
            $user->save();
        }


    }
}
