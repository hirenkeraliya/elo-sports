<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Users::create([
          
        //     'firstName' => 'admin',
        //     'lastName' => 'Admin Last Name',
        //     'email' => 'admin@gmail.com',
        //     'user_type' => 'admin',
        //     'username' => 'admin',
        //     'password' => bcrypt('123456'),
        // ]);
        $users = ['vivek','arush','innolytic'];
         foreach(  $users as   $user){
            $ot = Users::where('username',$user)->first();
            if($ot){
                $ot->update(['elo_balance'=>'100000']);
            }
           
         }
    }
}
