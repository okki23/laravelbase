<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupinsModel;
use DataTables;
use Illuminate\Support\Facades\Auth;

class groupinsController extends Controller
{
   
    public function index(){
        $data = \DB::table('employee')->where('id','=',Auth::user()->id_employee)->first();
        return view('groupins',['data'=>$data]);
    }

    public function save(Request $request){ 
       
        if($request->id == NULL || $request->id == ''){ 
                $groupins = new \App\Models\GroupinsModel();
                $groupins->group_name = $request->group_name; 
                $groupins->save();  
        }else{ 
                \DB::table('groupins')->where('id',$request->id)->update([
                    'group_name' => $request->group_name
                ]);
                
        }
      
    }

    public function datalist(Request $request){ 
        if ($request->ajax()) {
            $data = GroupinsModel::latest()->get();
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
        $groupins = GroupinsModel::findOrFail($id);
  
        //delete post
        $groupins->delete();

    }  

    public function get_data(Request $request){
        $id = $request->id;
        $groupins = GroupinsModel::where('id',$id)->first();
        return $groupins;
    }
     
}
