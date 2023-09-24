<?php

namespace App\Jobs;

use App\Models\Livestream;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\CustomClasses\Api_Helper;
use App\Events\TwitchCheckEvent;

class TwitchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        // this is done for cron job to check the twitch status is it completed or not
        $twitchs  = Livestream::where('type','twitch')->where('status','!=','stopped')->orderBy('created_at','asc')->get();
        
        foreach($twitchs as $twitch){
            
            $headers = [
                "Authorization: Bearer v45zugzlsli3mju6wiz74ragdzz77l",
                "Client-Id: 43s48r8zwlgnvwpk5xsc1gk7efa3js"
            ];
            $url = "https://api.twitch.tv/helix/streams?user_id=" . $twitch->user_id;
            $APIHELPER = new Api_Helper($url, $headers, true, true);
            $response = $APIHELPER->CallApi();
            if(count($response['data']) == 0){
                tap($twitch->update(['status'=>'stopped']));
                broadcast(new TwitchCheckEvent($twitch));
            }
        }
       
    }
}
