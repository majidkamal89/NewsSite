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

Auth::routes();
Route::post('/register', ['as' => 'registerUser', 'uses' => 'UserController@store']);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/news', ['as' => 'listNews', 'uses' => 'NewsController@index']);
Route::get('/news/create', ['as' => 'createNews', 'uses' => 'NewsController@create'])->middleware('auth');
Route::post('/news/create', ['as' => 'storeNews', 'uses' => 'NewsController@store'])->middleware('auth');
Route::get('/news/{id}', ['as' => 'newsDetail', 'uses' => 'NewsController@show']);
Route::get('/posts', ['as' => 'userPosts', 'uses' => 'NewsController@userPosts'])->middleware('auth');
Route::get('/posts/delete/{id}', ['as' => 'deletePost', 'uses' => 'NewsController@destroy'])->middleware('auth');
/*Route::get('/contact', function () {
    return view('contact');
});*/
Route::get('/Newsstand', ['as' => 'newsStand', 'uses' => 'NewsController@newsStand']);
Route::get('/Newsstand/pdf/{id}', ['as' => 'newsStandPdf', 'uses' => 'NewsController@downloadPdf']);
Route::get('rss-feed', ['as' => 'rssFeeds', 'uses' => 'NewsController@getRssFeeds']);

/* Password Reset routes */
Route::get('password-reset', [
    'as' => 'resetForm',
    'uses' => 'HomeController@resetForm'
]);
Route::post('password-reset', [
    'as' => 'passwordReset',
    'uses' => 'HomeController@passwordReset'
]);
Route::get('password-reset/{token}', [
    'as' => 'passwordResetForm',
    'uses' => 'HomeController@passwordResetForm'
]);
Route::post('password-reset/{token}', [
    'as' => 'savePasswordReset',
    'uses' => 'HomeController@savePasswordReset'
]);

