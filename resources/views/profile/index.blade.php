@extends('layouts/layout')

@section('content')

@if (session('erro'))
<div class="alert alert-danger">
{{ session('status') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
{{ session('success')}}
</div>    
@endif


<fieldset>
<legend>Manage Profiles</legend>


<a href="profile/create"><button type="button" class="btn btn-primary">REGISTER PROFILES</button><br><br></a>



<table id="table_id" class="table table-striped table-bordered dataTable no-footer" width="100%" cellspacing="0" style="background-color: #fff;">
<thead>
    <tr>
            <th><center>First Name</th>
            <th><center>Last name</th>    
            <th><center>Date of Birth</th>
            <th><center>Gender</th>    
            <th class="width_acoes" style="width:190px;"><center>Actions</th>
       
    </tr>
    
</thead>
<tbody>
    @foreach ($profiles as $profile)
        <tr>
            <td>{{ $profile->first_name }}</td>
            <td>{{ $profile->last_name }}</td>
            <td>{{ $profile->dob }}</td>
            <td>{{ $profile->gender }}</td>
            <td>
                <a href="{{ route('profile.show', $profile->id) }}" class="btn btn-primary">Show</a>
                <form action="{{ route('profile.destroy', $profile->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Delete</button>
                </form>
                <a href="{{ route('profile.edit', $profile->id) }}" class="btn-edit">Edit</a>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
    

</fieldset>
@endsection
