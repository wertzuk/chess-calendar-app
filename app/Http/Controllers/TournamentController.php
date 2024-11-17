<?php

namespace App\Http\Controllers;

use App\Http\Requests\TournamentRequest;
use App\Models\Tournament;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Visible for everybody, no auth required
        return Inertia::render('Home', [
            'tournaments' => Tournament::all()->map(function ($tournament) {
                $tournament->can = [
                    'edit' => Auth::user()?->can('update', $tournament) ?? false,
                    'delete' => Auth::user()?->can('delete', $tournament) ?? false,
                ];

                return $tournament;
            }),
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

        return to_route('home')->with( 'success', 'Erfolgreich erstellt!');
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

        return to_route('home')->with( 'success', 'Erfolgreich bearbeitet!');

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

        return to_route('home')->with( 'success', 'Turnier gelöscht!');
    }
}
