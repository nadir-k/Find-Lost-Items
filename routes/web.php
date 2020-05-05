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

Auth::routes();


//Routes for the pages
Route::get('/', 'PagesController@index')->name('home');

Route::get('/about', 'PagesController@about')->name('about');


//Routes for the dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


//Routes for the posts
Route::get('/create', 'PostController@create')->name('create');

Route::get('/posts', 'PostController@index')->name('posts');

Route::post('/store', 'PostController@store');

Route::get('/show/{id}', 'PostController@show');

Route::get('/edit/{id}', 'PostController@edit');

Route::put('/update/{id}', 'PostController@update');

Route::delete('/destroy/{id}', 'PostController@destroy');


//Routes for the requests
Route::get('/requests', 'RequestController@index')->name('requests');

Route::get('/makeRequest/{id}', 'RequestController@create');

Route::post('/storeRequest', 'RequestController@store');

Route::get('/showRequest/{id}', 'RequestController@show');

Route::get('/email/approved/{id}', 'RequestController@approveRequest');

Route::get('/email/disapproved/{id}', 'RequestController@disapproveRequest');


//Routes for the categories
Route::get('/category', 'CategoriesController@category');

Route::post('/addCategory', 'CategoriesController@addCategory');

Route::get('/category/{id}', 'PostController@category');
