<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\ColoniaController;
use App\Http\Controllers\DireccionController;
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
    //return view('auth.login');
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UserController::class);
    Route::resource('estados', EstadoController::class);
    Route::resource('municipios', MunicipioController::class);
    Route::resource('colonias', ColoniaController::class);
    Route::resource('direcciones', DireccionController::class);
    Route::post('/municipios/filtro_municipio/{id?}', [MunicipioController::class, 'filtro_municipio'])->name('municipios.filtro_municipio');
    Route::post('/municipios/filtro_municipio_all', [MunicipioController::class, 'filtro_municipio_all'])->name('municipios.filtro_municipio_all');
    Route::get('/colonias/obtener_mun/{id?}', [ColoniaController::class, 'obtener_mun'])->name('colonias.obtener_mun');
    Route::get('/colonias/obtener_cp/{id?}', [ColoniaController::class, 'obtener_cp'])->name('colonias.obtener_cp');
    Route::post('/colonias/filtro_estado/{id?}', [ColoniaController::class, 'filtro_estado'])->name('colonias.filtro_estado');
    Route::post('/colonias/filtro_estado_all', [ColoniaController::class, 'filtro_estado_all'])->name('colonias.filtro_estado_all');
    Route::post('/colonias/filtro_municipio/{id}/{id_e}', [ColoniaController::class, 'filtro_municipio'])->name('colonias.filtro_municipio');
    Route::post('/colonias/filtro_municipio_all/{id}', [ColoniaController::class, 'filtro_municipio_all'])->name('colonias.filtro_municipio_all');
    Route::post('/colonias/filtro_cp/{id}', [ColoniaController::class, 'filtro_cp'])->name('colonias.filtro_cp');
    Route::post('/colonias/buscar_datos', [ColoniaController::class, 'buscar_datos'])->name('colonias.buscar_datos');
    Route::post('/colonias/filtro_cp_all/{id}', [ColoniaController::class, 'filtro_cp_all'])->name('colonias.filtro_cp_all');
});
