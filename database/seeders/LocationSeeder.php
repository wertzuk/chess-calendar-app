<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            [
                'street' => 'Schachstraße 42',
                'plz' => 10115,
                'city' => 'Berlin',
                'latitude' => 52.5200,
                'longitude' => 13.4050,
            ],
            [
                'street' => 'Bauerngasse 5',
                'plz' => 80331,
                'city' => 'München',
                'latitude' => 48.1351,
                'longitude' => 11.5820,
            ],
            [
                'street' => 'Turmgasse 1',
                'plz' => 50667,
                'city' => 'Köln',
                'latitude' => 50.9375,
                'longitude' => 6.9603,
            ],
            [
                'street' => 'Springerplatz 8',
                'plz' => 60311,
                'city' => 'Frankfurt',
                'latitude' => 50.1109,
                'longitude' => 8.6821,
            ],
            [
                'street' => 'Damenweg 3',
                'plz' => 20095,
                'city' => 'Hamburg',
                'latitude' => 53.5488,
                'longitude' => 9.9872,
            ],
            [
                'street' => 'Königsallee 1',
                'plz' => 40212,
                'city' => 'Düsseldorf',
                'latitude' => 51.2277,
                'longitude' => 6.7735,
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}