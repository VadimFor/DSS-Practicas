<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeController_tabla_user;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ResenyasController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MisRestaurantesController;
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




//ENTREGA_3 (descomentar y borrar lo de la entrega 2)
Route::get('/', function () {return view('welcome');});

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

# RESTAURANTES
Route::get('/panelusuario/restaurantes-{id}', [MisRestaurantesController::class, 'mostrar'])->name("MisRestaurantesController.mostrar");
Route::post('/panelusuario-crear-restaurante', [MisRestaurantesController::class, 'crear'])->name("MisRestaurantesController.crear");
Route::post('/panelusuario-mod-restaurante', [MisRestaurantesController::class, 'mod'])->name("MisRestaurantesController.mod");
Route::get('/panelusuario-del_mi_restaurante-{id}', [MisRestaurantesController::class, 'delRestaurante'])->name("MisRestaurantesController.delRestaurante");
Route::get('/panelusuario-sort_restaurante-{columna}', [MisRestaurantesController::class, 'sort'])->name("MisRestaurantesController.sort");
Route::post('/panelusuario-buscar_restaurante', [MisRestaurantesController::class, 'buscar'])->name("MisRestaurantesController.buscar");

# RESEÑAS
Route::get('/panelusuario/resenyas-{id}', [ResenyasController::class, 'mostrar'])->name("ResenyasController.mostrar");
Route::post('/panelusuario-mod_mi_reseña', [ResenyasController::class, 'mod'])->name("ResenyasController.mod");
Route::get('/panelusuario-del_mi_resenya-{id}', [ResenyasController::class, 'delResenya'])->name("ResenyasController.delResenya");
Route::post('/panelusuario-buscar_mi_resenya', [ResenyasController::class, 'buscar'])->name("ResenyasController.buscar");

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

    //PLATO
    Route::get('/panelusuario-delvaloracion-{id}', [AdminController::class, 'delValoracion'])->name("AdminController.delValoracion");

Route::post('/panelusuario-buscar', [AdminController::class, 'buscar'])->name("AdminController.buscar");

Route::get('/panelusuario-sort-{column}', [AdminController::class, 'sort'])->name("AdminController.sort");

Route::get('/test', function () {
    $test = "__test__";
    return back()->with("test",$test);
});
