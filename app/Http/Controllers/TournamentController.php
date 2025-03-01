<?php

namespace App\Http\Controllers;

use App\Http\Requests\TournamentRequest;
use App\Models\Tournament;
use App\Services\TournamentService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


class TournamentController extends Controller
{
    protected $tournamentService;

    public function __construct(TournamentService $tournamentService)
    {
        $this->tournamentService = $tournamentService;
    }

    /**
     * Display a listing of the resource. Visible for everybody, no auth required
     */
    public function index(Request $request)
    {
        $tournaments = $this->tournamentService->fetchTournaments($request);

        return Inertia::render('Home', [
            'tournaments' => $this->tournamentService->addCanPermissions($tournaments),
            'hasMore' => $tournaments->hasMorePages(),
        ]);
    }

    /**
     * Fetch more tournaments for infinite scroll
     */
    public function loadMore(Request $request)
    {
        $page = $request->query('page', 1);
        $tournaments = $this->tournamentService->fetchTournaments($request, $page);

        return response()->json([
            'tournaments' => $this->tournamentService->addCanPermissions($tournaments),
            'hasMore' => $tournaments->hasMorePages(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Tournaments/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TournamentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        Tournament::create($data);

        return to_route('home')->with('success', 'Erfolgreich erstellt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tournament $tournament)
    {
        // Visible for everybody, no auth required
        return Inertia::render('Tournaments/Show', [
            'tournament' => $tournament,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tournament $tournament)
    {
        if (Auth::user()->cannot('update', $tournament)) {
            abort(403);
        }

        return Inertia::render('Tournaments/Edit', [
            'tournament' => $tournament,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TournamentRequest $request, Tournament $tournament)
    {
        if ($request->user()->cannot('update', $tournament)) {
            abort(403);
        }

        $tournament->update($request->validated());

        return to_route('home')->with('success', 'Erfolgreich bearbeitet!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tournament $tournament)
    {
        if (Auth::user()->cannot('delete', $tournament)) {
            abort(403);
        }

        $tournament->delete();

        return to_route('home')->with('success', 'Turnier gelöscht!');
    }
}
