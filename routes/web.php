<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\ApiKeyController;
use App\Http\Controllers\PlaylistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [TrackController::class, 'index'])->name('tracks.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::middleware(['is_admin'])->group(function () {
        Route::get('/tracks/create', [TrackController::class, 'create'])->name('tracks.create');
        Route::post('/tracks', [TrackController::class, 'store'])->name('tracks.store');
        Route::get('/tracks/{track}/edit', [TrackController::class, 'edit'])->name('tracks.edit');
        Route::put('/tracks/{track}', [TrackController::class, 'update'])->name('tracks.update');
        Route::delete('/tracks/{track}', [TrackController::class, 'destroy'])->name('tracks.destroy');
    });

    Route::get('apiKeys', [ApiKeyController::class, 'index'])->name('apiKeys.index');
    Route::get('/apiKeys/create', [ApiKeyController::class, 'create'])->name('apiKeys.create');
    Route::post('/apiKeys', [ApiKeyController::class, 'store'])->name('apiKeys.store');
    Route::delete('/apiKeys/{api_key}', [ApiKeyController::class, 'destroy'])->name('apiKeys.destroy');

    Route::resource('playlists', PlaylistController::class);

});

Route::get('/test', [HomeController::class, 'index']);
