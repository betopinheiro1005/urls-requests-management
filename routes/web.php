<?php

use Illuminate\Support\Facades\Route;

Route::get('/tasks', 'TaskController@update_requests')->name('update.all');
Route::get('/tasks/{id}', 'TaskController@update_request')->name('update.one');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/urls', 'UrlController@index')->name('urls.index');
    Route::get('/urls/create', 'UrlController@create')->name('urls.create');
    Route::get('/urls/{id}', 'UrlController@show')->name('urls.show');
    Route::post('/urls', 'UrlController@store')->name('urls.store');
    Route::get('/urls/edit/{id}', 'UrlController@edit')->name('urls.edit');
    Route::put('/urls/{id}', 'UrlController@update')->name('urls.update');
    Route::delete('/urls/{id}', 'UrlController@destroy')->name('urls.destroy');
});


// Rotas protegidas (somente acessadas pelo administrador)

Route::group(['middleware' => ['auth', 'check.permissions1']], function () {
    Route::get('/users/create', 'UserController@create')->name('users.create');
    Route::post('/users/store', 'UserController@store')->name('users.store');
    Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::put('/users/{user}', 'UserController@update')->name('users.update');
    Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');

    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/{user}', 'UserController@show')->name('users.show');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
