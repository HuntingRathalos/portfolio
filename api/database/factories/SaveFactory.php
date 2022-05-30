<?php

namespace Database\Factories;

use App\Models\Save;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Save::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'tag_id' => $this->faker->numberBetween(1, 20),
            'icon_id' => $this->faker->numberBetween(1, 25),
            'coin' => $this->faker->numberBetween(0, 50),
            'memo' => $this->faker->text(30),
            'click_date' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+4 week'),
        ];
    }
}
