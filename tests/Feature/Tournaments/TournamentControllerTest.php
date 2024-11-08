<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tournament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

class TournamentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_displays_tournaments_with_permission_flags()
    {
        // Arrange
        $amount = 3;
        $user = User::factory()->create();
        Tournament::factory()->count($amount)->create(['user_id' => $user->id]);

        // Act: Make the request as an authenticated user
        $response = $this->actingAs($user)->get(route('home'));

        // Assert
        $response->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Home')
                ->has('tournaments', $amount)  // Check that we received 3 tournaments
                ->has('tournaments.0', fn (Assert $page) => $page
                    ->has('id')
                    ->has('title')
                    ->has('user_id')
                    ->has('chess_type')
                    ->has('time_control')
                    ->has('city')
                    ->has('start_date')
                    ->has('end_date')
                    ->has('can.edit')
                    ->has('can.delete') 
                    ->etc()
                )
            )
            ;
    }

    public function test_displays_tournaments_without_authentication()
    {
        $amount = 3;
        // Arrange
        Tournament::factory()->count($amount)->create();

        // Act: Make the request without authentication
        $response = $this->get(route('home'));

        // Assert
        $response->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Home')
                ->has('tournaments', $amount)  // Check that we received 3 tournaments
                ->has('tournaments.0', fn (Assert $page) => $page
                    ->has('id')
                    ->has('title')
                    ->where('can.edit', false) 
                    ->where('can.delete', false)
                    ->etc()
                )
            );
    }
}
