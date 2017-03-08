<?php

$account_prefix = '/account/{account}';

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
Route::get('/register', 'Auth\AuthController@register')->name('register');
Route::get('/login', 'Auth\AuthController@login')->name('login');
Route::post('/register', 'Auth\AuthController@create');
Route::post('/login', 'Auth\AuthController@authenticate');
Route::post('/logout', 'Auth\AuthController@logout')->name('logout');

/*
 * Root Redirect
 */
Route::get('/', function () { return Redirect::to('/accounts'); });
Route::get('/home', function () { return Redirect::to('/accounts'); });

/*
 * Account Routes
 */
Route::get('/accounts', 'AccountController@index')->name('home');
Route::get('/account/create', 'AccountController@create');
Route::post('/accounts', 'AccountController@store');
Route::get('/account/{account}', function($id){ return Redirect::to("/account/$id/dashboard"); });
Route::get('/account/{account}/dashboard', 'AccountController@show');
Route::get('/account/{account}/settings', 'AccountController@edit');
Route::put('/account/{account}', 'AccountController@update');
Route::delete('/account/{account}', 'AccountController@destroy');

Route::get('/account/{account}/analytics', 'AnalyticsController@index');

/*
 * Transaction Routes
 */
Route::resource($account_prefix.'/transaction', 'TransactionController');
Route::get($account_prefix.'/transaction/upload', 'TransactionController@file');
Route::post($account_prefix.'/transaction/upload', 'TransactionController@upload');

/*
 * Category Routes
 */
Route::resource($account_prefix.'/category', 'CategoryController');

/*
 * Month Routes
 */
Route::get($account_prefix.'/month', 'MonthController@index');
Route::get($account_prefix.'/month/{month}', 'MonthController@show');

/*
 * Sub Category Routes
 */
Route::resource($account_prefix.'/category/{category}/subcategory', 'SubCategoryController');






/*
 * Test routes
 */
Route::get('/test/graphs', function() { return view('tests.graphs'); });