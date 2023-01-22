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

    Route::group(['namespace' => 'Likes', 'prefix' => '/{twit}/likes','middleware'=>'auth'], function () {
        Route::post('/store', 'StoreController')->name('likes.store');
        Route::delete('/delete', 'DestroyController')->name('likes.delete');
    });

    Route::group(['namespace' => 'Comments', 'prefix' => '/{twit}/comments','middleware'=>'auth'], function () {
        Route::post('/store', 'StoreController')->name('comments.store');
        Route::get('', 'IndexController')->name('comments.index');
        Route::delete('/{comment}/delete', 'DestroyController')->name('comments.delete');
        Route::get('/{comment}/edit', 'EditController')->name('comments.edit');
        Route::patch('/{comment}/update', 'UpdateController')->name('comments.update');

        Route::group(['namespace' => 'Likes', 'prefix' => '/{comment}/likes'], function () {
            Route::post('/store', 'StoreController')->name('comment.likes.store');
            Route::delete('/delete', 'DestroyController')->name('comment.likes.delete');
        });

        Route::group(['namespace' => 'ReComments', 'prefix' => '/{comment}/recomments'], function () {
            Route::get('/create', 'CreateController')->name('recomments.create');
            Route::post('/store', 'StoreController')->name('recomments.store');
        });
    });

    Route::group(['namespace' => 'Retwits', 'prefix' => '/{twit}/retwits'], function () {
        Route::get('/create', 'CreateController')->name('retwits.create');
        Route::post('/store', 'StoreController')->name('retwits.store');
    });
});


