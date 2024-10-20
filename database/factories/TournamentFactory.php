<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tournament>
 */
class TournamentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $date = fake()->dateTimeBetween('+0 days', '+100 days')->format('Y-m-d');
        $end = fake()->dateTimeBetween('+100 days', '+110 days')->format('Y-m-d');
        return [
            'title' => fake()->text(50),
            'user_id' => User::factory(),
            'chess_type' => fake()->randomElement(['Blitz', 'Schnellschach', 'Klassisch']),
            'time_control' => fake()->numberBetween(1,100) . '+0',
            'start_date' => $date,
            'end_date' => $end,
        ];
    }
}
