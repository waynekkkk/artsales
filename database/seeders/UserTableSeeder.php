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
            'description'           => 'Wayne Khoo is a chad.',
            'email'                 => 'waynekhoo2611@gmail.com',
            'password'              => Hash::make('wk12345'),
        ]);
 
        User::create([
            'name'                  => 'Joel Neo',
            'description'           => 'Joel Neo is a BUFF LORD!',
            'email'                 => 'joelneo@gmail.com',
            'password'              => Hash::make('jn12345'),
        ]);
 
        User::create([
            'name'                  => 'Kaydon Long',
            'description'           => 'Kaydon Long hmmmmm HMMMMMM.',
            'email'                 => 'kaydong@gmail.com',
            'password'              => Hash::make('kl12345'),
        ]);
 
        User::create([
            'name'                  => 'Bob',
            'description'           => 'Bob uses VSC in white mode ew!',
            'email'                 => 'bob@gmail.com',
            'password'              => Hash::make('bb12345'),
        ]);

    }
 
}