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

//change to /articles
Route::get('/articles', [
    'as' => 'get_articles',
    'uses' => 'ArticlesController@get_articles'
]);

Route::get('/articles/create', [
    'as' => 'get_articles_create',
    'uses' => 'ArticlesController@get_articles_create'
]);

Route::post('/articles/create', [
    'as' => 'post_articles_create',
    'uses' => 'ArticlesController@post_articles_create'
]);

Route::get('/articles/edit/{slug}', [
    'as' => 'get_articles_edit',
    'uses' => 'ArticlesController@get_articles_edit'
]);

Route::post('/articles/edit', [
    'as' => 'post_articles_edit',
    'uses' => 'ArticlesController@post_articles_edit'
]);

Route::get('/articles/delete/{slug}', [
    'as' => 'get_articles_delete',
    'uses' => 'ArticlesController@get_articles_delete'
]);

Route::get('/articles/{slug}', [
    'as' => 'get_article',
    'uses' => 'ArticlesController@get_article'
    ]);

Route::post('store',[
    'as' => 'post_upload_image',
    'uses' => 'ImagesController@store'
]);

Route::get('/hiring', [
    'as' => 'get_hiring',
    'uses' => 'StaticController@get_hiring'
]);

Route::get('/about', [
    'as' => 'get_about',
    'uses' => 'StaticController@get_about'
]);

Route::get('/contact', [
    'as' => 'get_contact',
    'uses' => 'ContactController@get_contact'
]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
