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

Route::get('/', 'PagesController@RenderHomePage');
Auth::routes();
Route::get('/timeline', [

		'as' => 'timeline',
		'uses' => 'PagesController@RenderTimeline'
]);
Route::get('/search', [
	'as' => 'search.results',
	'uses' => 'SearchController@getResults'

]);
Route::get('/profile', 'PagesController@RenderProfile');
Route::get('/user/{username}', [
	'as' => 'user.profile',
	'uses' => 'ProfileController@getProfile'

]);

Route::get('/profile/edit', [
	'as' => 'profile.edit',
	'uses' => 'ProfileController@getEdit'

]);

Route::post('/profile/edit', [
	'uses' => 'ProfileController@postEdit'

]);
Route::get('/friends','FriendController@getFriends');

Route::get('/friends/add/{username}', [
	'as' => 'add.as.friend',
	'uses' => 'FriendController@Add'

]);


Route::get('/friends/accept/{username}', [
	'as' => 'accepted.friend',
	'uses' => 'FriendController@Accept'

]);

Route::get('/friends/ignore/{username}', [
	'as' => 'ignore.friend',
	'uses' => 'FriendController@Ignore'

]);