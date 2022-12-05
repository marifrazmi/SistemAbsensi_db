@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="search" class="form-inline" method="GET">
            <div class="input-group mb-3">
                <input type="search" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                <button class="btn btn-danger" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>

<h4 class="mt-5 text-center">Data Karyawan</h4>
<div class="row justify-content-center">
<a href="{{ route('employee.restore') }}" type="button" class="btn btn-info rounded-3 mb-3">Pulihkan Data Karyawan</a>
</div>

<a href="add" class="btn btn-primary mb-3">Tambah data</a>

@if($message = Session::get('success'))
 <div class="alert alert-success mt-3" role="alert">
 {{ $message }}
 </div>
@endif
<table class="table table-hover mt-2 ">
 <thead>
 <tr class="text-center">
 <th class="col-sm ">ID</th>
 <th class="col-1 ">First Name</th>
 <th class="col-1 ">Last Name</th>
 <th class="col-sm ">Email</th>
 <th >Gender</th>
 <th class="col-1">Company</th>
 <th class="col-2 ">Employment Status</th>
 <th class="col-1 ">Branch</th>
 <th class="col-1 ">Join Date</th>
 <th>ID Job</th>
 <th>Action</th>
 </tr>
 </thead>
 <tbody>
 @foreach ($datas as $data)
 <tr class="align-middle text-center">
 <td>{{ $data->employee_id }}</td>
 <td>{{ $data->first_name }}</td>
 <td>{{ $data->last_name }}</td>
 <td>{{ $data->email }}</td>
 <td>{{ $data->gender }}</td>
 <td>{{ $data->company_id }}</td>
 <td>{{ $data->employment_status }}</td>
 <td>{{ $data->branch }}</td>
 <td>{{ $data->join_date }}</td>
 <td>{{ $data->job_id }}</td>
 <td>
    <a href="{{ route('employee.edit', $data->employee_id) }}" type="button" class="btn btn-info rounded-3 column mb-2">Edit</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger rounded-3  column justify-content-center" data-bs-toggle="modal" data-bs-target="#DeleteModal{{ $data->employee_id }}">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="DeleteModal{{ $data->employee_id }}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteModalLabel">Confirm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('employee.delete', $data->employee_id) }}">
                                    @csrf
                                    <div class="modal-body">
                                    Anda yakin ingin delete {{ $data->first_name }} {{ $data->last_name }} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Gajadi</button>
                                        <button type="submit" class="btn btn-primary">Yakin</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-warning rounded-3 column justify-content-center mt-2" data-bs-toggle="modal" data-bs-target="#softDeleteModal{{ $data->employee_id }}">
                        Soft Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="softDeleteModal{{ $data->employee_id }}" tabindex="-1" aria-labelledby="softDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="softDeleteModalLabel">Confirm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="{{ route('employee.softDelete', $data->employee_id) }}">
                                    @csrf
                                    <div class="modal-body">
                                    Anda yakin mau softdelete {{ $data->first_name }} {{ $data->last_name }}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Sure</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </td>
 </tr>
 @endforeach
 </tbody>
</table>

<h4 class="mt-5 text-center">Data Absensi</h4>
<div class="row justify-content-center mb-3">
<a href="{{ route('absensi.restore') }}" type="button" class="btn btn-info rounded-3">Pulihkan Data Absensi</a>
</div>

<a href="absensi/add" class="btn btn-primary mb-3">Tambah data</a>

@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif
<table class="table table-hover mt-2">
    <thead>
        <tr class="text-center align-middle">
            <th>ID absen</th>
            <th>Jam masuk</th>
            <th>Jam pulang</th>
            <th>Durasi</th>
            <th>ID Employee</th>
            <th>ID Jadwal</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($absens as $data)
                <tr class="text-center align-middle">
                <td class="col-2">{{ $data->absen_id }}</td>
                <td class="col-2">{{ $data->check_in }}</td>
                <td class="col-2">{{ $data->check_out }}</td>
                <td class="col-2">{{ $data->duration }}</td>
                <td class="col-2">{{ $data->employee_id }}</td>
                <td class="col-2">{{ $data->jadwal_id }}</td>
                <td class="col-1">
                    <a href="{{ route('absensi.edit', $data->absen_id) }}" type="button" class="btn btn-info rounded-3 column mb-2">Edit</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger column justify-content-center" data-bs-toggle="modal" data-bs-target="#DeleteModal2{{ $data->absen_id }}">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="DeleteModal2{{ $data->absen_id }}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteModalLabel">Confirm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('absensi.delete', $data->absen_id) }}">
                                    @csrf
                                    <div class="modal-body">
                                    Anda yakin ingin delete {{ $data->absen_id }} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Gajadi</button>
                                        <button type="submit" class="btn btn-primary">Yakin</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-warning column justify-content-center mt-2" data-bs-toggle="modal" data-bs-target="#softDeleteModal2{{ $data->absen_id }}">
                        Soft Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="softDeleteModal2{{ $data->absen_id }}" tabindex="-1" aria-labelledby="softDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="softDeleteModalLabel">Confirm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('absensi.softDelete', $data->absen_id) }}">
                                    @csrf
                                    <div class="modal-body">
                                    Anda yakin ingin softdelete {{ $data->absen_id }}  ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Gajadi</button>
                                        <button type="submit" class="btn btn-primary">Yakin</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
 </tr>
 @endforeach
 </tbody>
</table>
@endsection