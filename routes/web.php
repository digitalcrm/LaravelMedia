<?php


Route::get('/', function () {
    return view('welcome');
});

//syntax for accessing view file without controller Route::view('urlname','views file name'); 
Route::get('profile','AvatarController@index')->name('profile');

//create resource controller
Route::resource('avatar','AvatarController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
