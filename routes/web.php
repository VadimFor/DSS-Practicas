<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeController_tabla_user;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ResenyasController;
use App\Http\Controllers\AdminController;
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


# ＯＰＥＲＡＣＩＯＮＥＳ ＤＥ ＵＳＵＡＲＩＯ
#REGISTRO
Route::get('/registro', [RegisterController::class, 'mostrar']);
Route::post('/registro', [RegisterController::class, 'registro']);

#LOGIN
Route::get('/login', [LoginController::class, 'mostrar']);
Route::post('/login', [LoginController::class, 'login']);

#LOGOUT
Route::get('/logout', [LogoutController::class, 'logout']);



# ＰＡＮＥＬ ＤＥ ＵＳＵＡＲＩＯ
# PERFIL
Route::get('/panelusuario/perfil', [PerfilController::class, 'mostrar']);
Route::post('/panelusuario-modperfil', [PerfilController::class, 'modPerfil'])->name("home.modperfil");

# RESEÑAS
Route::get('/panelusuario/resenyas', [ResenyasController::class, 'mostrar']);

# ADMIN
Route::get('/panelusuario/admin', [AdminController::class, 'mostrar']);

    Route::post('/panelusuario-crear', [AdminController::class, 'crear'])->name("AdminController.crear");
    Route::post('/panelusuario-mod', [AdminController::class, 'mod'])->name("AdminController.mod");

    //USER
    Route::get('/panelusuario-delusuario-{email}', [AdminController::class, 'delUsuario'])->name("AdminController.delUsuario");
    
    //RESTAURANTE
    Route::get('/panelusuario-delrestaurante-{id}', [AdminController::class, 'delRestaurante'])->name("AdminController.delRestaurante");

    //MENU
    Route::get('/panelusuario-delmenu-{id}', [AdminController::class, 'delMenu'])->name("AdminController.delMenu");

    //PLATO
    Route::get('/panelusuario-delplato-{id}', [AdminController::class, 'delPlato'])->name("AdminController.delPlato");


Route::post('/panelusuario-buscar', [AdminController::class, 'buscar'])->name("AdminController.buscar");



Route::get('/test', function () {
    $test = "__test__";
    return back()->with("test",$test);
});
