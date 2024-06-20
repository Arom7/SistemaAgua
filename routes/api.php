<?php

use App\Http\Controllers\Api\cuentaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\socioController;
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

//Ruta para las funciones del usuario

// Devuelve a los usuarios
Route::get('/usuarios',[socioController::class, 'index']);

// Devuelve un solo usuario con su id
Route::get('/usuarios/{id}',[socioController::class,'show']);

Route::post('/usuarios',[socioController::class, 'store']);

Route::put('/usuarios/{id}',[socioController::class, 'update']);

Route::patch('/usuarios/{id}',[socioController::class, 'update_parcial']);

Route::delete('usuarios/{id}', [socioController::class, 'destroy']);


/* Rutas para la cuenta
   # Ingreso a login
*/
Route:: post('/login',[cuentaController::class, 'login']);
