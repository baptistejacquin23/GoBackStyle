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

Route::middleware(['auth'])->group(function () {

// Routes pour la gestion des codes
    Route::get('/code/list', 'CodeController@index')->name('list_code');
    Route::get('/code/create', 'CodeController@create')->name('create_code');
    Route::post('/code/store', 'CodeController@store')->name('store_code');
    Route::get('/code/edit/{id?}', 'CodeController@edit')->name('edit_code');
    Route::post('/code/update/{id?}', 'CodeController@update')->name('update_code');
    Route::post('/code/delete/{id?}', 'CodeController@destroy')->name('destroy_code');


    Route::get('/promotion/list', 'PromotionController@index')->name('list_promotion');
    Route::get('/promotion/create', 'PromotionController@create')->name('create_promotion');
    Route::post('/promotion/store', 'PromotionController@store')->name('store_promotion');
    Route::get('/promotion/edit/{id?}', 'PromotionController@edit')->name('edit_promotion');
    Route::post('/promotion/update/{id?}', 'PromotionController@update')->name('update_promotion');
    Route::post('/promotion/delete/{id?}', 'PromotionController@destroy')->name('destroy_promotion');

});

