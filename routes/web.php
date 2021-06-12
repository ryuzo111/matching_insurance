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

/*
* ログイン前
*/
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/post', 'PostController@index')->name('post.index');
Route::get('/post/search', 'PostController@search')->name('post.search');
Route::get('/post/detail/', 'PostController@detail')->name('post.detail');
Route::get('/profile/{id}', 'ProfileController@detail')->name('profile');

/*
* ログイン後
*/
Route::group(['prefix' => 'post', 'middleware' => 'auth:user'], function () {
    Route::get('/create', 'PostController@create')->name('post.create');
    Route::post('/create', 'PostController@store');

    Route::get('/edit/{post}', 'PostController@edit')->name('post.edit');
    Route::post('/edit/{post}', 'PostController@update');

    Route::post('/delete/{post}', 'PostController@delete')->name('post.delete');

    Route::group(['prefix' => 'comment', 'middleware' => 'auth:user'], function () {
        Route::post('/', 'CommentController@comment')->name('post.comment');
        Route::get('/delete', 'CommentController@delete')->name('comment.delete');
        Route::get('/edit', 'CommentController@editForm')->name('comment.edit_form');
        Route::post('/edit', 'CommentController@edit')->name('comment.edit');
        Route::get('/good', 'CommentController@good')->name('comment.good');
        Route::get('/good/delete', 'CommentController@deleteGood')->name('comment.delete_good');
    });
});

/*
* Admin
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::get('home', 'Admin\HomeController@index')->name('admin.home');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login');
    Route::get('logout', function () {
        return abort(404);
    });
});
