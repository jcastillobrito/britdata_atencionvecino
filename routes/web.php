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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Gestion de Usuarios
Route::group(['middleware' => ['role:ADMIN']], function () 
{
    Route::post('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.get');
    Route::post('/init', [App\Http\Controllers\JerarquiaController::class, 'init'])->name('init.get');
    
});


