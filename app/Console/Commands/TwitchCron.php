<?php

namespace App\Console\Commands;

use App\Jobs\TwitchJob;
use App\Models\Livestream;
use Illuminate\Console\Command;

class TwitchCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitch:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this is used to check the twitch video is live or not';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        TwitchJob::dispatch();
        
        \Log::info("Cron is working fine!");

        // return TwitchJob::dispatch();
    }
}
