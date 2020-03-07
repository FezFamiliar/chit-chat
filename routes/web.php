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
Route::get('/timeline', 'PagesController@RenderTimeline');
Route::get('/friends', 'PagesController@RenderFriends');
Route::get('/search', [
	'as' => 'search.results',
	'uses' => 'SearchController@GetResults'

]);
