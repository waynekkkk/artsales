<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Event;
use App\Models\Museum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MuseumTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('museums')->delete();
    
        Museum::create([
            'name'         => 'National Museum of Singapore',
            'lat'          => 1.2966,
            'long'         => 103.8485,
        ]);

    }
 
}