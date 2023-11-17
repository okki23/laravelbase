<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UomModel;
use DataTables;
use Illuminate\Support\Facades\Auth;


class UomController extends Controller
{
   
    public function index(){
        $data = \DB::table('employee')->where('id','=',Auth::user()->id_employee)->first();
        return view('uom',['data'=>$data]);
    }

    public function save(Request $request){ 
       
        if($request->id == NULL || $request->id == ''){ 
                $uom = new \App\Models\UomModel();
                $uom->uom = $request->uom; 
                $uom->save();  
        }else{ 
                \DB::table('uom')->where('id',$request->id)->update([
                    'uom' => $request->uom
                ]);
                
        }
      
    }

    public function datalist(Request $request){ 
        if ($request->ajax()) {
            $data = UomModel::latest()->get();
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
        $uom = UomModel::findOrFail($id);
  
        //delete post
        $uom->delete();

    }  

    public function get_data(Request $request){
        $id = $request->id;
        $uom = UomModel::where('id',$id)->first();
        return $uom;
    }
     
}
