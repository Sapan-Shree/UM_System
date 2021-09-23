<?php

namespace Database\Factories;

use App\Models\Handset;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HandsetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Handset::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'handset_type' => $this->faker->randomElement(['Mobile Phone','Desk Phone','Software Phone']),
            'user_id' => User::all()->random()->id,
        ];
    }
}
