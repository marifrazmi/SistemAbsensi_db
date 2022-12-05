@extends('layouts.main3')

@section('container')
<h4 class="mt-5 text-center">Data Absensi</h4>

<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="/attendance/cari2" class="form-inline" method="GET">
            <div class="input-group mb-3">
                <input type="search" class="form-control" placeholder="Search..." name="cari2" value="{{ request('cari2') }}">
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
            <th>ID absen</th>
            <th>Jadwal</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Jam masuk</th>
            <th>Jam pulang</th>
            <th>Durasi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($joins as $data)
                <tr>
                <td>{{ $data->absen_id }}</td>
                <td>{{ $data->jadwal }}</td>
                <td>{{ $data->first_name }}</td>
                <td>{{ $data->last_name }}</td>
                <td>{{ $data->check_in }}</td>
                <td>{{ $data->check_out }}</td>
                <td>{{ $data->duration }}</td>
                </td>
 </tr>
 @endforeach
 </tbody>
</table>
@endsection