<?php

namespace Tests\Feature;

use App\Models\Tournament;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

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
            );
    }

    public function test_displays_tournaments_without_authentication()
    {
        // Arrange
        $amount = 3;
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

    public function test_users_can_only_update_and_delete_their_own_tournaments()
    {
        // Arrange
        $users = User::factory()->count(3)->create();
        Tournament::factory()->create(['user_id' => 1]);
        Tournament::factory()->create(['user_id' => 1]);
        Tournament::factory()->create(['user_id' => 2]);
        Tournament::factory()->create(['user_id' => 3]);
        Tournament::factory()->create(['user_id' => 3]);
        Tournament::factory()->create(['user_id' => 3]);

        // Act: Make the request as the first created user
        $response = $this->actingAs($users[0])->get(uri: route('home'));

        // Assert
        $response->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Home')
                ->has('tournaments', 4)  // Check that we received 4 tournaments
                ->where('tournaments', function ($tournaments) use ($users) {
                    foreach ($tournaments as $tournament) {
                        if ($tournament['user_id'] === $users[0]->id) {
                            $this->assertTrue($tournament['can']['edit']);
                            $this->assertTrue($tournament['can']['delete']);
                        } else {
                            $this->assertFalse($tournament['can']['edit']);
                            $this->assertFalse($tournament['can']['delete']);
                        }
                    }

                    return true;
                })
            );
    }

    public function test_guest_users_can_only_read_tournaments()
    {
        // Arrange
        $amount = 3;
        Tournament::factory()->count($amount)->create();

        // Act: Request the route as guest user
        $response = $this->get(uri: route('home'));

        // Assert
        $response->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Home')
                ->has('tournaments', $amount)  // Check that we received 3 tournaments
                ->has('tournaments', fn (Assert $page) => $page->each(fn (Assert $tournament) => $tournament
                    ->has('id')
                    ->where('can.edit', false)
                    ->where('can.delete', false)
                    ->etc()
                )
                )
            );

    }
}
