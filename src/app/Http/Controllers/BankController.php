<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankModel;
use DataTables;
use Illuminate\Support\Facades\Auth;



class BankController extends Controller
{
   
    public function index(){
        $data = \DB::table('employee')->where('id','=',Auth::user()->id_employee)->first();
        return view('bank',['data'=>$data]);
    }

    public function save(Request $request){ 
       
        if($request->id == NULL || $request->id == ''){ 
                $bank = new \App\Models\BankModel();
                $bank->bank = $request->bank; 
                $bank->save();  
        }else{ 
                \DB::table('bank')->where('id',$request->id)->update([
                    'bank' => $request->bank
                ]);
                
        }
      
    }

    public function datalist(Request $request){ 
        if ($request->ajax()) {
            $data = bankModel::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" onclick="UbahData('.$row->id.');" class="edit btn btn-success btn-sm"> Edit</a> 
                    <a href="javascript:void(0)" onclick="DeleteData('.$row->id.');" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
 

    public function destroy(Request $request){
        $id  = $request->id;
        $bank = BankModel::findOrFail($id); 
        $bank->delete();
    }  

    public function get_data(Request $request){
        $id = $request->id;
        $bank = BankModel::where('id',$id)->first();
        return $bank;
    }
     
}
