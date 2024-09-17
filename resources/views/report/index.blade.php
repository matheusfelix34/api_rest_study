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
<legend>Manage Reports</legend>


<a href="report/create"><button type="button" class="btn btn-primary">REGISTER REPORTS</button><br><br></a>



<table id="table_id" class="table table-striped table-bordered dataTable no-footer" width="100%" cellspacing="0" style="background-color: #fff;">
<thead>
    <tr>
            <th><center>title</th>
            <th><center>description</th>    
            <th class="width_acoes" style="width:190px;"><center>Actions</th>
       
    </tr>
    
</thead>
<tbody>
    @foreach ($reports as $report)
        <tr>
            <td>{{ $report->title }}</td>
            <td>{{ $report->description }}</td>
            <td>
                <a href="{{ route('report.show', $report->id) }}" class="btn btn-primary">Show</a>
                <form action="{{ route('report.destroy', $report->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Delete</button>
                </form>
                <a href="{{ route('report.edit', $report->id) }}" class="btn-edit">Edit</a>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
    

</fieldset>
@endsection
