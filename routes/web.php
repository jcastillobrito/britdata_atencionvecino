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
    //Gestion usuarios
    Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'page'])->name('users.page');
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.get');
    Route::put('/user', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::post('/user', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');

    // Gestion Servicios
    Route::get('/services', [App\Http\Controllers\ServiciosController::class, 'page'])->name('servicios.page');
    Route::get('/servicios/get', [App\Http\Controllers\ServiciosController::class, 'index'])->name('servicios.get');




    Route::get('/init', [App\Http\Controllers\JerarquiaController::class, 'init'])->name('init.get');

    //Notificaciones
    Route::patch('/notifications/{id}', [App\Http\Controllers\NotificationController::class, 'read'])->name('notifications.read');
    
});


