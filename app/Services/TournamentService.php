<?php

namespace App\Services;

use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TournamentService
{
    public function fetchTournaments(Request $request, $page = 1)
    {
        $itemsPerPage = 25;

        $query = Tournament::query()
            ->where('start_date', '>=', Carbon::today())
            ->with('location');

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                    ->orWhereHas('location', function ($locationQuery) use ($request) {
                        $locationQuery->where('city', 'like', "%{$request->search}%");
                    });
            });
        }

        if ($request->has('type')) {
            $query->where('chess_type', $request->type);
        }

        return $query->orderBy('start_date')
            ->paginate($itemsPerPage, ['*'], 'page', $page);
    }

    /**
     * Add can permissions to tournaments.
     */
    public function addCanPermissions($tournaments)
    {
        return $tournaments->map(function ($tournament) {
            $tournament->can = [
                'edit' => Auth::user()?->can('update', $tournament) ?? false,
                'delete' => Auth::user()?->can('delete', $tournament) ?? false,
            ];

            return $tournament;
        });
    }
}
