<?php

use Illuminate\Support\Facades\Auth;
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
    //return view('auth.login');
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', 'verified', 'user.status'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//**************************************** Ruta para  Usuarios Suspendidos
Route::get('/logout2', function () {
    Auth::logout();
    return redirect()->route('login')->with('banned', 'Usuario Suspendido');
})->name('logout2');


//*************************************************** Rutas App Android
Route::prefix('/android')->group(function (){

    Route::get('/usuarios', 'Android\AppController@usuariosRegistrados')->name('android.usuarios');

});


