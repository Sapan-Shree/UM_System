<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \App\Models\User::truncate();
        \App\Models\Handset::truncate();

        $this->call(HandsetSeeder::class);
        \App\Models\User::factory(10)->create()->each(function($user){
             $handsets=\App\Models\Handset::all()->pluck('id');
            $user->handsets()->attach($handsets);

        });
        

    }
}
