<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use DataTables;
use Illuminate\Support\Facades\Auth;



class CategoryController extends Controller
{
   
    public function index(){
        $data = \DB::table('employee')->where('id','=',Auth::user()->id_employee)->first();
        return view('category',['data'=>$data]);
    }

    public function save(Request $request){ 
       
        if($request->id == NULL || $request->id == ''){ 
                $category = new \App\Models\CategoryModel();
                $category->category_name = $request->category_name; 
                $category->save();  
        }else{ 
                \DB::table('category')->where('id',$request->id)->update([
                    'category_name' => $request->category_name
                ]);
                
        }
      
    }

    public function datalist(Request $request){ 
        if ($request->ajax()) {
            $data = categoryModel::latest()->get();
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
        $category = CategoryModel::findOrFail($id); 
        $category->delete();
    }  

    public function get_data(Request $request){
        $id = $request->id;
        $category = CategoryModel::where('id',$id)->first();
        return $category;
    }
     
}
