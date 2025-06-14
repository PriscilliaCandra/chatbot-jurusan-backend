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

// Protected routes
Route::middleware('jwt.auth')->group(function () {
    // authentikasi
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', LogoutController::class)->name('logout');

    // chatbot routes
    Route::prefix('chatbot')->group(function () {
        Route::post('/ask', [ChatBotController::class, 'ask'])->name('chatbot.ask');
        Route::get('/questions', [ChatBotController::class, 'getAvailableQuestions'])->name('chatbot.questions');
    });

    // game routes
    Route::prefix('game')->group(function () {
        Route::get('/start', [GameController::class, 'start'])->name('game.start');
        Route::get('/question/{level}/{questionNumber}', [GameController::class, 'getQuestion'])->name('game.question');
        Route::post('/submit-answer', [GameController::class, 'submitAnswer'])->name('game.submit-answer');
        Route::get('/result', [GameController::class, 'getResult'])->name('game.result');
    });
});

