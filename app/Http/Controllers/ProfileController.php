<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\ReportProfile;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->profile = new Profile();
        $this->reportprofile = new ReportProfile();
     }





    public function index()
    {
        $profiles=$this->profile->all();
        
        return view('profile/index',compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
       
        $reg_profile=$this->profile->create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'dob'=>$request->dob,
            'gender'=>$request->gender

         ]);
        
        
         if($reg_profile){
           
            return response()->json(['success' => 'Profile created successfully.']);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $profile = $this->profile->find($id);
       
        return view('profile.show',['profile'=>$profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = $this->profile->find($id);
        
       
        return view('profile.edit', compact('profile'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profile = $this->profile->find($id)->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'dob'=>$request->dob,
            'gender'=>$request->gender
        ]);
        return redirect()->route('profile.index')->with('success', 'Action performed successfully!');
         
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        
       
        $rels=$this->reportprofile->select('*')
        ->where('profile_id',$id)
        ->get();
       
        
        if(count($rels)>0){
            return redirect()->route('profile.index')->with('erro', 'This profile is already related to a report or more!');
        }else{
            $del=$this->profile->destroy($id);
            return redirect()->route('profile.index')->with('success', 'Action performed successfully!');

        }



    }
}
