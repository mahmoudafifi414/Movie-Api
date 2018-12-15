<?php

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
Route::resource('movie', 'MoviesController');

//route for sorting movies

Route::get('movie/sort/{criteria}', 'MoviesController@sort');
Route::get('movie/filter/{genre}', 'MoviesController@filter');