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

Route::group(['prefix' => 'Api/'], function () {

    Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'index']);

});

