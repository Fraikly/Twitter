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


Auth::routes();

Route::group(['namespace' => 'App\Http\Controllers\Home', 'prefix' => ''], function () {
    Route::get('/', 'IndexController')->name('home');
});


Route::group(['namespace' => 'App\Http\Controllers\Users', 'prefix' => '/users'], function () {
    Route::get('', 'IndexController')->name('users.index');
    Route::get('/{user}', 'ShowController')->name('users.show');
    Route::get('/{user}/edit', 'EditController')->name('users.edit');
    Route::patch('/{user}/update', 'UpdateController')->name('users.update');
    Route::delete('/{user}/delete', 'DestroyController')->name('users.delete');

    Route::group(['namespace' => 'Subscribers', 'prefix' => '/{user}/subscribers'], function () {
        Route::post('/store', 'StoreController')->name('subscribers.store');
        Route::delete('/delete', 'DestroyController')->name('subscribers.delete')->middleware('auth');
        Route::get('', 'IndexController')->name('subscribers.index');
    });

    Route::group(['namespace' => 'Subscriptions', 'prefix' => '/{user}/subscriptions'], function () {
        Route::get('', 'IndexController')->name('subscriptions.index');
        Route::delete('/delete', 'DestroyController')->name('subscriptions.delete')->middleware('auth');;
    });


});
Route::group(['namespace' => 'App\Http\Controllers\Twits', 'prefix' => '/twits','middleware'=>'auth'], function () {
    Route::get('/create', 'CreateController')->name('twits.create');
    Route::post('/store', 'StoreController')->name('twits.store');
    Route::get('/{twit}/edit', 'EditController')->name('twits.edit');
    Route::patch('/{twit}/update', 'UpdateController')->name('twits.update');
    Route::delete('/{twit}/delete', 'DestroyController')->name('twits.delete');
});


