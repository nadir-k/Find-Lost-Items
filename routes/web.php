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
/*Route::get('/about', function(){
    return view('pages.about');
});*/

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::get('/create', 'PostController@create');

Route::resource('posts', 'PostController');

Route::get('/register', 'PagesController@register');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::get('display', 'PostController@display')->name('display_post');

Route::resource('requests', 'RequestController');

// Route::get('/requests', 'RequestController@create');

Route::get('/requests/create/{id}', 'RequestController@create')->name('requests.create');

Route::get('/email/approved/{id}', 'RequestController@approveRequest');

Route::get('/email/disapproved/{id}', 'RequestController@disapproveRequest');

Route::get('/category', 'CategoriesController@category');
Route::post('/addCategory', 'CategoriesController@addCategory');
Route::get('/category/{id}', 'PostController@category');
