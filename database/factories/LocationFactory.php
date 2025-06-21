<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    public function definition(): array
    {
        $faker = \Faker\Factory::create('de_DE');

        return [
            'street' => $faker->streetAddress(),
            'plz' => $faker->postcode(), // German PLZ format
            'city' => $faker->city(),
            'latitude' => $faker->latitude(47.2, 55.1), // Germany's approximate bounds
            'longitude' => $faker->longitude(5.8, 15.2),
        ];
    }

    public function inBerlin(): static
    {
        return $this->state(fn (array $attributes) => [
            'plz' => '10'.rand(100, 999), // Berlin PLZ range
            'city' => 'Berlin',
            'latitude' => 52.52,
            'longitude' => 13.405,
        ]);
    }

    public function inMunich(): static
    {
        return $this->state(fn (array $attributes) => [
            'plz' => '80'.rand(100, 999), // Munich PLZ range
            'city' => 'München',
            'latitude' => 48.1351,
            'longitude' => 11.5820,
        ]);
    }
}
