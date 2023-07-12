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

// Route::middleware('auth:sanctum')->prefix('admin')->group(function() {

// });

Route::middleware('auth:sanctum')->get('/admin', function (Request $request) {
    return $request->user();
});



Route::get('/questions/get',[QuestionController::class, "showQuestions"]);
Route::get('/responses/get/graphic',[ResponseController::class, "showGraphic"]);
Route::get('/responses/get',[ResponseController::class, "showResponses"]);
Route::get('/user/responses/get/{token}',[ResponseController::class, "userResponse"]);

// Route::post('/store/{surveyId}/{questionId}',[ResponseController::class, "store"]);
// Route::post('/responses/store', [ResponseController::class, "store"]);
Route::post('/responses/store', [ResponseController::class, "responseStore"]);
// Route::match(['get', 'post'], '/responses/store', [ResponseController::class, "responseStore"]);


Route::post('/user/register',[UserController::class, "register"]);
Route::post('/user/login',[UserController::class, "login"]);
