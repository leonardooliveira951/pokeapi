<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('pokemon')->group(function () {
    Route::get('/{id}', 'Controller@buscarPokemon')->name('buscar-pokemon');
    Route::post('/inserir', 'Controller@inserirPokemon')->name('inserir-pokemon');
    Route::put('/{id}', 'Controller@atualizarPokemon')->name('atualizar-pokemon');
    Route::delete('/{id}', 'Controller@deletarPokemon')->name('deletar-pokemon');

});
