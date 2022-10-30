<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all();
        
        return [
            'number' => $this->faker->numberBetween(0000, 9999),
            'out_at' => time(),
            'user_id' => $this->faker->randomElement($users)
        ];
    }
}
