<?php

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


Route::group(array('prefix' => 'api/livros'), function () {
    Route::get('/', 'LivroController@list');

    Route::get('/{id}', 'LivroController@get');

    Route::delete('/{id}', 'LivroController@delete');

    Route::post('/', 'LivroController@create');

    Route::put('/{id}', 'LivroController@update');
});

Route::group(array('prefix' => 'api/usuarios'), function () {
    Route::get('/', 'UsuarioController@list');

    Route::get('/{id}', 'UsuarioController@get');

    Route::delete('/{id}', 'UsuarioController@delete');

    Route::post('/', 'UsuarioController@create');

    Route::put('/{id}', 'UsuarioController@update');
});

Route::group(array('prefix' => 'api/emprestimos'), function () {
    Route::post('/empresta', 'EmprestimoController@emprestimo');

    Route::put('/devolve', 'EmprestimoController@devolve');

    Route::get('/', 'EmprestimoController@getEmprestimosById');
});