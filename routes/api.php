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
    Route::post('/changePassword', 'AuthController@changePassword');

    Route::group(['prefix' => '/usuarios'], function () {
        Route::get('/', 'UsuarioController@list');

        Route::get('/{id}', 'UsuarioController@get');

        Route::delete('/{id}', 'UsuarioController@delete');

        Route::put('/{id}', 'UsuarioController@update');
    });

    Route::group(['prefix' => '/emprestimos'], function () {
        Route::post('/empresta', 'EmprestimoController@emprestimo');

        Route::put('/devolve', 'EmprestimoController@devolve');

        Route::get('/', 'EmprestimoController@getEmprestimosById');
    });

    Route::group(['prefix' => '/livros'], function () {
        Route::get('/', 'LivroController@list');

        Route::get('/{id}', 'LivroController@get');

        Route::delete('/{id}', 'LivroController@delete');

        Route::post('/', 'LivroController@create');

        Route::put('/{id}', 'LivroController@update');
    });

    Route::group(['prefix' => '/simulados'], function () {
        Route::get('/', 'SimuladoController@list');

        Route::get('/{id}', 'SimuladoController@get');

        Route::delete('/{id}', 'SimuladoController@delete');

        Route::post('/', 'SimuladoController@create');

        Route::put('/{id}', 'SimuladoController@update');
    });

});

