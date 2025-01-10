<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        try {

            $realState=$this->realState->create($data);

            return response()->json(['data' => 
            
                    ['msg'=> 'Imovel cadastrado com sucesso!']
        ], 200) ;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()],401) ;
        }
        
    }

    public function update($id,Request $request){
        $data = $request->all();
        try {

            
            $realState=$this->realState->findOrFail($id);
            $realState->update($data);
            return response()->json(['data' => 
            
                    ['msg'=> 'Imovel atualizado com sucesso!']
        ], 200) ;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()],401) ;
        }
        
    }

    public function destroy($id,Request $request){
        $data = $request->all();
        try {

            
            $realState=$this->realState->findOrFail($id);
            $realState->delete();
            return response()->json(['data' => 
            
                    ['msg'=> 'Imovel deletado com sucesso!']
        ], 200) ;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()],401) ;
        }
        
    }

    public function show($id,Request $request){
        $data = $request->all();
        try {

            
            $realState=$this->realState->findOrFail($id);
            $realState->update($data);
            return response()->json(['data' => 
            
                    ['msg'=> 'Imovel localizado com sucesso!',
                     'data'=> $realState   
                    
                    ]
        ], 200) ;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()],401) ;
        }
        
    }

    
}
