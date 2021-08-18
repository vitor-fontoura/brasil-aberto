<?php

use App\Http\Controllers\FacebookLoginController;
use App\Http\Controllers\TwitterLoginController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::prefix('facebook')->group(function () {
    Route::get('/', [FacebookLoginController::class, 'redirectToProvider']);
    Route::get('/callback', [FacebookLoginController::class, 'handleProviderCallback']);
});

Route::prefix('twitter')->group(function () {
    Route::get('/', [TwitterLoginController::class, 'redirectToProvider']);
    Route::get('/callback', [TwitterLoginController::class, 'handleProviderCallback']);
});