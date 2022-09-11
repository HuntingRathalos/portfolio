<?php

namespace Database\Seeders;

use App\Models\Target;
use Illuminate\Database\Seeder;

class TargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Target::factory()->count(20)->create();
        Target::factory()->create([
            'user_id' => 1,
            'name' => '旅行に行く!!',
            'amount' => 200000,
        ]);
        Target::factory()->create([
            'user_id' => 2,
            'name' => 'ワンピース全巻購入!!',
            'amount' => 150000,
        ]);
        Target::factory()->create([
            'user_id' => 3,
            'name' => 'ジムに通う!!',
            'amount' => 80000,
        ]);
        Target::factory()->create([
            'user_id' => 4,
            'name' => 'イヤホンを買う!!',
            'amount' => 100000,
        ]);
    }
}
