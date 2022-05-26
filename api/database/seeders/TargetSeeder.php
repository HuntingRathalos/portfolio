<?php

namespace Database\Seeders;

use App\Models\Target;
use Illuminate\Database\Seeder;

class TargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Target::factory()->count(20)->create();
        Target::factory()->create([
            'user_id' => 1,
            'name' => '旅行に行く!!',
            'amount' => 70000
        ]);
    }
}
