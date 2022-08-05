<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'ゲストユーザー',
            'email' => 'guest@example.com',
        ]);

        User::factory()->create([
            'name' => '山田太郎',
            'email' => 'taro@example.com',
        ]);
        // User::factory()->count(5)->create();
    }
}
