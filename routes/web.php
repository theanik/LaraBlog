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

Route::get('/', 'HomeController@index')->name('home');

Route::post('subscriber','SubscriberController@store')->name('subscriber.store');
Route::get('post/{slug}','PostController@details')->name('post.details');
Route::get('posts','PostController@index')->name('posts');
Route::get('category/{slug}','PostController@post_by_category')->name('category.post');
Route::get('tag/{slug}','PostController@post_by_tag')->name('tag.post');
Route::get('search','SearchController@index')->name('search');
Route::get('profile/{username}','AuthorController@index')->name('author.profile');
Auth::routes();

Route::group(['middleware'=>['auth']],function(){
    Route::post('favorite/{post}/add','FavoriteController@add')->name('post.favorite');
    Route::post('comment/{post}','CommentController@index')->name('comment.store');
});

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as'=>'admin.','prefix' => 'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function () {
    Route::get('dashboard','DashBoardController@index')->name('dashboard');
    Route::resource('tag', 'TagController');
    Route::resource('category','CategoryController');
    Route::resource('post','PostController');

    Route::get('alladmin','AllAdminController@index')->name('admins.index');
    Route::get('alladmin/create','AllAdminController@createnew')->name('admins.createnew');
    Route::post('alladmin/store','AllAdminController@store')->name('admins.store');
    Route::delete('alladmin/{id}','AllAdminController@delete')->name('admins.delete');

    Route::get('authors','AuthorController@index')->name('authors.index');
    Route::delete('authors/{id}','AuthorController@delete')->name('authors.delete');

    Route::get('pending/post','PostController@pending')->name('post.pending');
    Route::put('post/{id}/approve','PostController@approve')->name('post.approve');
    Route::put('post/{id}/published','PostController@published')->name('post.published');

    Route::get('/subscriber','SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{id}','SubscriberController@delete')->name('subscriber.delete');

    Route::get('settings','SettingsController@index')->name('settings');
    Route::put('profile-update','SettingsController@profileUpdate')->name('profile.update');
    Route::put('password-update','SettingsController@passwordUpdate')->name('password.update');
});

Route::group(['as'=>'author.','prefix' => 'author','namespace'=>'Author','middleware'=>['auth','author']], function () {
    Route::get('dashboard','DashBoardController@index')->name('dashboard');
    Route::resource('post','PostController');

    Route::get('settings','SettingsController@index')->name('settings');
    Route::put('profile-update','SettingsController@profileUpdate')->name('profile.update');
    Route::put('password-update','SettingsController@passwordUpdate')->name('password.update');
});

View::composer('layouts.frontend.partial.footer', function ($view) {
    $categories = App\Category::take(9)->get();
    $view->with('categories',$categories);
});