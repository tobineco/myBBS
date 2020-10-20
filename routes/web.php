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

Route::group(['middleware' => 'auth:user'], function() {
    Route::get('/', 'ChatController@index');
    
    Route::get('chat/create', 'ChatController@add');
    Route::post('chat/create', 'ChatController@create');
    Route::get('chat/edit', 'ChatController@edit');
    Route::post('chat/edit', 'ChatController@update');
    Route::get('chat/delete', 'ChatController@delete');
    
    Route::get('chat/index', 'ChatController@index');
});

/*
|--------------------------------------------------------------------------
|  Admin ログイン前　認証不要
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function() {
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login');
});
 
/*
|--------------------------------------------------------------------------
|  Admin ログイン後
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::get('/', 'AdminController@index');
    Route::get('/index', 'AdminController@index');
    Route::get('/edit', 'AdminController@edit');
    Route::post('/edit', 'AdminController@update');
    Route::get('/delete', 'AdminController@delete');
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
});

Auth::routes();

// Route::get('/home', 'ChatController@index')->name('home');