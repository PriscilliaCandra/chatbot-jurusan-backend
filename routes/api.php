<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');

// Route::post('/ask', [ChatBotController::class, 'ask']);


// Protected routes
Route::middleware('jwt.auth')->group(function () {
    // authentikasi
    Route::post('/ask', [ChatBotController::class, 'ask']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', LogoutController::class)->name('logout');

    // game
    Route::get('/game/start', [GameController::class, 'start'])->name('game.start');
    Route::get('/game/question/{level}/{questionNumber}', [GameController::class, 'getQuestion'])->name('game.question');
    Route::post('/game/submit-answer', [GameController::class, 'submitAnswer'])->name('game.submit-answer');
    Route::get('/game/result', [GameController::class, 'getResult'])->name('game.result');
});

