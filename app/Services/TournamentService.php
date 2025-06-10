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
        // $query = Tournament::query();
        $query = Tournament::where('start_date', '>=', Carbon::today());
        $perPage = 25;

        if ($request->has('search')) {
            $query->whereAny([
                'title',
                'city',
            ], 'like', "%$request->search%");
        }

        if ($request->has('type')) {
            $query->where('chess_type',  $request->type);
        }

        return $query->orderBy('start_date')
            ->paginate($perPage, ['*'], 'page', $page);
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
