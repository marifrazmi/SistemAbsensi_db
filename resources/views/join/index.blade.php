@extends('layouts.main2')

@section('container')
<h4 class="mt-5 mb-3 text-center">Data Karyawan</h4>

<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="/employee/cari" class="form-inline" method="GET">
            <div class="input-group mb-3">
                <input type="search" class="form-control" placeholder="Search..." name="cari" value="{{ request('cari') }}">
                <button class="btn btn-danger" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>

@if($message = Session::get('success'))
 <div class="alert alert-success mt-3" role="alert">
 {{ $message }}
 </div>
@endif
<table class="table table-hover mt-2">
 <thead>
 <tr>
 <th>ID Employee</th>
 <th>First Name</th>
 <th>Last Name</th>
 <th>Email</th>
 <th>Gender</th>
 <th>Company</th>
 <th>Employment Status</th>
 <th>Branch</th>
 <th>Join Date</th>
 <th>Organization Name</th>
 <th>Job Position</th>
 <th>Job Level</th>
 </tr>
 </thead>
 <tbody>
 @foreach ($join as $data)
 <tr>
 <td>{{ $data->employee_id }}</td>
 <td>{{ $data->first_name }}</td>
 <td>{{ $data->last_name }}</td>
 <td>{{ $data->email }}</td>
 <td>{{ $data->gender }}</td>
 <td>{{ $data->company_id }}</td>
 <td>{{ $data->employment_status }}</td>
 <td>{{ $data->branch }}</td>
 <td>{{ $data->join_date }}</td>
 <td>{{ $data->organization_name }}</td>
 <td>{{ $data->job_position }}</td>
 <td>{{ $data->job_level }}</td>
</tr>
@endforeach
</body>
</table>
@endsection