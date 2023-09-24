<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            [ 'name'=>'Super Admin','slug'=>'super-admin'],
            [ 'name'=>'Streamer','slug'=>'streamer'],
            [ 'name'=>'Editor','slug'=>'editor']
        ];
        Role::insert($data);
    }
}
