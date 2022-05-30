<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Save;

class SaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Save::factory()->count(20)->create([
            'user_id' => 1,
            'memo' => ''
        ]);
        Save::factory()->count(5)->create([
            'user_id' => 1,
            'coin' => -4,
            'memo' => '出費がかさんでしまったので気をつける'
        ]);
        Save::factory()->count(5)->create([
            'user_id' => 1,
            'coin' => -2,
            'memo' => '無駄使いを減らしたい!'
        ]);
        Save::factory()->count(5)->create([
            'user_id' => 1,
            'coin' => -1,
            'memo' => 'お菓子を買ってしまったので反省!'
        ]);
        Save::factory()->count(5)->create([
            'user_id' => 1,
            'coin' => -8,
            'memo' => '出費がかさんでしまったので気をつけたい'
        ]);
    }
}
