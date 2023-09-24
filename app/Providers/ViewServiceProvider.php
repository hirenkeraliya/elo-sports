<?php

namespace App\Providers;

use App\Models\Chat;
use App\Models\Livestream;
use App\Models\User;
use App\Models\Users;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       
        View::composer('backend.dashboard',function($view) {
            $users = Users::count();
            $livestreams = Livestream::query();
            $start =   Livestream::whereNull('type')->whereIn('status',  ['created','started'])->count();
            $stop =   Livestream::whereNull('type')->where('status',  'stopped' )->count();
            $chat = Chat::distinct('user_id')->count();
            $view->with([
                'users'=>$users,
                'stop'=>$stop,
                'start'=>$start,
                'chat'=>$chat
            ]);
        });
    }
}
