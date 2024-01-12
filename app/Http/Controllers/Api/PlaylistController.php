<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Hello World!',
        ]);
    }
}
