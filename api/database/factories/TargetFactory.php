<?php

namespace Database\Factories;

use App\Models\Target;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TargetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Target::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->text(30),
            'amount' => $this->faker->randomNumber(5, true),
        ];
    }
}
