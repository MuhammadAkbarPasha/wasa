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

Route::get('/{username}', function($username)
{
	return View::make('chats')->with('username',$username);
});

Route::post('sendMessage', array('uses' => 'ChatController@sendMessage'));
Route::post('isTyping', array('uses' => 'ChatController@isTyping'));
Route::post('notTyping', array('uses' => 'ChatController@notTyping'));
Route::post('retrieveChatMessages', array('uses' => 'ChatController@retrieveChatMessages'));
Route::post('retrieveTypingStatus', array('uses' => 'ChatController@retrieveTypingStatus'));