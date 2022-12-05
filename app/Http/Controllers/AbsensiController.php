<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AbsensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create() {
        return view('absensi.add');
    }

    public function store(Request $request) {
        $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'employee_id' => 'required',
            'jadwal_id' => 'required',        
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert("INSERT INTO absensi(check_in, check_out, employee_id, jadwal_id) VALUES (:check_in, :check_out, :employee_id, :jadwal_id)",
        [
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'employee_id' => $request->employee_id,
            'jadwal_id' => $request->jadwal_id,
        ]
        )
        ;
        return redirect()->route('employee.index')->with('success', 'Data absensi berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('absensi')->where('absen_id', $id)->first();
        return view('absensi.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'employee_id' => 'required',
            'jadwal_id' => 'required',
        ]);

        DB::update('UPDATE absensi SET check_in = :check_in, check_out = :check_out, employee_id = :employee_id, jadwal_id = :jadwal_id WHERE absen_id = :id',
        [
            'id' => $id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'employee_id' => $request->employee_id,
            'jadwal_id' => $request->jadwal_id,
        ]
        );

        return redirect()->route('employee.index')->with('success', 'Data absensi berhasil diperbaharui');
    }

    public function delete($id) {
        DB::delete('DELETE FROM absensi WHERE absen_id = :absen_id', ['absen_id' => $id]);

        return redirect()->route('employee.index')->with('success', 'Data absensi berhasil dihapus');
    }

    public function softDelete($id){
        DB::update('UPDATE absensi SET is_deleted = 1
        WHERE absen_id = :absen_id', ['absen_id' => $id]);
        return redirect()->route('employee.index')->with('success', 'Data absensi berhasil dihapus');
    }

    public function restore(){
        DB::table('absensi')
        ->update(['is_deleted' => 0]);

        return redirect()->route('employee.index')->with('success', 'Data absensi berhasil dipulihkan');
    }

    public function joins(Request $request)
    {
        if($request->has('cari2')){
            $joins = DB::table ('absensi')
            ->join('kalender', 'absensi.jadwal_id', '=', 'kalender.jadwal_id')
            ->join('employee', 'absensi.employee_id', '=', 'employee.employee_id')
            ->select('absensi.*', 'employee.first_name', 'employee.last_name', 'kalender.jadwal')
            ->where('absen_id','LIKE','%'.$request->cari2.'%')
            ->orwhere('first_name','LIKE','%'.$request->cari2.'%')
            ->orwhere('last_name','LIKE','%'.$request->cari2.'%')
            ->orwhere('check_in','LIKE','%'.$request->cari2.'%')
            ->orwhere('check_out','LIKE','%'.$request->cari2.'%')
            ->orwhere('duration','LIKE','%'.$request->cari2.'%')
            ->orwhere('jadwal','LIKE','%'.$request->cari2.'%')
            ->get();
        }else{
            $joins = DB::table ('absensi')
            ->join('kalender', 'absensi.jadwal_id', '=', 'kalender.jadwal_id')
            ->join('employee', 'absensi.employee_id', '=', 'employee.employee_id')
            ->select('absensi.*', 'employee.first_name', 'employee.last_name', 'kalender.jadwal')
            ->get();
        }
       
        return view('join2.index')
            ->with('joins', $joins);
    }
}
