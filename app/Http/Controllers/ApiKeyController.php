<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\ApiKey;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $apiKeys = ApiKey::where('user_id', $user->id)->get();

        return Inertia::render('ApiKey/Index', [
            'apiKeys' => $apiKeys,
        ]);
    }

    public function create()
    {
        $apiKeys = ApiKey::where('user_id', auth()->user()->id)->get();

        return Inertia::render('ApiKey/Create', [
            'apiKeys' => $apiKeys,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['string', 'required', 'max:255'],
        ]);

        $user = auth()->user();

        $apiKey = ApiKey::create([
            'uuid' => 'api-' . Str::uuid(),
            'key' => 'key-' . Str::uuid(),
            'name' => $request->name,
            'user_id' => $user->id,
        ]);

        $apiKey = ApiKey::where('id', $apiKey->id)->first();

        return Inertia::render('ApiKey/Show', [
            'apiKey' => $apiKey,
        ]);
    }

    public function destroy()
    {
        $user = auth()->user();
        $apiKeys = ApiKey::where('user_id', $user->id)->get();

        return Inertia::render('ApiKey/Index', [
            'apiKeys' => $apiKeys,
        ]);
    }
}
