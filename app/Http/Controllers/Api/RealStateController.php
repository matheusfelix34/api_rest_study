<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\RealStateRequest;
use App\Models\RealState;
use Illuminate\Http\Request;


class RealStateController extends Controller
{

    private $realState;

    public function __construct(RealState $realState)
    {
        $this->realState = $realState;
    }

    public function index(){
        return response()->json($this->realState->paginate('10'), 200) ;
    }
    

    public function store(Request $request){

        $data = $request->all();
        $images=$request->file('images');
      
        try {

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
       
        $data = $request->all();
        $images=$request->file('images');
        try {

            
            $realState=$this->realState->findOrFail($id);

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

            
            $realState=$this->realState->findOrFail($id);
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

            
            $realState=$this->realState->with('photos')->findOrFail($id);

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
