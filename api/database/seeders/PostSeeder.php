<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('posts')->insert([
          [
            'user_id' => 1,
            'good_description' => '自販機を使わなかった！',
            'bad_description' => 'コンビニに寄ってしまった。',
            'self_evaluation' => '3',
          ],
          [
            'user_id' => 1,
            'good_description' => '特になし',
            'bad_description' => 'コンビニに寄ってしまった。',
            'self_evaluation' => '1',
          ],
      ]);
    }
}
