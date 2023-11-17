<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceModel;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\GroupinsModel;


class ServiceController extends Controller
{

    public function index(){
        $data = \DB::table('employee')->where('id','=',Auth::user()->id_employee)->first();
        $group = GroupinsModel::all();
        return view('service',['data'=>$data,'group'=>$group]);
    }

    public function save(Request $request){

        if($request->id == NULL || $request->id == ''){

                $service = new \App\Models\ServiceModel();
                $service->service_code = $request->service_code;
                $service->service_name = $request->service_name;
                $service->remark = $request->remark;
                $service->id_group = $request->id_group;
                $service->category = $request->category;
                $service->kategori = $request->kategori;
                $service->qty = $request->qty;
                $service->price = $request->price;
                $service->expire_service = $request->expire_service;
                $service->acc_revenue = $request->acc_revenue;
                $service->agreement_type = $request->agreement_type;
                $service->save();

        }else{
                \DB::table('service')->where('id',$request->id)->update([
                    'service_code' => $request->service_code,
                    'service_name' => $request->service_name,
                    'remark' => $request->remark,
                    'id_group' => $request->id_group,
                    'category' => $request->category,
                    'kategori' => $request->kategori,
                    'qty' => $request->qty,
                    'price' => $request->price,
                    'expire_service' => $request->expire_service,
                    'acc_revenue' => $request->acc_revenue,
                    'agreement_type' => $request->agreement_type
                ]);
        }

    }

    public function datalist(Request $request){
        if ($request->ajax()) {
            $data = ServiceModel::getlist();
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
    public function datalist_get(Request $request){
        if ($request->ajax()) {
            $data = ServiceModel::getlist();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <button class="btn btn-primary" onclick="ChooseService('.$row->id.')"> Pilih Data</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function get_data(Request $request){
        $id = $request->id;
        $service = ServiceModel::where('id',$id)->first();
        return $service;
    }


    public function destroy(Request $request){
        $id  = $request->id;
        $service = ServiceModel::findOrFail($id);

        //delete image
        Storage::delete('public'. $service->foto);

        //delete post
        $service->delete();

    }



    public function kartu($id){
        $data = ServiceModel::findOrfail($id);
        return view ('kartu',['data'=>$data]);

    }

    public function getmax($param = '') {
        $data = ServiceModel::get_no();
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
}
