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

/*Route::get('/', function (){
    //Redis::set('friend', 'momo');
    //dd(Redis::get('friend'));

    //Redis::lpush('frameworks', ['vuejs', 'laravel']);
    //dd(Redis::lrange('frameworks', 0, -1));

    //Redis::sadd('frontend-frameworks', ['angular', 'react']);
    //dd(Redis::smembers('frontend-frameworks'));
});*/

Route::get('/', 'FrontendController@welcome')->name('index');

Route::get('logout', function () {
    auth()->logout();
    return redirect('/');
});

Auth::routes();
Route::get('register/confirm', 'ConfirmEmailController@index')->name('confirm-email');
Route::get('home', 'HomeController@index')->name('home');
