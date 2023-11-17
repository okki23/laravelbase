<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstrukturModel;
use DataTables;
use App\Models\BankModel; 
use App\Models\GroupinsModel;
use Illuminate\Support\Facades\Auth;

class InstrukturController extends Controller
{
   
    public function index(){
        $databank = BankModel::all();
        $datagroup = GroupinsModel::all();
        $data = \DB::table('employee')->where('id','=',Auth::user()->id_employee)->first();
        return view('instruktur',['data'=>$data,'databank'=>$databank,'datagroup'=>$datagroup]);
    }

    public function save(Request $request){ 
       
        if($request->id == NULL || $request->id == ''){
            
            $destinationPath = 'uploads';
            $posting_foto = $request->file('foto');  

            if($posting_foto == NULL || !$posting_foto || $posting_foto == ''){
                $instruktur = new \App\Models\InstrukturModel();
                $instruktur->instructur_code = $request->instructur_code;
                $instruktur->instructur_name = $request->instructur_name; 
                $instruktur->birth_date = $request->birth_date; 
                $instruktur->gender = $request->gender; 
                $instruktur->marital_status = $request->marital_status; 
                $instruktur->address = $request->address; 
                $instruktur->join_date = $request->join_date; 
                $instruktur->npwp = $request->npwp; 
                $instruktur->id_bank = $request->id_bank; 
                $instruktur->account_bank = $request->account_bank; 
                $instruktur->phone = $request->phone; 
                $instruktur->email = $request->email;  
                $instruktur->id_group = $request->id_group;   
                $instruktur->save();
            }else{
                $instruktur = new \App\Models\InstrukturModel();
                $instruktur->instructur_code = $request->instructur_code;
                $instruktur->instructur_name = $request->instructur_name; 
                $instruktur->birth_date = $request->birth_date; 
                $instruktur->gender = $request->gender; 
                $instruktur->marital_status = $request->marital_status; 
                $instruktur->address = $request->address; 
                $instruktur->join_date = $request->join_date; 
                $instruktur->npwp = $request->npwp; 
                $instruktur->id_bank = $request->id_bank; 
                $instruktur->account_bank = $request->account_bank; 
                $instruktur->phone = $request->phone; 
                $instruktur->email = $request->email;  
                $instruktur->id_group = $request->id_group;   
                $instruktur->foto = $request->file('foto')->getClientOriginalName(); 
                $posting_foto->move($destinationPath,$posting_foto->getClientOriginalName()); 
                $instruktur->save();
            }
         
 
        }else{
            $posting_foto = $request->file('foto'); 
            $destinationPath = 'uploads';
            
            if($posting_foto == NULL || !$posting_foto || $posting_foto == ''){
                \DB::table('instruktur')->where('id',$request->id)->update([
                    'instructur_code' => $request->instructur_code,
                    'instructur_name' => $request->instructur_name,
                    'birth_date' => $request->birth_date,
                    'gender' => $request->gender,
                    'marital_status' => $request->marital_status,
                    'address' => $request->address,
                    'join_date' => $request->join_date,
                    'npwp' => $request->npwp,
                    'id_bank' => $request->id_bank,
                    'account_bank' => $request->account_bank,
                    'phone' => $request->phone,
                    'email' => $request->email,  
                    'id_group' => $request->id_group,  
                ]);
               
            }else{
                \DB::table('instruktur')->where('id',$request->id)->update([
                    'instructur_code' => $request->instructur_code,
                    'instructur_name' => $request->instructur_name,
                    'birth_date' => $request->birth_date,
                    'gender' => $request->gender,
                    'marital_status' => $request->marital_status,
                    'address' => $request->address,
                    'join_date' => $request->join_date,
                    'npwp' => $request->npwp,
                    'id_bank' => $request->id_bank,
                    'account_bank' => $request->account_bank,
                    'phone' => $request->phone,
                    'email' => $request->email,  
                    'id_group' => $request->id_group,  
                    'foto' => $request->file('foto')->getClientOriginalName(), 
                ]);
                $posting_foto->move($destinationPath,$posting_foto->getClientOriginalName());
            }
            
        }
      
    }

    public function datalist(Request $request){ 
        if ($request->ajax()) {
            $data = InstrukturModel::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.url('/instruktur_kartu/'.$row->id).'" target="_blank" class="edit btn btn-warning btn-sm"> Kartu</a> <a href="javascript:void(0)" onclick="UbahData('.$row->id.');" class="edit btn btn-success btn-sm"> Edit</a> 
                    <a href="javascript:void(0)" onclick="DeleteData('.$row->id.');" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
 

    public function destroy(Request $request){
        $id  = $request->id;
        $instruktur = InstrukturModel::findOrFail($id);
  
        //delete post
        $instruktur->delete();

    }  

    public function get_data(Request $request){
        $id = $request->id;
        $instruktur = InstrukturModel::where('id',$id)->first();
        return $instruktur;
    }

    
    public function getmax($param = '') {
        $data = InstrukturModel::get_no(); 
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
        $data = InstrukturModel::KartuInstruktur($id);   
        return view ('kartu_instruktur',['data'=>$data]); 
    }
}
