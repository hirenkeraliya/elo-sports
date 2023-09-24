<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return voidphp
     */
    public function run()
    {
        $data =[
            ['vig'=>50.00,'extra_vig_division_factor'=>1]
        ];
        Setting::insert($data);
    }
}
