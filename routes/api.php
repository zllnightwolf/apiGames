<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JogosController;

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
Route::get('/',function(){
    return response()->json([
'sucess' => true
    ]);
});

Route::get('/jogos',[JogosController::class,'index']);
Route::get('/jogos/{id}',[JogosController::class,'show']);
Route::post('/jogos',[jogosController::class,'store']);
Route::delete('/jogos/{id}',[JogosController::class,'destroy']);
Route::put('/jogos/{id}',[JogosController::class,'update']);
