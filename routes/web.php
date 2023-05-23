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
use App\Http\Controllers\RestauranteDetalleController;
use App\Http\Controllers\RestaurantesController;
use Illuminate\Support\Facades\Route;

/*
█▀█ █▀█ █▀█ ▀█▀ ▄▀█ █▀▄ ▄▀█
█▀▀ █▄█ █▀▄ ░█░ █▀█ █▄▀ █▀█*/
Route::get('/', function () {return view('welcome');});


/* 
█▀█ █▀▀ █▀▀ █ █▀ ▀█▀ █▀█ █▀█
█▀▄ ██▄ █▄█ █ ▄█ ░█░ █▀▄ █▄█*/
Route::get('/registro', [RegisterController::class, 'mostrar']);
Route::post('/registro', [RegisterController::class, 'registro']);

/*
█░░ █▀█ █▀▀ █ █▄░█
█▄▄ █▄█ █▄█ █ █░▀█*/
Route::get('/login', [LoginController::class, 'mostrar']);
Route::post('/login', [LoginController::class, 'login']);

/*
█░░ █▀█ █▀▀ █▀█ █░█ ▀█▀
█▄▄ █▄█ █▄█ █▄█ █▄█ ░█░ */
Route::get('/logout', [LogoutController::class, 'logout']);

/*
█▀█ ▄▀█ █▄░█ █▀▀ █░░   █▀▄ █▀▀   █░█ █▀ █░█ ▄▀█ █▀█ █ █▀█
█▀▀ █▀█ █░▀█ ██▄ █▄▄   █▄▀ ██▄   █▄█ ▄█ █▄█ █▀█ █▀▄ █ █▄█*/
# PERFIL
Route::get('/panelusuario/perfil', [PerfilController::class, 'mostrar']);
Route::post('/panelusuario-modperfil', [PerfilController::class, 'modPerfil'])->name("home.modperfil");
Route::post('/panelusuario-modfotoperfil', [PerfilController::class, 'modfoto'])->name("home.modfoto");

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

    //VALORACION
    Route::get('/panelusuario-delvaloracion-{id}', [AdminController::class, 'delValoracion'])->name("AdminController.delValoracion");

Route::post('/panelusuario-buscar', [AdminController::class, 'buscar'])->name("AdminController.buscar");

Route::get('/panelusuario-sort-{column}', [AdminController::class, 'sort'])->name("AdminController.sort");


/*
█▀█ ▄▀█ █▄░█ █▀▀ █░░   █▀▄ █▀▀   █▀█ █▀▀ █▀ ▀█▀ ▄▀█ █░█ █▀█ ▄▀█ █▄░█ ▀█▀ █▀▀
█▀▀ █▀█ █░▀█ ██▄ █▄▄   █▄▀ ██▄   █▀▄ ██▄ ▄█ ░█░ █▀█ █▄█ █▀▄ █▀█ █░▀█ ░█░ ██▄*/
//MENUS DE RESTAURANTE
Route::get('/restaurante-detalle-{id}', [RestauranteDetalleController::class, 'listaMenus'])->name("RestauranteDetalleController.listaMenus"); 

// Route::get('/platos-menu-{id}',function(){return [1, 2, 3];});

Route::get('/platos-menu-{id}', [RestauranteDetalleController::class, 'listaPlatos']);
Route::post('/restaurante-detalle-crear', [RestauranteDetalleController::class, 'crear'])->name("RestauranteDetalleController.crear");
Route::post('/restaurante-detalle-modMenu', [RestauranteDetalleController::class, 'modMenu'])->name("RestauranteDetalleController.modMenu");
Route::post('/restaurante-detalle-eliminar-{id}', [RestauranteDetalleController::class, 'delMenu'])->name("RestauranteDetalleController.delMenu");
Route::post('/restaurante-detalle-delplato-{id}', [RestauranteDetalleController::class, 'delPlato'])->name("RestauranteDetalleController.delPlato");
Route::post('/restaurante-detalle-crearPlato', [RestauranteDetalleController::class, 'crearPlato'])->name("RestauranteDetalleController.crearPlato");
Route::post('/restaurante-detalle-delValoracion-{id}', [RestauranteDetalleController::class, 'delValoracion'])->name("RestauranteDetalleController.delValoracion");
Route::post('/restaurante-detalle-crearValoracion', [RestauranteDetalleController::class, 'crearValoracion'])->name("RestauranteDetalleController.crearValoracion");
Route::post('/restaurante-detalle-actualizarValoracion', [RestauranteDetalleController::class, 'actualizarValoracion'])->name("RestauranteDetalleController.actualizarValoracion");



/*
█▀█ █▀▀ █▀ ▀█▀ ▄▀█ █▄░█ ▄▀█   █▀█ █▀▀ █▀ ▀█▀ ▄▀█ █░█ █▀█ ▄▀█ █▄░█ ▀█▀ █▀▀ █▀
█▀▀ ██▄ ▄█ ░█░ █▀█ █░▀█ █▀█   █▀▄ ██▄ ▄█ ░█░ █▀█ █▄█ █▀▄ █▀█ █░▀█ ░█░ ██▄ ▄█*/
Route::get('/restaurantes', [RestaurantesController::class, 'mostrar'])->middleware('verificar.restaurantes');
Route::post('/restaurantes_buscar', [RestaurantesController::class, 'buscar'])->name("RestaurantesController.buscar");


/*
█▀█ █▀▀ █▀ ▀█▀ ▄▀█ █▄░█ ▄▀█   ▄▀█ █▄▄ █▀█ █░█ ▀█▀   █░█ █▀
█▀▀ ██▄ ▄█ ░█░ █▀█ █░▀█ █▀█   █▀█ █▄█ █▄█ █▄█ ░█░   █▄█ ▄█*/
Route::get('/aboutus', function () {return view('about_us');});

/*
▀█▀ █▀▀ █▀ ▀█▀
░█░ ██▄ ▄█ ░█░*/
Route::get('/test', function () {
    $test = "__test__";
    return back()->with("test",$test);
});
