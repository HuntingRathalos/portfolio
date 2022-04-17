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
        Save::factory()->count(10)->create();
    }
}
