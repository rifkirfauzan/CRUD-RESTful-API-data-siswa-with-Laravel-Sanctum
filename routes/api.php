<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FormController;
use App\Http\Controllers\API\ScoreController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'], function(){
    //crud students
    Route::post('/create',[FormController::class,'create']);
    Route::get('/edit/{id}',[FormController::class,'edit']);
    Route::post('/edit/{id}',[FormController::class,'update']);
    Route::get('/delete/{id}',[FormController::class,'delete']);


    //crud students dengan relasi ke student
    Route::post('/create-score-student',[ScoreController::class,'create']);
    Route::get('/data-student/{id}',[ScoreController::class,'getStudent']);
    Route::get('/data-student/{id}',[ScoreController::class,'update']);


    Route::get('/logout',[AuthController::class,'logout']);
});


Route::post('/login',[AuthController::class,'login']);