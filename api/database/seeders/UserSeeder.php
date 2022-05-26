<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'ゲストユーザー',
            'email' => 'guest@example.com'
        ]);

        User::factory()->create([
            'name' => '山田太郎',
            'email' => 'taro@example.com'
        ]);
        // User::factory()->count(5)->create();
    }
}
