<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $user;

    public function  __construct (User $user) {
        $this->user = $user;
    }
    
    public function index(){
        return response()->json($this->user->paginate('10'), 200) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data = $request->all();
        
        if (!$request->has('password') || !$request->get('password')) {
            $message = new ApiMessages("É necessário informar uma senha para o usuários!");
            return response()->json($message->getMessage(),401) ;
        }

        if (!$request->has('profile') || !$request->get('profile')) {
            $message = new ApiMessages("É necessário informar dados de perfil do usuário");
            return response()->json($message->getMessage(),401) ;
        }
      
        
        $profile=$data['profile'];
       
      
        Validator::make($profile,[
             'phone'=> 'required',
             'mobile_phone'=> 'required'
        ],["campos não forão enviados"])->validate();
        
        try {
            
            
            $data['password']=bcrypt($data['password']);
            $profile['social_networks']=serialize($data['profile']['social_networks']) ;

            $user=$this->user->create($data);

           

            $user->profile()->create(
                $profile
            );

            return response()->json(['data' => 
            
                    ['msg'=> 'Usuário cadastrado com sucesso!']
        ], 200) ;
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(),401) ;
        }
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request){
        $data = $request->all();
        try {

            
            $user=$this->user->with('profile')->findOrFail($id);
            $user->profile->social_networks= unserialize($user->profile->social_networks);
            return response()->json(['data' => 
            
                    ['msg'=> 'Usuário localizado com sucesso!',
                     'data'=> $user   
                    
                    ]
        ], 200) ;
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(),401) ;
        }
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request){
        $data = $request->all();

        if ($request->has('password') && $request->get('password')) {
           $data['password']=bcrypt($data['password']);
        }else {
            unset($data['password']);
        }


        if (!$request->has('profile') || !$request->get('profile')) {
            $message = new ApiMessages("É necessário informar dados de perfil do usuário");
            return response()->json($message->getMessage(),401) ;
        }
      
        
        $profile=$data['profile'];
       
       
        Validator::make($profile,[
            'phone'=> 'required',
            'mobile_phone'=> 'required'
        ],["campos não forão enviados"])->validate();

     
        try {

            
            $user=$this->user->findOrFail($id);

          
            //dd($data['profile']['social_networks']);
            $profile['social_networks']=serialize($data['profile']['social_networks']) ;
           // dd($profile_social_networks);

            $user->update($data);
            

            $user->profile->update($profile);

            return response()->json(['data' => 
            
                    ['msg'=> 'Usuário atualizado com sucesso!']
        ], 200) ;
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(),401) ;
        }
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
     public function destroy($id){
       
        try {

            
            $realState=$this->user->findOrFail($id);
            $realState->delete();
            return response()->json(['data' => 
            
                    ['msg'=> 'Usuário deletado com sucesso!']
        ], 200) ;
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(),401) ;
        }
        
    }
    

}
