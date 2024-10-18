<?php

namespace Database\Seeders;

use App\Models\Tournament;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Tournament::factory()->count(10)->create();
        User::create([
            'name' => 'Pascal',
            'email' => 'pascal@test.com',
            'password' => '$2y$12$NH9SbHbqlBYsgPhHGaikSOPlZJL5oYKWiPivMQK6CjFsWnYVVIecS',
            'remember_token' => 'NQb1cvwjoAYEm9M6r0rGTMSIyRX7b7g2AHaQZb6w5zV3Qp1cbvZjt7mFpQm9',
        ]);
    }
}
