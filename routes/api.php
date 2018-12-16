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
Route::prefix('v1')->middleware('jwt.auth')->group(function () {
    Route::resource('movie', 'MoviesController');
    Route::get('movies/{size?}', 'MoviesController@getMovies');

//route for sorting movies

    Route::get('movie/sort/{criteria}', 'MoviesController@sort');
    Route::get('movie/filter/{genre}', 'MoviesController@filter');

//routes for rating movies

    Route::post('rate/{movie_id}', 'RatingController@rateMovie');
});
//routes for user login and register , logout as well
Route::prefix('v1')->group(function () {
    Route::Post('user/register', 'APIRegisterController@register');
    Route::Post('user/login', 'APILoginController@login');
    Route::post('user/logout', 'APILoginController@logout');
});