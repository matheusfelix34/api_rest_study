<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\RealStateRequest;
use App\Models\RealState;
use App\Models\RealStateCategory;
use App\Models\RealStatePhoto;
use App\Models\User;
use Illuminate\Http\Request;


class RealStateController extends Controller
{

    private $realState;

    public function __construct(RealState $realState)
    {
        $this->realState = $realState;
    }

    public function index(){
     
        $realStates=auth('api')->user()->real_state();
       
        return response()->json($realStates->paginate('10'), 200) ;
    }
    

    public function store(Request $request){
        
        $data = $request->all();
        $images=$request->file('images');
       
        try {

            $data['user_id']=auth('api')->user()->id;
            $realState=$this->realState->create($data);

            if(isset($data['categories']) || count($data['categories'])) {
                $realState->categories()->sync($data['categories']);
            }

            if($images){

                $imagesUploaded=[];

                foreach ($images as $image) {

                    $path=$image->store('images', 'public');

                    $imagesUploaded[]= ['photo'=> $path ,'is_thumb'=> false];
                }
                
                $realState->photos()->createMany($imagesUploaded);
            }
            

            return response()->json(['data' => 
            
                    ['msg'=> 'Imovel cadastrado com sucesso!']
        ], 200) ;
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(),401) ;
        }
        
    }

    public function update($id,RealStateRequest $request){
       
        abort(404,"de ruim");
        $data = $request->all();
        

        $images=$request->file('images');
        try {

            
            
            
            $realState=auth('api')->user()->real_state()->where('id',$id)->firstOrFail();
            
            
            if(isset($data['categories']) || count($data['categories'])) {
                $realState->categories()->sync($data['categories']);
            }

            $realState->update($data);


            if($images){

                $imagesUploaded=[];

                foreach ($images as $image) {

                    $path=$image->store('images', 'public');

                    $imagesUploaded[]= ['photo'=> $path ,'is_thumb'=> false];
                }
                
                $realState->photos()->createMany($imagesUploaded);
            }
            
            return response()->json(['data' => 
            
                    ['msg'=> 'Imovel atualizado com sucesso!']
        ], 200) ;
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(),401) ;
        }
        
    }
    
    public function destroy($id){
       
        try {

            
            $realState=auth('api')->user()->real_state->where('id',$id)->firstOrFail();
           RealStateCategory::where('real_state_id', $realState->id)->delete();
           RealStatePhoto::where('real_state_id',$realState->id)->delete();
            $realState->delete();
            return response()->json(['data' => 
            
                    ['msg'=> 'Imovel deletado com sucesso!']
        ], 200) ;
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(),401) ;
        }
        
    }

    public function show($id){
       
        try {

            
            $realState=auth('api')->user()->real_state()->with('photos')->findOrFail($id);
           
          

            return response()->json(['data' => 
            
                    ['msg'=> 'Imovel localizado com sucesso!',
                     'data'=> $realState   
                    
                    ]
        ], 200) ;
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(),401) ;
        }
        
    }

    
}
