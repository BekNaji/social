<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Auth::routes();


Route::middleware(['auth'])->group(function()
{
	Route::get('/home','HomeController@index')->name('home');

	// Post route
	Route::post('post/strore','PostController@store')->name('post.store');
	Route::post('post/remove','PostController@remove')->name('post.remove');
	Route::get('post/edit/{id}','PostController@edit')->name('post.edit');
	Route::get('post/show/{id}','PostController@show')->name('post.show');
	Route::post('post/update','PostController@update')->name('post.update');
	Route::get('post/rating','PostController@rating')->name('post.rating');
	Route::get('post/rating/count','PostController@postRatingCount')->name('post.rating.count');


	// comment
	Route::post('comment/store','CommentController@store')->name('comment.store');
	Route::post('comment/update','CommentController@update')->name('comment.update');
	Route::post('comment/remove','CommentController@remove')->name('comment.remove');
	Route::get('comment/count','CommentController@commentCount')->name('comment.count');
	Route::get('get/comments','CommentController@getComments')->name('get.comments');
	Route::get('get/comment','CommentController@getComment')->name('get.comment');


	// profile
	Route::get('profile/{id}/{name?}','ProfileController@index')->name('profile');
	Route::get('profile/edit/{id}/{name?}','ProfileController@edit')->name('profile.edit');
	Route::post('profile/update','ProfileController@update')->name('profile.update');

	// search
	Route::get('search','SearchController@search')->name('search');
	Route::get('search/result','SearchController@result')->name('search.result');

});
