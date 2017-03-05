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

/*
 * Authentication Routes
 */
//Auth::routes();
Route::get('/register', 'Auth\AuthController@register');
Route::get('/login', 'Auth\AuthController@login');
Route::post('/register', 'Auth\AuthController@create');
Route::post('/login', 'Auth\AuthController@authenticate');
Route::post('/logout', 'Auth\AuthController@logout');

/*
 * Root Redirect
 */
Route::get('/', function () {
    return Redirect::to('/accounts');
});

/*
 * Account Routes
 */


