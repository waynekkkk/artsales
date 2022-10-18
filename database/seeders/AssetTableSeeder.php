<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AssetTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('assets')->delete();
 
        // dummy asset

        // 1
        Asset::create([
            'asset_url'         => 'https://stateoftheart.blob.core.windows.net/wad2/logo.png',
        ]);

    }
 
}