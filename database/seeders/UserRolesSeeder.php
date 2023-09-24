<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::pluck('id')->toArray();
        $user = Users::where('username','admin1')->first();
     //   $user->roles()->sync($roles);
      //  $user = Users::where('username','admin')->first();
        $user->permissions()->attach([43,44]);
        // $user->roles()->sync($roles);0
    }
}
