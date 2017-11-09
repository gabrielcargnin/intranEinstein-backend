<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', 'RegisterController@register');

Route::group(['middleware' => ['auth:api']], function () {

    Route::get('/users', 'AuthController@users');
    Route::post('/logout', 'AuthController@logout');

    Route::group(array('prefix' => '/usuarios'), function () {
        Route::get('/', 'UsuarioController@list');

        Route::get('/{id}', 'UsuarioController@get');

        Route::delete('/{id}', 'UsuarioController@delete');

        Route::put('/{id}', 'UsuarioController@update');
    });

    Route::group(array('prefix' => '/emprestimos'), function () {
        Route::post('/empresta', 'EmprestimoController@emprestimo');

        Route::put('/devolve', 'EmprestimoController@devolve');

        Route::get('/', 'EmprestimoController@getEmprestimosById');
    });

    Route::group(array('prefix' => '/livros'), function () {
        Route::get('/', 'LivroController@list');

        Route::get('/{id}', 'LivroController@get');

        Route::delete('/{id}', 'LivroController@delete');

        Route::post('/', 'LivroController@create');

        Route::put('/{id}', 'LivroController@update');
    });

});

