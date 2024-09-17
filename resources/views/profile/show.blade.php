@extends('layouts/layout')

@section('content')	

	<div class="panel panel-default">
	<div class="title-show">Profile: {{ $profile->first_name ?? ''}}</div>
		<table class="table table-striped">
		    <tbody>
		      <tr>
		        <td><b>First Name</b>: {{$profile->last_name ?? ''}}<br/></td>
		      </tr>
		      <tr>
		        <td><b>Last name</b>: {{$profile->ds_orgao ?? ''}}<br/></td>
		      </tr> 
              <tr>
		        <td><b>Date of Birth</b>: {{$profile->dob ?? ''}}<br/></td>
		      </tr>
		      <tr>
		        <td><b>Gender</b>: {{$profile->gender ?? ''}}<br/></td>
		      </tr> 
	    	</tbody>
	  	</table>	    
	</div>
	
	<div align="center">
        <a href="{{ url('/profile') }}" class="btn btn-primary">Back</a>
	</div>
@endsection