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

/*Route::get('/', function () { //routeは要求された処理｛URL}に対して、どのコントローラで処理をするか
    return redirect('/articles');
}); */

Route::get('/groups','GroupController@index')->name('group.list');
Route::get('/group/new','GroupController@create')->name('group.new');
Route::get('/group/join/{id}','GroupController@join')->name('group.join');
Route::get('/group/chat/{id}','GroupController@chat')->name('group.chat');
Route::post('/group/chat{id}','GroupController@chatstore')->name('group.chatstore');
Route::post('/group','GroupController@store')->name('group.store');
Route::get('/group/status','GroupController@status')->name('group.status');
Route::get('/group/{id}','GroupController@show')->name('group.detail');

Route::get('/',function(){
    return redirect('/groups');
});

Route::get('/login/guest','Auth\LoginController@guestLogin');
Route::post('/login','Auth\LoginController@redirectPath')->name('user.signin');
Route::get('/logout', 'Auth\LoginController@getLogout');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
/*Route::get('/articles','ArticleController@index')->name('article.list');
Route::get('/article/new','ArticleController@create')->name('article.new');
Route::post('/article','ArticleController@store')->name('article.store');

Route::get('/article/edit/{id}', 'ArticleController@edit')->name('article.edit');
Route::post('/article/update/{id}', 'ArticleController@update')->name('article.update');

Route::get('/article/{id}','ArticleController@show')->name('article.show');
Route::delete('/article/{id}','ArticleController@destroy')->name('article.delete'); */
