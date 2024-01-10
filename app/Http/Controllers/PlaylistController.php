<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Playlist/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Playlist/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        return Inertia::render('Playlist/Show', [
            'playlist' => $playlist,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        $playlist->delete();
        return redirect()->route('playlists.index');
    }
}
