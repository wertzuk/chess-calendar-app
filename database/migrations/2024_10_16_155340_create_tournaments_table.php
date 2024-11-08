<?php

use App\Models\User;
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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(User::class);
            $table->string('title');
            $table->string('time_control');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('chess_type', ['Blitz', 'Schnellschach', 'Klassisch']);
            $table->string('prize_fund')->nullable();
            $table->string('format')->nullable();
            $table->string('organizer')->nullable();
            $table->string('street')->nullable();
            $table->integer('plz')->nullable();
            $table->integer('city')->nullable();
            $table->integer('number_of_rounds')->nullable();
            $table->boolean('elo_rated')->default(0);
            $table->boolean('blitz_elo_rated')->default(0);
            $table->boolean('rapid_elo_rated')->default(0);
            $table->boolean('dwz_rated')->default(0);
            $table->string('chess_results_link')->nullable();
            $table->string('website_link')->nullable();
            $table->string('announcement_link')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
