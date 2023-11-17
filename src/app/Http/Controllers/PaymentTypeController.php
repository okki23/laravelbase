<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentTypeModel;
use DataTables;
use Illuminate\Support\Facades\Auth;



class PaymentTypeController extends Controller
{
   
    public function index(){
        $data = \DB::table('employee')->where('id','=',Auth::user()->id_employee)->first();
        return view('payment_type',['data'=>$data]);
    }

    public function save(Request $request){ 
       
        if($request->id == NULL || $request->id == ''){ 
                $payment_type = new \App\Models\PaymentTypeModel();
                $payment_type->payment_type_name = $request->payment_type_name; 
                $payment_type->save();  
        }else{ 
                \DB::table('payment_type')->where('id',$request->id)->update([
                    'payment_type_name' => $request->payment_type_name
                ]);
                
        }
      
    }

    public function datalist(Request $request){ 
        if ($request->ajax()) {
            $data = PaymentTypeModel::latest()->get();
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
        $payment_type = PaymentTypeModel::findOrFail($id); 
        $payment_type->delete();
    }  

    public function get_data(Request $request){
        $id = $request->id;
        $payment_type = PaymentTypeModel::where('id',$id)->first();
        return $payment_type;
    }
     
}
