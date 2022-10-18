<?php

namespace Database\Seeders;

use App\Models\Artwork;
use App\Models\Asset;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('users')->delete();
 
        User::create([
            'name'                  => 'Wayne Khoo',
            'email'                 => 'waynekhoo2611@gmail.com',
            'password'              => Hash::make('wk12345'),
            'is_artist'             => 1,
        ]);
 
        User::create([
            'name'                  => 'Joel Neo',
            'email'                 => 'joelneo@gmail.com',
            'password'              => Hash::make('jn12345'),
            'is_artist'             => 1,
        ]);
 
        User::create([
            'name'                  => 'Kaydon Long',
            'email'                 => 'kaydong@gmail.com',
            'password'              => Hash::make('kl12345'),
            'is_artist'             => 0,
        ]);
 
        User::create([
            'name'                  => 'Bob',
            'email'                 => 'bob@gmail.com',
            'password'              => Hash::make('bb12345'),
            'is_artist'             => 0,
        ]);

    }
 
}