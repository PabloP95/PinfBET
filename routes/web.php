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

Route::get('/panel', function () {
    return view('panel');
})->middleware('auth');

Route::get('/mensajes/{id}', [App\Http\Controllers\MensajeController::class, 'show'])->middleware('auth');

Route::get('/chat/{idUser}/{idFriend}', [App\Http\Controllers\MensajeController::class, 'showAll'])->middleware('auth');
Route::post('/chat/{idUser}/{idFriend}', [App\Http\Controllers\MensajeController::class, 'subirMensaje'])->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
