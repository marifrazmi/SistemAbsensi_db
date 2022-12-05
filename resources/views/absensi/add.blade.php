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
<h4 class="mt-5 mb-3 text-center">Tambah Data Absensi</h4>

<div class="col-lg-5">
<form method="post" action="{{ route('absensi.store') }}">
    @csrf
  <div class="mb-3">
    <label for="check_in" class="form-label">Jam Masuk</label>
    <input type="time" class="form-control" id="check_in" name="check_in">
  </div>
  <div class="mb-3">
    <label for="check_out" class="form-label">Jam Keluar</label>
    <input type="time" class="form-control" id="check_out" name="check_out">
  </div>
  <div class="mb-3">
    <label for="employee_id" class="form-label">ID Employee</label>
    <select class="form-control" id="employee_id" name="employee_id">
        <option value="100">100 - Michael Angelo</option>
        <option value="101">101 - James Franco</option>
        <option value="102">102 - Hillary Clinton</option>
        <option value="103">103 - George Bush</option>
        <option value="104">104 - Rahma Susila</option>
        <option value="105">105 - Cahyo Kencana</option>
        <option value="106">106 - Cyntia Lubis</option>
        <option value="107">107 - Melody Anya</option>
        <option value="108">108 - Supratman Angkasa</option>
</select>
  </div>
  <div class="mb-3">
    <label for="jadwal_id" class="form-label">ID Jadwal</label>
    <select name="jadwal_id" id="jadwal_id" >
        <option value="10">10 - 1 September 2022</option>
        <option value="11">11 - 2 September 2022</option>
        <option value="12">12 - 3 September 2022</option>
        <option value="13">13 - 4 September 2022</option>
        <option value="14">14 - 5 September 2022</option>
        <option value="15">15 - 6 September 2022</option>
        <option value="16">16 - 7 September 2022</option>
        <option value="17">17 - 8 September 2022</option>
        <option value="18">18 - 9 September 2022</option>
        <option value="19">19 - 10 September 2022</option>
</select>
  </div>
  </div>

  <input type="submit" class="btn btn-primary mb-5" value="Submit"></input>
</form>
</div>
@endsection