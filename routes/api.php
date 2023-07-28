<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[UserController::class, "login"]);

// Protected routes

Route::middleware('trusttoken')->prefix('admin')->group(function() {
    Route::get('/get/graphic/{token?}',[UserController::class, "showGraphic"]);
    Route::get('/get/question/{token}',[UserController::class, "questionsList"]);
    Route::get('/get/responses/{token}',[UserController::class, "surveyedResponses"]);
});




// Public routes

Route::prefix('user')->group(function () {
    Route::get('/get/questions', [QuestionController::class, "showQuestions"]);
    Route::get('/get/responses/{token}', [ResponseController::class, "userResponse"]);
    Route::post('/store/responses', [ResponseController::class, "responseStore"]);
});
