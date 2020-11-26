<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'user.status', 'isadmin', 'user.permisos'])->prefix('/admin')->group(function (){

    Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::resource('usuarios', 'Admin\UsersController');
    Route::resource('municipios', 'Admin\MunicipiosController');
    Route::resource('parroquias', 'Admin\ParroquiasController');
    Route::resource('familias', 'Admin\FamiliasController');
    Route::resource('bloques', 'Admin\BloquesController');
    Route::get('/gestionar-bloques/consultar', 'Admin\BloquesController@consultar')->name('bloques.consultar');

});
