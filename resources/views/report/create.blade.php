@extends('layouts/layout')

@section('content')

	<form method="post" name="report-form" id="report-form" action="{{url('')}}" required>
		{{ csrf_field() }}
			@include('report.form')
	<div align="center">       
		<br>             
		<a href="{{ url('/report') }}" class="btn btn-primary">Back</a>
		
        <button type="button" id="register-button-report" class="btn btn-primary">Register</button>
	</div>

	<br/><br/>

	</form>

    @push('scripts')
       <script>
       
       </script>
    @endpush
	
	

@endsection

