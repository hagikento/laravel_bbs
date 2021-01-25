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

Route::get('/','PostsController@index')->name('top');

Route::resource('posts','PostsController',['only'=>['create','store','show','edit','update','destroy']])
    ->middleware('auth');

Route::resource('posts','PostsController',['only'=>['show']]);



Route::resource('comments', 'CommentsController', ['only' => ['store','edit','update','destroy']])
    ->middleware('auth');
Auth::routes();

Route::get('/home/auth', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('hello','HelloController@getLogin');

Route::post('hello','HelloController@postLogin');

Route::get('hello/logout','HelloController@getLogout');

Route::get('hello/register',"HelloController@register");

Route::post('hello/register',"HelloController@store");

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/welcome','HomeController@welcome');

Route::get('/comment/like/{id}', 'CommentsController@like')->name('comment.like');
Route::get('/comment/unlike/{id}', 'CommentsController@unlike')->name('comment.unlike');
