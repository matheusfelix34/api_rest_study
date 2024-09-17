@extends('layouts/layout')

@section('content')

	<form method="post" name="profile-form" id="profile-form" action="{{url("profile/$profile->id")}}" required>
		{{ csrf_field() }}
		{{ method_field('PUT') }}
			@include('profile.edit_form')
	<div align="center">       
		<br>             
		<a href="{{ url('/profile') }}" class="btn btn-primary">Back</a>
		<input type="submit" class="btn btn-primary" value="Update">
      
	</div>

	<br/><br/>

	</form>

    @push('scripts')
       <script>
       
       </script>
    @endpush
	
	

@endsection

