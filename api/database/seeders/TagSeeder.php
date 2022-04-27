<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            ['name' => '外食'],
            ['name' => '飲み会'],
            ['name' => '食品'],
            ['name' => 'お酒'],
            ['name' => 'タバコ'],
            ['name' => '日用品'],
            ['name' => '趣味'],
            ['name' => '家族'],
            ['name' => '旅行'],
            ['name' => '携帯'],
            ['name' => '交通'],
            ['name' => '交際'],
            ['name' => 'スポーツ'],
            ['name' => '本'],
            ['name' => '音楽'],
            ['name' => '水道光熱'],
            ['name' => 'ネットショッピング'],
            ['name' => '美容'],
            ['name' => '洋服'],
            ['name' => 'その他'],

        ]);
    }
}
