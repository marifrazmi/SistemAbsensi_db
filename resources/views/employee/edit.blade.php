@extends('layouts.main')

@section('container')
@if($errors->any())
 <div class="alert alert-danger">
 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
@endif
<h4 class="mt-5 mb-3 text-center">Ubah Data Karyawan</h4>

<div class="col-lg-5">
<form method="post" action="{{ route('employee.update', $data->employee_id) }}">
    @csrf
    <div class="mb-3">
    <label for="employee_id" class="form-label">ID Employee</label>
    <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ $data->employee_id }}" disabled>
  </div>
    <div class="mb-3">
    <label for="first_name" class="form-label">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $data->first_name }}">
  </div>
  <div class="mb-3">
    <label for="last_name" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $data->last_name }}">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}">
  </div>
  <div class="mb-3">
    <label for="gender" class="form-label">Gender</label>
    <select name="gender" id="gender" value="{{ $data->gender }}">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
</select>
  </div>
  <div class="mb-3">
    <label for="company_id" class="form-label">ID Company</label>
    <select name ="company_id" id="company_id" value="{{ $data->company_id }}">
        <option value="PT SAITAMA">PT SAITAMA</option>
</select>
  </div>
  <div class="mb-3">
    <label for="employment_status" class="form-label">Employment Status</label>
    <input type="text" class="form-control" id="employment_status" name="employment_status" value="{{ $data->employment_status }}">
  </div>
  <div class="mb-3">
    <label for="branch" class="form-label">Branch</label>
    <input type="text" class="form-control" id="branch" name="branch" value="{{ $data->branch }}">
  </div>
  <div class="mb-3">
    <label for="join_date" class="form-label">Join Date</label>
    <input type="date" class="form-control" id="join_date" name="join_date" value="{{ $data->join_date }}">
  </div>
  <div class="mb-3">
    <label for="join_id" class="form-label">ID Job</label>
    <select name="job_id" id="job_id" value="{{ $data->job_id }}">
        <option value="1">1 - Manager IT</option>
        <option value="2">2 - Supervisor Attendance</option>
        <option value="3">3 - Supervisor HRD</option>
        <option value="4">4 - Manager Personalia</option>
        <option value="5">5 - Manager FInance</option>
        <option value="6">6 - Tax and Payroll</option>
</select>
  </div>
  </div>

  <input type="submit" class="btn btn-primary mb-5" value="Submit"></input>
</form>
</div>
@endsection