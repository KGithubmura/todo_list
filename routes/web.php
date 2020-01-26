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
    return view('welcome');
});

Route::group(['prefix' => 'admin','middleware' => 'auth'], function() {
   Route::get('todo/create', 'Admin\TodoController@add');
   Route::post('todo/create', 'Admin\TodoController@create');
   Route::get('todo', 'Admin\TodoController@index');
   Route::get('todo/edit', 'Admin\TodoController@edit');
   Route::post('todo/edit', 'Admin\TodoController@update');
   Route::get('todo/done','Admin\TodoController@done');
   Route::get('todo/doneindex', 'Admin\TodoController@doneindex');
   Route::get('todo/delete', 'Admin\TodoController@delete');
   Route::get('todo/undone', 'Admin\TodoController@undone');
   
   Route::get('category/categorycreate', 'Admin\TodoController@categoryAdd');
   Route::post('category/categorycreate', 'Admin\TodoController@categoryCreate');
   Route::get('category/category', 'Admin\TodoController@category');
   Route::get('category/categoryDelete', 'Admin\TodoController@categoryDelete');
   Route::get('category/categoryedit', 'Admin\TodoController@categoryEdit');
   Route::post('category/categoryedit', 'Admin\TodoController@categoryUpdate');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
