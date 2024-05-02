<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\usuarioController;
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

// Devuelve a los usuarios
Route::get('/usuarios',[usuarioController::class, 'index']);

// Devuelve un solo usuario con su id
Route::get('/usuarios/{id}',[usuarioController::class,'show']);

Route::post('/usuarios',[usuarioController::class, 'store']);

Route::put('/usuarios/{id}',[usuarioController::class, 'update']);

Route::patch('/usuarios/{id}',[usuarioController::class, 'update_parcial']);

Route::delete('usuarios/{id}', [usuarioController::class, 'destroy']);
