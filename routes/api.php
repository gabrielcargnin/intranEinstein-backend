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

    Route::group(['prefix' => '/oauth'], function () {

        Route::get('/user', 'AuthController@users');

        Route::post('/logout', 'AuthController@logout');

        Route::post('/changePassword', 'AuthController@changePassword');
    });

    Route::group(['prefix' => '/usuarios'], function () {
        Route::get('/', 'UsuarioController@list');

        Route::get('/{id}', 'UsuarioController@get');

        Route::delete('/{id}', 'UsuarioController@delete')->middleware('check.feature:master');

        Route::put('/{id}', 'UsuarioController@update')->middleware('check.feature:master');

        Route::post('/', 'UsuarioController@create')->middleware('check.feature:master');
    });

    Route::group(['prefix' => '/emprestimos'], function () {
        Route::post('/', 'EmprestimoController@emprestimo');

        Route::put('/', 'EmprestimoController@devolve');

        Route::get('/', 'EmprestimoController@getEmprestimosById');
    });

    Route::group(['prefix' => '/livros'], function () {
        Route::get('/', 'LivroController@list');

        Route::get('/disponiveis', 'LivroController@getLivrosDisponiveis');

        Route::get('/{id}', 'LivroController@get');

        Route::delete('/{id}', 'LivroController@delete')->middleware('check.feature:bruxo');

        Route::post('/', 'LivroController@create')->middleware('check.feature:bruxo');

        Route::put('/{id}', 'LivroController@update')->middleware('check.feature:bruxo');
    });

    Route::group(['prefix' => '/simulados'], function () {
        Route::get('/', 'SimuladoController@list');

        Route::get('/{id}', 'SimuladoController@get');

        Route::group(['middleware' => ['check.feature:bruxo']], function () {
            Route::delete('/{id}', 'SimuladoController@delete');

            Route::post('/', 'SimuladoController@create');

            Route::put('/{id}', 'SimuladoController@update');
        });

    });
});

