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
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/companies/search', 'CompanyController@search')->name('companies.search');
    Route::resource('/companies', 'CompanyController');

    Route::post('/users/{username}/companies/attach-all', 'UserController@attachAllCompaniesToUser');
    Route::post('/users/{username}/companies/detach-all', 'UserController@detachAllCompaniesFromUser');
    Route::post('/users/{username}/companies', 'UserController@associateCompanyToUser');
    Route::get('/users/search', 'UserController@search')->name('users.search');
    Route::resource('/users', 'UserController')->parameters([
        'username' => 'username'
    ]);
});
