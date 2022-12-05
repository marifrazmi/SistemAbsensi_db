<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request) {

        if($request->has('search')){
            $datas = DB::table ('employee')
            ->select('employee_id', 'first_name', 'last_name', 'email', 'gender', 'company_id', 'employment_status', 'branch', 'join_date', 'job_id')
            ->where('is_deleted', '=', 0)
            ->where('employee_id','LIKE','%'.$request->search.'%')
            ->orwhere('first_name','LIKE','%'.$request->search.'%')
            ->orwhere('last_name','LIKE','%'.$request->search.'%')
            ->orwhere('email','LIKE','%'.$request->search.'%')
            ->orwhere('gender','LIKE','%'.$request->search.'%')
            ->orwhere('company_id','LIKE','%'.$request->search.'%')
            ->orwhere('employment_status','LIKE','%'.$request->search.'%')
            ->orwhere('branch','LIKE','%'.$request->search.'%')
            ->orwhere('join_date','LIKE','%'.$request->search.'%')
            ->get();
        }else{
            $datas = DB::select('SELECT * from employee WHERE is_deleted = 0');
        }

        if($request->has('search')){
            $absens = DB::table ('absensi')
            ->select('absen_id','check_in', 'check_out', 'duration', 'employee_id', 'jadwal_id')
            ->where('is_deleted', '=', 0)
            ->where('absen_id','LIKE','%'.$request->search.'%')
            ->orwhere('check_in','LIKE','%'.$request->search.'%')
            ->orwhere('check_out','LIKE','%'.$request->search.'%')
            ->orwhere('duration','LIKE','%'.$request->search.'%')
            ->orwhere('employee_id','LIKE','%'.$request->search.'%')
            ->orwhere('jadwal_id','LIKE','%'.$request->search.'%')
            ->get(); 
        }else{
           $absens = DB::select('SELECT * from absensi WHERE is_deleted = 0');
        }
       
        return view('employee.index')
            ->with('datas', $datas)
            ->with('absens', $absens);
    }

    public function create() {
        return view('employee.add');
    }

    public function store(Request $request) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'company_id' => 'required',
            'employment_status' => 'required',
            'branch' => 'required',
            'join_date' => 'required',
            'job_id' => 'required'            
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert("INSERT INTO employee(employee_id, first_name, last_name, email, gender, company_id, employment_status, branch, join_date, job_id) VALUES (:employee_id, :first_name, :last_name, :email, :gender, :company_id, :employment_status, :branch, :join_date, :job_id)",
        [
            'employee_id' => $request->employee_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'company_id' => $request->company_id,
            'employment_status' => $request->employment_status,
            'branch' => $request->branch,
            'join_date' => $request->join_date,
            'job_id' => $request->job_id
        ]
        )
        ;
        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('employee')->where('employee_id', $id)->first();
        return view('employee.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'company_id' => 'required',
            'employment_status' => 'required',
            'branch' => 'required',
            'join_date' => 'required',
            'job_id' => 'required'  
        ]);

        DB::update('UPDATE employee SET first_name = :first_name, last_name = :last_name, email = :email, gender = :gender, company_id = :company_id, employment_status = :employment_status, branch = :branch, join_date = :join_date, job_id = :job_id WHERE employee_id = :id',
        [
            'id' => $id,
            'first_name' =>$request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'company_id' => $request->company_id,
            'employment_status' => $request->employment_status,
            'branch' => $request->branch,
            'join_date' => $request->join_date,
            'job_id' => $request->job_id
        ]
        );

        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil diperbaharui');
    }

    public function delete($id) {
        DB::delete('DELETE FROM employee WHERE employee_id = :employee_id', ['employee_id' => $id]);

        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil dihapus');
    }

    public function softDelete($id){
        DB::update('UPDATE employee SET is_deleted = 1
        WHERE employee_id = :employee_id', ['employee_id' => $id]);

        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil dihapus');
    }

    public function restore(){
        DB::table('employee')
        ->update(['is_deleted' => 0]);

        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil dipulihkan');
    }

    public function join(Request $request)
    {
        if($request->has('cari')){
            $join = DB::table ('employee')
            ->join('job', 'employee.job_id', '=', 'job.job_id')
            ->select('employee.*', 'job.organization_name' , 'job.job_position', 'job.job_level')
            ->where('employee_id','LIKE','%'.$request->cari.'%')
            ->orwhere('first_name','LIKE','%'.$request->cari.'%')
            ->orwhere('last_name','LIKE','%'.$request->cari.'%')
            ->orwhere('email','LIKE','%'.$request->cari.'%')
            ->orwhere('gender','LIKE','%'.$request->cari.'%')
            ->orwhere('employment_status','LIKE','%'.$request->cari.'%')
            ->orwhere('branch','LIKE','%'.$request->cari.'%')
            ->orwhere('join_date','LIKE','%'.$request->cari.'%')
            ->orwhere('organization_name','LIKE','%'.$request->cari.'%')
            ->orwhere('job_position','LIKE','%'.$request->cari.'%')
            ->orwhere('job_level','LIKE','%'.$request->cari.'%')
            ->get();
        }else{
            $join = DB::table ('employee')
            ->join('job', 'employee.job_id', '=', 'job.job_id')
            ->select('employee.*', 'job.organization_name' , 'job.job_position', 'job.job_level')
            ->get();
        }
       
        return view('join.index')
            ->with('join', $join);
    }
}
