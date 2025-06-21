<?php

use App\Models\Location;
use App\Models\Tournament;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Migrate existing tournament addresses to the `locations` table
        Tournament::query()
            ->whereNotNull('street')
            ->orWhereNotNull('plz')
            ->orWhereNotNull('city')
            ->each(function (Tournament $tournament) {
                $location = Location::create([
                    'street' => $tournament->street,
                    'plz' => $tournament->plz,
                    'city' => $tournament->city,
                ]);

                // Link the tournament to the new location
                $tournament->update(['location_id' => $location->id]);
            });

        Schema::table('tournaments', function (Blueprint $table) {
            $table->foreignId('location_id')
                ->nullable()
                ->constrained('locations')
                ->onDelete('set null');

            $table->dropColumn(['street', 'plz', 'city']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('new', function (Blueprint $table) {
            //
        });
    }
};
