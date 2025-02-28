<?php

namespace App\Services;

use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TournamentService
{
    public function fetchTournaments(Request $request, $page = 1)
    {
        $query = Tournament::where('start_date', '>=', Carbon::today());

        if ($request->has('search')) {
            $query->whereAny([
                'title',
                'city',
            ], 'like', "%$request->search%");
        }

        return $query->orderBy('start_date')->paginate(10, ['*'], 'page', $page);
    }
}