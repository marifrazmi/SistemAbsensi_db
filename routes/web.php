<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
});


Route::get('search', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('add', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('store', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::post('update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::post('delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
Route::post('softDelete/{id}', [EmployeeController::class, 'softDelete'])->name('employee.softDelete');
Route::get('restore', [EmployeeController::class, 'restore'])->name('employee.restore');

Route::get('absensi/add', [AbsensiController::class, 'create'])->name('absensi.create');
Route::post('absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');
Route::get('absensi/edit/{id}', [AbsensiController::class, 'edit'])->name('absensi.edit');
Route::post('absensi/update/{id}', [AbsensiController::class, 'update'])->name('absensi.update');
Route::post('absensi/delete/{id}', [AbsensiController::class, 'delete'])->name('absensi.delete');
Route::post('absensi/softDelete/{id}', [AbsensiController::class, 'softDelete'])->name('absensi.softDelete');
Route::get('absensi/restore', [AbsensiController::class, 'restore'])->name('absensi.restore');

Route::get('/employee', [EmployeeController::class, 'join'])->name('join.index');
Route::get('/employee/cari', [EmployeeController::class, 'join'])->name('join.index');

Route::get('/attendance', [AbsensiController::class, 'joins'])->name('join2.index');
Route::get('/attendance/cari2', [AbsensiController::class, 'joins'])->name('join2.index');

Route::get('/logout', function(){
    \Auth::logout();
    return redirect('/home');
});