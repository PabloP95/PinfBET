<?php

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

Route::get('/aviso-legal/', function(){
    return view('aviso');
});

Route::get('/quienes-somos/', function(){
    return view('quienes');
});

Route::get('/perfil', function () {
    return view('perfil');
})->middleware('auth');

Route::get('/panel/{id}', [App\Http\Controllers\PanelController::class, 'show'])->middleware('auth');

Route::get('/mensajes/{id}', [App\Http\Controllers\MensajeController::class, 'show'])->middleware('auth');
Route::post('/mensajes/{id}/{ida}', 'MensajeController@subirMensaje')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/apuesta/{id}' ,[App\Http\Controllers\ApuestaController::class, 'show'])->middleware('auth');
Route::post('/apuesta/{id1}/{id2}', [App\Http\Controllers\ApuestaController::class, 'showAsignaturas'])->middleware('auth');

Route::get('/completarApuesta/{id1}/{id2}/{cod_asig}', [App\Http\Controllers\completarApuestaController::class, 'show'])->middleware('auth');
Route::post('/completarApuesta/subir/{id1}/{id2}/{cod_asig}', [App\Http\Controllers\completarApuestaController::class, 'subirApuesta'])->middleware('auth');
