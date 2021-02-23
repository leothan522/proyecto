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

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('cerrar');

//**************************************** Ruta para  Usuarios Suspendidos
Route::get('/banned', function () {
    Auth::logout();
    return redirect()->route('login')->with('banned', 'Usuario Suspendido');
})->name('banned');


//*************************************************** Rutas App Android
Route::prefix('/android')->group(function (){

    Route::get('/usuarios', 'Android\AppController@usuariosRegistrados')->name('android.usuarios');
    //Modulo CLAP
    Route::get('/modulo/clap/{id}', 'Android\ProgramasController@moduloClap')->name('android.modulo_clap');
    Route::get('/modulo/clap/{id}/{municipio}', 'Android\ProgramasController@moduloClapParroquias')->name('android.modulo_clap_parroquias');



    Route::get('/ferias/campo/{id}', 'Android\ProgramasController@feriasCampo')->name('android.ferias_campo');
    Route::get('/plan/proteico/{id}', 'Android\ProgramasController@planProteico')->name('android.plan_proteico');
    Route::get('/tienda/fisica/{id}', 'Android\ProgramasController@tiendaFisica')->name('android.tiendaFisica');
    Route::get('/tienda/enlinea/{id}', 'Android\ProgramasController@tiendaEnlinea')->name('android.tiendaEnlinea');
    Route::get('/buscar/clap/{id}', 'Android\ProgramasController@buscarClap')->name('android.buscarClap');

});




