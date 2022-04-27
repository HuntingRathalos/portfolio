<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('icons')->insert([
            ['code' => 'mdi-book-open-variant'],
            ['code' => 'mdi-cart-outline'],
            ['code' => 'mdi-tshirt-crew-outline'],
            ['code' => 'mdi-gift',],
            ['code' => 'mdi-coffee-outline'],
            ['code' => 'mdi-hamburger'],
            ['code' => 'mdi-noodles'],
            ['code' => 'mdi-food-apple'],
            ['code' => 'mdi-fish'],
            ['code' => 'mdi-ice-cream'],
            ['code' => 'mdi-candy'],
            ['code' => 'mdi-train-variant'],
            ['code' => 'mdi-ferry'],
            ['code' => 'mdi-taxi'],
            ['code' => 'mdi-bike'],
            ['code' => 'mdi-movie-open'],
            ['code' => 'mdi-music'],
            ['code' => 'mdi-microphone'],
            ['code' => 'mdi-google-controller'],
            ['code' => 'mdi-soccer'],
            ['code' => 'mdi-camera-outline'],
            ['code' => 'mdi-human-male-female-child'],
            ['code' => 'mdi-diamond-stone'],
            ['code' => 'mdi-watch'],
            ['code' => 'mdi-dumbbell'],
        ]);
    }
}
