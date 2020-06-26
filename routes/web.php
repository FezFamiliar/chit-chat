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

Route::get('/', 'PagesController@RenderHomePage')->middleware('guest');
Auth::routes();
Route::get('/timeline', [

		'as' => 'timeline',
		'uses' => 'PagesController@RenderTimeline'
])->middleware('auth');
Route::get('/search', [
	'as' => 'search.results',
	'uses' => 'SearchController@getResults'

])->middleware('auth');
Route::get('/profile', 'PagesController@RenderProfile')->middleware('auth');
Route::get('/user/{username}', [
	'as' => 'user.profile',
	'uses' => 'ProfileController@getProfile'

])->middleware('auth');

Route::get('/profile/edit', [
	'as' => 'profile.edit',
	'uses' => 'ProfileController@getEdit'

])->middleware('auth');

Route::post('/profile/edit', [
	'uses' => 'ProfileController@postEdit'

])->middleware('auth');
Route::get('/friends','FriendController@getFriends')->middleware('auth');

Route::get('/friends/add/{username}', [
	'as' => 'add.as.friend',
	'uses' => 'FriendController@Add'

])->middleware('auth');


Route::get('/friends/accept/{username}', [
	'as' => 'accepted.friend',
	'uses' => 'FriendController@Accept'

])->middleware('auth');

Route::get('/friends/ignore/{username}', [
	'as' => 'ignore.friend',
	'uses' => 'FriendController@Ignore'

])->middleware('auth');


Route::get('/friends/unfriend/{username}', [
	'as' => 'unfriend.friend',
	'uses' => 'FriendController@Unfriend'

])->middleware('auth');


Route::post('/post', [
	'as' => 'post.it',
	'uses' => 'PostsController@Post'

])->middleware('auth');

Route::post('/reply/{postid}', [
	'as' => 'reply.post',
	'uses' => 'PostsController@postReply'

])->middleware('auth');


Route::get('/post/like/{postid}', [
	'as' => 'like.post',
	'uses' => 'PostsController@getLike'

])->middleware('auth');


Route::get('/show/likes/{postid}', [
	'as' => 'show.likes.post',
	'uses' => 'PostsController@showLikes'

])->middleware('auth');



Route::get('/post/delete/{postid}', [
	'as' => 'delete.post',
	'uses' => 'PostsController@DeletePost'

])->middleware('auth');

Route::post('/post/edit/', [
	'as' => 'edit.post',
	'uses' => 'PostsController@EditPost'

])->middleware('auth');
Route::get('/settings', [

		'as' => 'settings',
		'uses' => 'SettingsController@getSettings'
])->middleware('auth');

Route::post('/toggle/{s_id}', [

		'as' => 'toggle',
		'uses' => 'SettingsController@toggleSettings'
])->middleware('auth');


Route::get('/channel', function(){

	return view('pages.channel');
});


Route::post('/send', [
	'as' => 'send.messages',
	'uses' => 'ChatController@exec'

])->middleware('auth');