<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
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



Route::get('/test',function(Request $request){
    //dd($request->headers->all());
   // dd($request->headers->get('authorization'));
    $response= new \Illuminate\Http\Response(['msg'=>'Second API response']);
  
        return $response ;
});



Route::group(['prefix' => 'products/'], function () {

    Route::get('/', [App\Http\Controllers\Api\ProductController::class, 'index']);
    Route::get('/{id}', [App\Http\Controllers\Api\ProductController::class, 'show']);
    Route::put('/{id}/{name}', [App\Http\Controllers\Api\ProductController::class, 'update']);
    Route::post('/', [App\Http\Controllers\Api\ProductController::class, 'store'])->middleware('auth.basic');
    Route::delete('/{id}',[App\Http\Controllers\Api\ProductController::class, 'delete']);


});



Route::group(['prefix' => 'v1/'], function () {

    Route::group(['prefix' => 'real-states'], function () {
   
        Route::get('/', [App\Http\Controllers\Api\RealStateController::class, 'index']);
        Route::get('/{id}', [App\Http\Controllers\Api\RealStateController::class, 'show']);
        Route::post('/', [App\Http\Controllers\Api\RealStateController::class, 'store']);
        Route::put('/{id}', [App\Http\Controllers\Api\RealStateController::class, 'update']);
        Route::delete('/{id}', [App\Http\Controllers\Api\RealStateController::class, 'destroy']);


    });


    Route::group(['prefix' => 'users'], function () {
   
        Route::get('/', [App\Http\Controllers\Api\UserController::class, 'index']);
        Route::get('/{id}', [App\Http\Controllers\Api\UserController::class, 'show']);
        Route::post('/', [App\Http\Controllers\Api\UserController::class, 'store']);
        Route::put('/{id}', [App\Http\Controllers\Api\UserController::class, 'update']);
        Route::delete('/{id}', [App\Http\Controllers\Api\UserController::class, 'destroy']);


    });


    Route::group(['prefix' => 'categories'], function () {
   
        Route::get('/', [App\Http\Controllers\Api\CategoryController::class, 'index']);
        Route::get('/{id}', [App\Http\Controllers\Api\CategoryController::class, 'show']);
        Route::post('/', [App\Http\Controllers\Api\CategoryController::class, 'store']);
        Route::put('/{id}', [App\Http\Controllers\Api\CategoryController::class, 'update']);
        Route::delete('/{id}', [App\Http\Controllers\Api\CategoryController::class, 'destroy']);
        Route::get('/{id}/real_states', [App\Http\Controllers\Api\CategoryController::class, 'realStates']);


    });

    Route::group(['prefix' => 'photos'], function () {
   
        /*Route::get('/', [App\Http\Controllers\Api\RealStatePhotoController::class, 'index']);
        Route::get('/{id}', [App\Http\Controllers\Api\RealStatePhotoController::class, 'show']);
        Route::post('/', [App\Http\Controllers\Api\RealStatePhotoController::class, 'store']);
       */
        Route::put('set-thumb/{photoId}/{realStateId}', [App\Http\Controllers\Api\RealStatePhotoController::class, 'setThumb']);
        Route::delete('/{id}', [App\Http\Controllers\Api\RealStatePhotoController::class, 'remove']);

    });

});

