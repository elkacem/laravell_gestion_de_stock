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

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test')->name('testhome');
Route::resource('/admin/categories','Admin\CategoriesController',['as'=>'admin']);
Route::resource('/admin/news','Admin\NewsController',['as'=>'admin']);

