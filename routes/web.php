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

// Route::get('/', function () {
//    return view('welcome');
// });

Route::get('/', 'ChatController@index')->middleware('auth');

Route::get('chat/create', 'ChatController@add')->middleware('auth');
Route::post('chat/create', 'ChatController@create')->middleware('auth');
Route::get('chat/edit', 'ChatController@edit')->middleware('auth');
Route::post('chat/edit', 'ChatController@update')->middleware('auth');
Route::get('chat/delete', 'ChatController@delete')->middleware('auth');

Auth::routes();

Route::get('chat/index', 'ChatController@index')->middleware('auth');

// Route::get('/home', 'ChatController@index')->name('home');
