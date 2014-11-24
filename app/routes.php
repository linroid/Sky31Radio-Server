<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});
Route::controller('/api', 'ApiController');
Route::group(['prefix'=>'admin', 'namespace'=>'Admin'], function(){

    Route::get('/logout',['as'=>'admin.logout', 'uses'=>'AdminController@logout']);
    Route::get('/', ['as'=>'admin.home', 'uses'=>'AdminController@index']);
    Route::get('/setting', ['as'=>'admin.setting', 'uses'=>'AdminController@setting']);
    Route::put('/update', ['as'=>'admin.update', 'uses'=>'AdminController@update']);

    Route::resource('user', 'UserController');
    Route::resource('album', 'AlbumController');
    Route::resource('program', 'ProgramController');
    Route::resource('audio', 'AudioController');
    Route::resource('comment', 'CommentController');

    Route::controller('/', 'AdminController');
    Route::get('/comment', ['as'=>'admin.comment', 'uses'=>'CommentController@index']);
});
