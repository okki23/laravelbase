<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use DataTables;
use App\Models\BankModel; 
use App\Models\GroupinsModel; 
use Illuminate\Support\Facades\Auth;


class EmployeeController extends Controller
{
   
    public function index(){
        $databank = BankModel::all();
        $data = \DB::table('employee')->where('id','=',Auth::user()->id_employee)->first();
        $datagroup = GroupinsModel::all();
        return view('employee',['databank'=>$databank,'datagroup'=>$datagroup,'data'=>$data]);
    }

    public function save(Request $request){ 
       
        if($request->id == NULL || $request->id == ''){
            
            $destinationPath = 'uploads';
            $posting_foto = $request->file('foto');  

            if($posting_foto == NULL || !$posting_foto || $posting_foto == ''){
                $employee = new \App\Models\EmployeeModel();
                $employee->employee_code = $request->employee_code;
                $employee->employee_name = $request->employee_name; 
                $employee->birth_date = $request->birth_date; 
                $employee->gender = $request->gender; 
                $employee->marital_status = $request->marital_status; 
                $employee->address = $request->address; 
                $employee->join_date = $request->join_date; 
                $employee->npwp = $request->npwp; 
                $employee->id_bank = $request->id_bank; 
                $employee->account_bank = $request->account_bank; 
                $employee->phone = $request->phone; 
                $employee->email = $request->email;  
                $employee->job_title = $request->job_title; 
                $employee->status = $request->status;     
                $employee->save();

                $users = new \App\Models\PenggunaModel();
                $users->name = $request->employee_name; 
                $users->email =  $request->email; 
                $users->id_employee =  $employee->id; 
                $users->password = bcrypt('aka123');
                $users->save();
 
            }else{
                $employee = new \App\Models\EmployeeModel();
                $employee->employee_code = $request->employee_code;
                $employee->employee_name = $request->employee_name; 
                $employee->birth_date = $request->birth_date; 
                $employee->gender = $request->gender; 
                $employee->marital_status = $request->marital_status; 
                $employee->address = $request->address; 
                $employee->join_date = $request->join_date; 
                $employee->npwp = $request->npwp; 
                $employee->id_bank = $request->id_bank; 
                $employee->account_bank = $request->account_bank; 
                $employee->phone = $request->phone; 
                $employee->email = $request->email;  
                $employee->job_title = $request->job_title; 
                $employee->status = $request->status;   
                $employee->foto = $request->file('foto')->getClientOriginalName(); 
                $posting_foto->move($destinationPath,$posting_foto->getClientOriginalName()); 
                $employee->save();

                $users = new \App\Models\PenggunaModel();
                $users->name = $request->employee_name; 
                $users->email =  $request->email; 
                $users->id_employee =  $employee->id; 
                $users->password = bcrypt('aka123');
                $users->save();
            }
         
 
        }else{
            $posting_foto = $request->file('foto'); 
            $destinationPath = 'uploads';
            
            if($posting_foto == NULL || !$posting_foto || $posting_foto == ''){
                \DB::table('employee')->where('id',$request->id)->update([
                    'employee_code' => $request->employee_code,
                    'employee_name' => $request->employee_name,
                    'birth_date' => $request->birth_date,
                    'gender' => $request->gender,
                    'marital_status' => $request->marital_status,
                    'address' => $request->address,
                    'join_date' => $request->join_date,
                    'status' => $request->status,
                    'job_title' => $request->job_title,
                    'npwp' => $request->npwp,
                    'id_bank' => $request->id_bank,
                    'account_bank' => $request->account_bank,
                    'phone' => $request->phone,
                    'email' => $request->email,   
                ]);
               
            }else{
                \DB::table('employee')->where('id',$request->id)->update([
                    'employee_code' => $request->employee_code,
                    'employee_name' => $request->employee_name,
                    'birth_date' => $request->birth_date,
                    'gender' => $request->gender,
                    'marital_status' => $request->marital_status,
                    'address' => $request->address,
                    'join_date' => $request->join_date,
                    'status' => $request->status,
                    'job_title' => $request->job_title,
                    'npwp' => $request->npwp,
                    'id_bank' => $request->id_bank,
                    'account_bank' => $request->account_bank,
                    'phone' => $request->phone,
                    'email' => $request->email,   
                    'foto' => $request->file('foto')->getClientOriginalName(), 
                ]);
                $posting_foto->move($destinationPath,$posting_foto->getClientOriginalName());
            }
            
        }
      
    }

    public function datalist(Request $request){ 
        if ($request->ajax()) {
            $data = EmployeeModel::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if($row->id == 0000001){
                        $actionBtn = '';
                        return $actionBtn;
                    }else{
                        $actionBtn = '<a href="'.url('/employee_kartu/'.$row->id).'" target="_blank" class="edit btn btn-warning btn-sm"> Kartu</a> <a href="javascript:void(0)" onclick="UbahData('.$row->id.');" class="edit btn btn-success btn-sm"> Edit</a> 
                        <a href="javascript:void(0)" onclick="DeleteData('.$row->id.');" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $actionBtn;
                    }
                   
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
 

    public function destroy(Request $request){
        $id  = $request->id;
        $employee = EmployeeModel::findOrFail($id);
  
        //delete post
        $employee->delete();
        $users =  Users::where('id', $employee->id_employee)->delete();

    }  

    public function get_data(Request $request){
        $id = $request->id;
        $employee = EmployeeModel::where('id',$id)->first();
        return $employee;
    }

    
    public function getmax($param = '') {
        $data = EmployeeModel::get_no(); 
        $lastid = $data[0]->id; 

        if($lastid == '') { // bila data kosong
            $ID = $param . "0000001"; 
        }else {
            $MaksID = $lastid;
            $MaksID++;
            if ($MaksID < 10)
                $ID = $param . "000000" . $MaksID;
            else if ($MaksID < 100)
                $ID = $param . "00000" . $MaksID;
            else if ($MaksID < 1000)
                $ID = $param . "0000" . $MaksID;
            else if ($MaksID < 10000)
                $ID = $param . "000" . $MaksID;
            else if ($MaksID < 100000)
                $ID = $param . "00" . $MaksID;
            else if ($MaksID < 1000000)
                $ID = $param . "0" . $MaksID;
            else
                $ID = $MaksID;
        }

        return $ID;
    }  	

    public function add_form(){
       echo $this->getmax();
    }

    public function kartu($id){
        $data = EmployeeModel::KartuEmployee($id);   
        return view ('kartu_employee',['data'=>$data]); 
    }
}
