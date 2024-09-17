<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Profile;
use App\Models\ReportProfile;
use App\Jobs\GeneratePdf10Emailjob;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->report = new Report();
        $this->profile = new Profile();
        $this->reportprofile = new ReportProfile();
     }


    public function index()
    {
        $reports=$this->report->all();
       
        return view('report/index',compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profiles = $this->profile->all();
        
        return view('report.create',compact('profiles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reg_report=$this->report->create([
            'title'=>$request->title,
            'description'=>$request->description,
         ]);

         if($reg_report){

            $profiles_array=$request->profiles;

           

            for ($i=0; $i <count($profiles_array) ; $i++) { 
                $reg_reportprofile= new ReportProfile();
                $reg_reportprofile->report_id=$reg_report->id;
                $reg_reportprofile->profile_id=$profiles_array[$i];
                $reg_reportprofile->save();
            }
           
            
            if($reg_reportprofile){
               
                
                $id=$reg_report->id;
                //$report = $this->report->find($reg_report->id);
                \App\Jobs\GeneratePdf10Emailjob::dispatch($request->title,$request->description)->delay(now()->addSeconds(10));

                return 1;


            }else{
                $this->report->destroy($id);
               
                return 0;
            }
           
           
        }else{
            return 0;
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
        
        $report = $this->report->find($id);

        $profiles_id= $this->reportprofile->select('profile_id')
        ->where('report_id',$id)
        ->get()
        ->pluck('profile_id')
        ;
    
        $profiles= $this->profile->select('*')
        ->whereIn('id',$profiles_id)
        ->get();
       
       
        return view('report.show',['report'=>$report,'profiles'=>$profiles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $report = $this->report->find($id);
       
        
        $profiles_id= $this->reportprofile->select('profile_id')
        ->where('report_id',$id)
        ->get()
        ->pluck('profile_id')
        ;
        $profiles= $this->profile->all();
        $profiles_id= $profiles_id->toArray();
      
       
        return view('report.edit', compact('report','profiles','profiles_id'));
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
       
        $report = $this->report->find($id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
        ]);

        $res=$this->reportprofile::where('report_id',$id)->delete();

        $profiles_id=$request->profiles;
       
        for ($i=0; $i <count($profiles_id) ; $i++) { 
            $reg_reportprofile= new ReportProfile();
            $reg_reportprofile->report_id=$id;
            $reg_reportprofile->profile_id=$profiles_id[$i];
            $reg_reportprofile->save();
        }


        return redirect()->route('report.index')->with('success', 'Action performed successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del=$this->report->destroy($id);
        $res=$this->reportprofile::where('report_id',$id)->delete();
        return redirect()->route('report.index')->with('success', 'Action performed successfully!');
        // $rels=$this->reportprofile->select('*')
        // ->where('profile_id',$id)
        // ->get();
       
        
        // if(count($rels)>0){
        //     return redirect()->route('profile.index')->with('erro', 'This profile is already related to a report or more!');
        // }else{
        //     $del=$this->profile->destroy($id);
        //     return redirect()->route('profile.index')->with('success', 'Action performed successfully!');

        // }
    }
}
