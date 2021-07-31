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

Route::get('/', 'PostController@index');

Auth::routes();

/*
 * ログイン前
 */
Route::get('/home', 'PostController@index')->name('home');
Route::get('/post', 'PostController@index')->name('post.index');
Route::get('/post/search', 'PostController@search')->name('post.search');
Route::get('/post/detail/', 'PostController@detail')->name('post.detail');
Route::get('/profile/{id}', 'ProfileController@detail')->name('profile');
Route::get('contact', 'ContactController@contactForm')->name('contact.contact_form');
Route::post('contact', 'ContactController@contact')->name('contact.contact');
Route::get('/ranking/comment', 'RankingController@comment')->name('ranking.comment');
Route::get('/ranking/user', 'RankingController@user')->name('ranking.user');

Route::get('promotion', function () {
	return view('description.promotion');
})->name('promotion');
Route::get('prohibition', function () {
	return view('description.prohibition');
})->name('prohibition');

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

Route::group(['prefix' => 'profile', 'middleware' => 'auth:user'], function () {
	Route::get('/edit/{id}', 'ProfileController@edit')->name('profile.edit');
	Route::post('/edit/{id}', 'ProfileController@update');
	Route::get('/edit_pass/{id}', 'ProfileController@edit_pass')->name('profile.edit_pass');
	Route::post('/edit_pass/{id}', 'ProfileController@update_pass');
	Route::get('/image_delete/{id}', 'ProfileController@image_delete')->name('profile.image_delete');
});

Route::group(['prefix' => 'family_ins', 'middleware' => 'auth:user'], function () {
	Route::get('/create', 'FamilyInsController@create')->name('family_ins.create');
	Route::post('/create', 'FamilyInsController@store');
	Route::get('/edit', 'FamilyInsController@edit')->name('family_ins.edit');
	Route::post('/edit', 'FamilyInsController@update');
	Route::get('/delete', 'FamilyInsController@delete')->name('family_ins.delete');
});

Route::group(['prefix' => 'chat', 'middleware' => 'auth:user'], function () {

	// Route::get('/{receive_user}/{send_user}', 'ChatController@index')->name('chat.index');
	Route::get('/', 'ChatController@index')->name('chat.index');
	// Route::post('/{receive_user}/{send_user}/store', 'ChatController@store')->name('chat.store');

	Route::get('/{receive_user}/{send_user}/messages_list_api', 'ChatController@getData');
	Route::post('/{receive_user}/{send_user}/send_message_api', 'ChatController@sendMessage');
	Route::post('/{receive_user}/{send_user}/remove_message_api', 'ChatController@removeMessage');
	Route::post('/{receive_user}/{send_user}/edit_message_api', 'ChatController@editMessage');

	Route::get('/list', 'ChatController@list')->name('chat.list');

});


Route::group(['prefix' => 'relationship', 'middleware' => 'auth:user'], function () {
	Route::get('/following', 'RelationshipController@following')->name('following');//フォロー中
	Route::get('/followers', 'RelationshipController@followers')->name('followers');//フォロワー
	Route::get('/follow', 'RelationshipController@follow')->name('follow');
	Route::get('/unfollow', 'RelationshipController@unfollow')->name('unfollow');
});

/*
 * Admin
 */
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
	Route::get('home', 'Admin\HomeController@index')->name('admin.home');
	Route::get('contact', 'ContactController@index')->name('contact.index');
	Route::get('answer', 'ContactController@showAnswerForm')->name('contact.show_answer_form');
	Route::post('answer', 'ContactController@answer')->name('contact.answer');
	Route::get('status', 'ContactController@changeStatus')->name('contact.change_status');
	Route::get('/profile/{id}', 'ProfileController@adminOnlyDetail')->name('admin.profile');
});

Route::group(['prefix' => 'admin'], function () {
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
	Route::get('logout', function () {
		return abort(404);
	});
});
