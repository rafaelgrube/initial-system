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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/companies/search', 'CompanyController@search')->name('companies.search');
Route::resource('/companies', 'CompanyController');

Route::get('/users/search', 'UserController@search')->name('users.search');
Route::resource('/users', 'UserController')->parameters([
    'login' => 'login'
]);
