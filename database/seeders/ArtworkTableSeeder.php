<?php

namespace Database\Seeders;

use App\Models\Artwork;
use App\Models\Asset;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ArtworkTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('artworks')->delete();
 
        // dummy asset

        // 1
        Artwork::create([
            'title'             => 'Test Artwork',
            'artist_id'         => 1,
            'description'       => 'This is a description of the test artwork.',
            'asset_id'          => 1,
            'votes'             => 10,
        ]);

        Artwork::create([
            'title'             => 'Test Artwork 2',
            'artist_id'         => 1,
            'description'       => 'This is a description of the test artwork 2.',
            'asset_id'          => 1,
            'votes'             => 15,
        ]);

    }
 
}