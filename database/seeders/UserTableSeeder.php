<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Users;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    //
    public function run()
    {
        // admin user
        $user = new Users();
        $user->email = "admin@gmail.com";
        $user->password = bcrypt('12345678');
        $user->firstName = "Admin";
        $user->lastName = "User";
        $user->username = "adminuser";
        $user->phone = "9999999999";
        $user->save();
    }
}
