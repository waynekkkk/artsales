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

        Museum::create([
            'name'         => 'Asian Civilisations Museum',
            'lat'          => 1.2875,
            'long'         => 103.8514,
        ]);
    
        Museum::create([
            'name'         => 'ArtScience Museum',
            'lat'          => 1.2863,
            'long'         => 103.8593,
        ]);
    
        Museum::create([
            'name'         => 'National Gallery Singapore',
            'lat'          => 1.2902,
            'long'         => 103.8515,
        ]);
    
        Museum::create([
            'name'         => 'Singapore Art Museum',
            'lat'          => 1.2974,
            'long'         => 103.8507,
        ]);

    }
 
}