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

	//Route::get('/ferias/campo/{id}', 'Android\ProgramasController@feriasCampo')->name('android.ferias_campo');
    Route::get('/plan/proteico/{id}', 'Android\ProgramasController@planProteico')->name('android.plan_proteico');
    Route::get('/tienda/fisica/{id}', 'Android\ProgramasController@tiendaFisica')->name('android.tiendaFisica');
    Route::get('/tienda/enlinea/{id}', 'Android\ProgramasController@tiendaEnlinea')->name('android.tiendaEnlinea');
    //Route::get('/tienda/movil/{id}', 'Android\ProgramasController@tiendaMovil')->name('android.tienda_movil');


    //Modulo CLAP
    Route::get('/modulo/clap/{id}', 'Android\ModuloClapController@index')->name('android.modulo_clap');
    Route::get('/modulo/clap/{id}/{municipio}', 'Android\ModuloClapController@verMunicipio')->name('android.modulo_clap_municipio');
    Route::get('/modulo/clap/{id}/{municipio}/{parroquia}', 'Android\ModuloClapController@verParroquia')->name('android.modulo_clap_parroquia');
    Route::get('/modulo/clap/bloque/{id}/{municipio}/{bloque}', 'Android\ModuloClapController@verBloque')->name('android.modulo_clap_bloque');
    Route::post('/modulo/clap/{id}/buscar', 'Android\ModuloClapController@buscarEnParroquia')->name('android.modulo_clap_buscar');
    Route::post('/modulo/clap/bloque/{id}/buscar', 'Android\ModuloClapController@buscarEnBloque')->name('android.modulo_clap_buscar_bloque');

    //Modulo Buscar
    Route::get('/buscar/clap/{id}', 'Android\ModuloBuscarController@index')->name('android.buscarClap');
    Route::post('/buscar/clap/{id}/cedula', 'Android\ModuloBuscarController@buscarCedula')->name('android.buscar_cedula');

	//Ferias Campo Soberano
	Route::get('/ferias/campo/{id}', 'Android\FeriasCampoController@index')->name('android.ferias_campo');
	Route::get('/ferias/campo/{id}/{municipio}', 'Android\FeriasCampoController@verMunicipio')->name('android.ferias_campo_municipio');
    Route::get('/ferias/campo/{id}/{municipio}/{parroquia}', 'Android\FeriasCampoController@verParroquia')->name('android.ferias_campo_parroquia');

    //Tienda Movil
    Route::get('/tienda/movil/{id}', 'Android\TiendaMovilController@index')->name('android.tienda_movil');
    Route::get('/tienda/movil/{id}/{municipio}', 'Android\TiendaMovilController@verMunicipio')->name('android.tienda_movil_municipio');
    Route::get('/tienda/movil/{id}/{municipio}/{parroquia}', 'Android\TiendaMovilController@verParroquia')->name('android.tienda_movil_parroquia');


});




