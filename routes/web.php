<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

#REGISTRO
Route::get('/registro', [RegisterController::class, 'mostrar']);
Route::post('/registro', [RegisterController::class, 'registro']);

#LOGIN
Route::get('/login', [LoginController::class, 'mostrar']);
Route::post('/login', [LoginController::class, 'login']);

#LOGIN CORRECTO, HOME
Route::get('/panelusuario', [HomeController::class, 'mostrar']);

#LOGOUT
Route::get('/logout', [LogoutController::class, 'logout']);

#HOME
Route::post('/panelusuario-crearusuario', [HomeController::class, 'crearUsuario'])->name("home.crearuser");
Route::post('/panelusuario-modusuario', [HomeController::class, 'modUsuario'])->name("home.moduser");
Route::get('/panelusuario-delusuario-{email}', [HomeController::class, 'delUsuario'])->name("home.deluser");
#PERFIL
Route::post('/panelusuario-modperfil', [HomeController::class, 'modPerfil'])->name("home.modperfil");
