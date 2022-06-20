<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'ProductController@index');
Route::resource('products', 'ProductController');
Route::resource('category', 'CategoryController');
// get detail
Route::get('products/detail/{id}', 'ProductController@detail');
// ajax
Route::get('/search', 'ProductController@search');