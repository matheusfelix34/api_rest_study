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
Route::post('/cad_profile',function(Request $request){
   
        
        $profileController = new ProfileController();
        $profileController->store($request);
        
        return json_encode(1);


  
    });

Route::post('/cad_report',function(Request $request){
   
        
        $reportController = new ReportController();
      
        return json_encode($reportController->store($request));


  
    });


 

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/test',function(Request $request){
    //dd($request->headers->all());
   // dd($request->headers->get('authorization'));
    $response= new \Illuminate\Http\Response(['msg'=>'Second API response']);
  
        return $response ;
});

// Route::get('/test', function(Request $request){

// 	dd($request->headers->all());
// 	//dd($request->headers->get('Authorization'));

// 	$response = new \Illuminate\Http\Response(json_encode(['msg' => 'Minha primeira resposta de API']));
// 	$response->header('Content-Type', 'application/json');

// 	return $response;
// });

