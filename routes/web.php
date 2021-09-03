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

Route::get("/", "Web\Mapa\MapaController@index")
    ->name('home');

Route::group(['prefix' => 'login'], function() {
    //
    Route::post("logar", "Web\Login\LoginController@logar")
        ->name('login/logar');
    Route::get("logout", "Web\Login\LoginController@logout")
        ->name('login/logout');
});

Route::group(['prefix' => 'infraestrutura'], function() {
    //
    Route::get("/", "Web\Infraestrutura\InfraestruturaController@index")
        ->name("infraestrutura");

    Route::get("listar", "Web\Infraestrutura\InfraestruturaController@listar")
        ->name("infraestrutura/listar");

    Route::post("inserir", "Web\Infraestrutura\InfraestruturaController@inserir")
        ->name("infraestrutura/inserir");

    Route::post("excluir/{id}", "Web\Infraestrutura\InfraestruturaController@excluir")
        ->where("id", "[0-9]+")
        ->name("infraestrutura/excluir");
});
