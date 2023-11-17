<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeeModel;
use App\Models\PenggunaModel;
use DataTables;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
    public function index(){
        $list_emp = EmployeeModel::all();
        $data = \DB::table('employee')->where('id','=',Auth::user()->id_employee)->first();
        return view('pengguna',['list_emp'=>$list_emp,'data'=>$data]);
    }

    public function save(Request $request){ 
       
        if($request->id == NULL || $request->id == ''){
             
 
                $pengguna = new \App\Models\User();
                $pengguna->name = $request->name;
                $pengguna->password = $request->password;  
                $pengguna->id_employee = $request->id_employee; 
                $pengguna->save();
           
 
        }else{
             
                \DB::table('users')->where('id',$request->id)->update([
                    'name' => $request->name,
                    'password' => $request->password,  
                    'id_employee' => $request->id_employee,
                     
                ]);
              
            
        }
      
    }

    public function datalist(Request $request){ 
        if ($request->ajax()) {
            $data = PenggunaModel::getAll();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    if($row->id == '1'){
                        $actionBtn = '';
                        return $actionBtn;
                    }else{
                        $actionBtn = '<a href="javascript:void(0)" onclick="UbahData('.$row->id.');" class="edit btn btn-success btn-sm"> Edit</a> 
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
        $instruktur = PenggunaModel::findOrFail($id);
  
        //delete post
        $instruktur->delete();

    }  

    public function get_data(Request $request){
        $id = $request->id;
        $instruktur = PenggunaModel::where('id',$id)->first();
        return $instruktur;
    }

    
    public function getmax($param = '') {
        $data = PenggunaModel::get_no(); 
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

    public function pengguna_profile(){
        $userid = Auth::user()->id;
        $data = \DB::table('users')->join('employee','employee.id','=','users.id_employee')
        ->select('users.id','users.name as username','users.password','employee.*')
        ->where('users.id','=',$userid)
        ->first();
        return view('pengguna_profile',['data'=>$data]);
    }

    public function save_profile(Request $request){
        $id_employee  = $request->id_employee;
        $password = $request->password;
        $cpassword = $request->cpassword;

        if($password != $cpassword){
            echo "<script> alert('Password gak sama!'); history.go(-1);; </script>";
        }else{
           $update = \DB::table('users')->where('id_employee',$id_employee)->update([
                'password' => bcrypt($password)
            ]);
            if($update){
                echo "<script> alert('Password berhasil dirubah!'); history.go(-1);; </script>";
            }
        }
    }
 
}
