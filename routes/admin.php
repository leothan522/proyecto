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

    // modulo clap
    Route::get('/claps/importar/{id_import?}', 'Admin\ClapsController@subirArchivo')->name('claps.get_import');
    Route::post('/claps/importar', 'Admin\ClapsController@import')->name('claps.post_import');
    Route::get('/claps/importar/{id}/por-revision', 'Admin\ClapsController@getRevision')->name('claps.get_revision');
    Route::post('/claps/importar/{id}/por-revision', 'Admin\ClapsController@postRevision')->name('claps.post_revision');
    Route::get('/claps/importar/{id}/por-revision/exportar', 'Admin\ClapsController@exportImportClaps')->name('claps.get_revision_export');
    Route::get('/claps/exportar/', 'Admin\ClapsController@exportClaps')->name('claps.export');
    Route::get('/claps/borrar-municipio/{id}', 'Admin\ClapsController@borrarMunicipio')->name('claps.borrar');
    Route::get('/claps/ver/lideres/{id}', 'Admin\ClapsController@verLideres')->name('claps.lideres');
    Route::get('/claps/ver/censo/{id}', 'Admin\ClapsController@verCenso')->name('claps.censo');
    Route::post('/claps/ver/censo/{id}/importar', 'Admin\ClapsController@importCenso')->name('claps.censo_import');
    Route::post('/claps/ver/censo/{id}/delete', 'Admin\ClapsController@deleteCenso')->name('claps.censo_delete');
    Route::get('/claps/formato/excel', 'Admin\ClapsController@formatoExcel')->name('claps.formato');
    Route::resource('claps', 'Admin\ClapsController');
    Route::resource('periodos', 'Admin\PeriodosController');

    Route::get('/claps/ver/censo/{id}/export', 'Admin\ClapsController@exportCenso')->name('claps.censo_export');

    //Programas
    Route::resource('ferias', 'Admin\FeriasController');
    Route::resource('movil', 'Admin\TiendaMovilController');
    Route::resource('fisica', 'Admin\TiendaFisicaController');
    Route::delete('fisica/parametro/{id}', 'Admin\TiendaFisicaController@destroyParametro')->name('fisica.parametro');
    Route::resource('enlinea', 'Admin\TiendaEnlineaController');
    Route::delete('enlinea/parametro/{id}', 'Admin\TiendaEnlineaController@destroyParametro')->name('enlinea.parametro');
    Route::resource('proteico', 'Admin\PlanProteicoController');
    Route::delete('proteico/parametro/{id}', 'Admin\PlanProteicoController@destroyParametro')->name('proteico.parametro');

});
