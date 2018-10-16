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

Route::get('/', function () {
    return view('home');
});

Route::get('mis-ideas', 'IdeaController@getIdeas');
Route::post('guardar-ideas', 'IdeaController@store');
Route::delete('eliminar/{id}', 'IdeaController@destroy');
