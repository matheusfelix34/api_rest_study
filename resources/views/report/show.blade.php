@extends('layouts/layout')

@section('content')	

	<div class="panel panel-default">
	<div class="title-show">Profile: {{ $report->title ?? ''}}</div>
		<table class="table table-striped">
		    <tbody>

		      <tr>
		        <td><b>Description</b>: {{$report->description ?? ''}}<br/></td>
		      </tr>
		     
	    	</tbody>
	  	</table>	    
	</div>

	<br>
	<h1>Profiles associated with this Report:</h1>
	<table id="table_id" class="table table-striped table-bordered dataTable no-footer" width="100%" cellspacing="0" style="background-color: #fff;">
		<thead>
			<tr>
					<th><center>First Name</th>
					<th><center>Last name</th>    
					<th><center>Date of Birth</th>
					<th><center>Gender</th>    
			</tr>
			
		</thead>
		<tbody>
			@foreach ($profiles as $profile)
				<tr>
					<td>{{ $profile->first_name }}</td>
					<td>{{ $profile->last_name }}</td>
					<td>{{ $profile->dob }}</td>
					<td>{{ $profile->gender }}</td>
				</tr>
			@endforeach
		</tbody>
		</table>
		<br>
		<br>
	<div align="center">
        <a href="{{ url('/report') }}" class="btn btn-primary">Back</a>
	</div>
@endsection