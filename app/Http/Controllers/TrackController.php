<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Track;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::where('display', true)->orderBy('title', 'ASC')->get();

        return Inertia::render('Track/Index', [
            'tracks' => $tracks,
        ]);
    }

    public function create()
    {
        return Inertia::render('Track/Create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'artist' => ['string', 'required', 'max:255'],
            'image' => ['image', 'required'],
            'music' => ['file', 'required', 'extensions:mp3,wav'],
            'display' => ['boolean', 'required'],
        ]);

        $extension = $request->image->extension();
        $imagePath = $request->image->storeAs('tracks/images', 'img-' . Str::uuid() . '.' . $extension);

        $extension = $request->music->extension();
        $musicPath = $request->music->storeAs('tracks/musics', 'mus-' . Str::uuid() . '.' . $extension);

        Track::create([
            'title' => $request->title,
            'uuid' => 'trk-' . Str::uuid(),
            'artist' => $request->artist,
            'image' => $imagePath,
            'music' => $musicPath,
            'display' => $request->display,
        ]);

        return redirect()->route('tracks.index');
    }
}
