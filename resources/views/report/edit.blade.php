@extends('layouts/layout')

@section('content')

	<form method="post" name="report-form" id="report-form" action="{{url("report/$report->id")}}" required>
		{{ csrf_field() }}
		{{ method_field('PUT') }}
			@include('report.edit_form')
	<div align="center">       
		<br>             
		<a href="{{ url('/report') }}" class="btn btn-primary">Back</a>
		<input type="submit" class="btn btn-primary" value="Update">
      
	</div>

	<br/><br/>

	</form>

    @push('scripts')
       <script>
       
       </script>
    @endpush
	
	

@endsection

