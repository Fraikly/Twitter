<?php

use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\LikesForCommentController;
use App\Http\Controllers\Api\ReCommentsController;
use App\Http\Controllers\Api\RetwitsController;
use App\Http\Controllers\Api\SubscribersController;
use App\Http\Controllers\api\SubscriptionsController;
use \App\Http\Controllers\Api\TwitsController;
use \App\Http\Controllers\Api\UsersController;
use \App\Http\Controllers\Api\LikesForTwitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group(['prefix'=>'/users'],function (){
    Route::post('',[UsersController::class,'index']);

    Route::group(['prefix'=>'/{user}'],function (){
        Route::post('',[UsersController::class,'show']);
        Route::post('/update',[UsersController::class,'update']);
        Route::post('/delete',[UsersController::class,'destroy']);

        Route::group(['prefix'=>'/subscriptions'],function (){
            Route::post('',[SubscriptionsController::class,'index']);
            Route::post('/delete',[SubscriptionsController::class,'destroy']);
            Route::post('/store',[SubscriptionsController::class,'store']);
        });

        Route::group(['prefix'=>'/subscribers'],function (){
            Route::post('',[SubscribersController::class,'index']);
            Route::post('/delete',[SubscribersController::class,'destroy']);
        });

    });

});

Route::group(['prefix'=>'/twits'],function (){

    Route::post('/store', [TwitsController::class,'store']);
    Route::group(['prefix'=>'/{twit}'],function (){
        Route::post('', [TwitsController::class,'show']);
        Route::post('/update', [TwitsController::class,'update']);
        Route::delete('/delete', [TwitsController::class,'destroy']);


        Route::group([ 'prefix' => '/likes'], function () {
            Route::post('/store', [LikesForTwitController::class,'store']);
            Route::post('/delete', [LikesForTwitController::class,'destroy']);
        });

        Route::group(['prefix' => '/retwits'], function () {
            Route::post('/store', [RetwitsController::class,'store']);
        });


        Route::group(['prefix' => '/comments'], function () {
            Route::post('/store', [CommentsController::class,'store']);
            Route::post('', [CommentsController::class,'index']);

            Route::group(['prefix' => '/{comment}'], function () {
                Route::post('/delete', [CommentsController::class,'destroy']);
                Route::post('/update', [CommentsController::class,'update']);

                Route::group(['prefix' => '/likes'], function () {
                Route::post('/store', [LikesForCommentController::class,'store']);
                Route::post('/delete', [LikesForCommentController::class,'destroy']);

            });
            Route::group(['prefix' => '/recomments'], function () {
                Route::post('/store', [ReCommentsController::class,'store']);
            });
        });
    });


});
});
