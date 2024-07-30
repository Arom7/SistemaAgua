<?php

use App\Http\Controllers\cuentaController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta a la raiz
Route::get('/', function () {
    return view('index');
});

// Redireccionamiento a ruta dashboard
Route::get('/home', function() {
    return view('dashboard');
})->name('inicio');

Route::post('/login', [cuentaController::class, 'login'])->name('login.usuario');




//Route::get('/registro', function () {
   // return view('login/registro');
//});
