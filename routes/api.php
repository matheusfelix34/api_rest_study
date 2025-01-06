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

Route::get('/users', [App\Http\Controllers\Api\UserController::class, 'index']);

Route::group(['prefix' => 'products/'], function () {

    Route::get('/', [App\Http\Controllers\Api\ProductController::class, 'index']);
    Route::get('/{id}', [App\Http\Controllers\Api\ProductController::class, 'show']);
    Route::put('/{id}/{name}', [App\Http\Controllers\Api\ProductController::class, 'update']);
    Route::post('/', [App\Http\Controllers\Api\ProductController::class, 'store'])->middleware('auth.basic');
    Route::delete('/{id}',[App\Http\Controllers\Api\ProductController::class, 'delete']);


});



Route::group(['prefix' => 'v1/'], function () {

    Route::group(['prefix' => 'real-state/'], function () {
   
        Route::get('/', [App\Http\Controllers\Api\RealStateController::class, 'index']);
   

    });
});

