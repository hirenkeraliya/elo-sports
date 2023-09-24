<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            // [ 'name'=>'Create User','slug'=>'create-user'],
            // [ 'name'=>'Edit User','slug'=>'edit-user'],
            // [ 'name'=>'View User','slug'=>'view-user'],
            // [ 'name'=>'Delete User','slug'=>'delete-user'],
             [ 'name'=>'Change User Status','slug'=>'change-user-status'],

             [ 'name'=>'View Stream Respots','slug'=>'view-streams-reports'],
             [ 'name'=>'View Twitch Respots','slug'=>'view-twitch-reports'],

            // [ 'name'=>'Create Role','slug'=>'create-role'],
            // [ 'name'=>'Edit Role','slug'=>'edit-role'],
            // [ 'name'=>'View Role','slug'=>'view-role'],
            // [ 'name'=>'Delete Role','slug'=>'delete-role'],

            // [ 'name'=>'Create Permission','slug'=>'create-permission'],
            // [ 'name'=>'Edit Permission','slug'=>'edit-permission'],
            // [ 'name'=>'View Permission','slug'=>'view-permission'],
            // [ 'name'=>'Delete Permission','slug'=>'delete-permission'],

            // [ 'name'=>'Create LiveStreaming','slug'=>'create-live-streaming'],
            // [ 'name'=>'Edit LiveStreaming','slug'=>'edit-live-streaming'],
            // [ 'name'=>'View LiveStreaming','slug'=>'view-live-streaming'],
            // [ 'name'=>'Delete LiveStreaming','slug'=>'delete-live-streaming'],

            // [ 'name'=>'Create Account','slug'=>'create-account'],
            // [ 'name'=>'Edit Account','slug'=>'edit-account'],
            // [ 'name'=>'View Account','slug'=>'view-account'],
            // [ 'name'=>'Delete Account','slug'=>'delete-account'],

            // [ 'name'=>'Create Spam','slug'=>'create-spam'],
            // [ 'name'=>'Edit Spam','slug'=>'edit-spam'],
            // [ 'name'=>'View Spam','slug'=>'view-spam'],
            // [ 'name'=>'Delete Spam','slug'=>'delete-spam'],

            // [ 'name'=>'View Chat','slug'=>'view-chat'],
            // [ 'name'=>'Creat Delay Time','slug'=>'create-delay-time'],

            // [ 'name'=>'Create Livestream Watcher','slug'=>'create-livestream-watcher'],
            // [ 'name'=>'View Livestream Watcher','slug'=>'view-livestream-watcher'],


            //  [ 'name'=>'Create Setting','slug'=>'create-setting'],
            // [ 'name'=>'Edit Setting','slug'=>'edit-setting'],
            // [ 'name'=>'View Setting','slug'=>'view-setting'],
            // [ 'name'=>'Delete Setting','slug'=>'delete-setting'],

            // [ 'name'=>'Create Betting View Master','slug'=>'create-betting-view-master'],
            // [ 'name'=>'Edit Betting View Master','slug'=>'edit-betting-view-master'],
            // [ 'name'=>'View Betting View Master','slug'=>'view-betting-view-master'],
            // [ 'name'=>'Delete Betting View Master','slug'=>'delete-betting-view-master'],

            // [ 'name'=>'Create Betting Master','slug'=>'create-betting-master'],
            // [ 'name'=>'Edit Betting Master','slug'=>'edit-betting-master'],
            // [ 'name'=>'View Betting Master','slug'=>'view-betting-master'],
            // [ 'name'=>'Delete Betting Master','slug'=>'delete-betting-master'],

            // [ 'name'=>'Create Bet','slug'=>'create-bet'],
            // [ 'name'=>'Edit Bet','slug'=>'edit-bet'],
            // [ 'name'=>'View Bet','slug'=>'view-bet'],
            // [ 'name'=>'Delete Bet','slug'=>'delete-bet'],
            //   [ 'name'=>'View All Livestream','slug'=>'view-all-livestream'],
            

        ];
        Permission::insert($data);
    }
}
