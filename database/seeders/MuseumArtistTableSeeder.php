<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Event;
use App\Models\Museum;
use App\Models\MuseumArtist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MuseumArtistTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('museum_artists')->delete();
    
        MuseumArtist::create([
            'museum_id'         => 1,
            'user_id'           => 1,
            'datetime_start'    => '2022-11-15 00:00:00',
            'datetime_end'      => '2022-11-16 00:00:00',
        ]);
    
        MuseumArtist::create([
            'museum_id'         => 2,
            'user_id'           => 1,
            'datetime_start'    => '2022-11-16 00:00:00',
            'datetime_end'      => '2022-11-17 00:00:00',
        ]);
    
        MuseumArtist::create([
            'museum_id'         => 3,
            'user_id'           => 3,
            'datetime_start'    => '2022-11-16 00:00:00',
            'datetime_end'      => '2022-11-17 00:00:00',
        ]);
    
        MuseumArtist::create([
            'museum_id'         => 4,
            'user_id'           => 3,
            'datetime_start'    => '2022-11-17 00:00:00',
            'datetime_end'      => '2022-11-18 00:00:00',
        ]);
    
        MuseumArtist::create([
            'museum_id'         => 5,
            'user_id'           => 3,
            'datetime_start'    => '2022-11-18 00:00:00',
            'datetime_end'      => '2022-11-19 00:00:00',
        ]);

    }
 
}