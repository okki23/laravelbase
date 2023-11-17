<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberModel;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{

    public function index(){
        $data = \DB::table('employee')->where('id','=',Auth::user()->id_employee)->first();
        return view('member',['data'=>$data]);
    }

    public function save(Request $request){

        if($request->id == NULL || $request->id == ''){

            $destinationPath = 'uploads';
            $posting_foto = $request->file('foto');

            if($posting_foto == NULL || !$posting_foto || $posting_foto == ''){
                $member = new \App\Models\MemberModel();
                $member->title = $request->title;
                $member->barcode = $request->barcode;
                $member->member_name = $request->member_name;
                $member->id_number = $request->member_name;
                $member->dob = $request->dob;
                $member->pob = $request->pob;
                $member->phone = $request->phone;
                $member->gender = $request->gender;
                $member->email = $request->email;
                $member->address = $request->address;
                $member->emer_contact = $request->emer_contact;
                $member->referal = $request->referal;

                $member->save();
            }else{
                $member = new \App\Models\MemberModel();
                $member->title = $request->title;
                $member->barcode = $request->barcode;
                $member->member_name = $request->member_name;
                $member->id_number = $request->member_name;
                $member->dob = $request->dob;
                $member->pob = $request->pob;
                $member->phone = $request->phone;
                $member->gender = $request->gender;
                $member->email = $request->email;
                $member->address = $request->address;
                $member->emer_contact = $request->emer_contact;
                $member->referal = $request->referal;
                $member->foto = $request->file('foto')->getClientOriginalName();
                $posting_foto->move($destinationPath,$posting_foto->getClientOriginalName());
                $member->save();
            }


        }else{
                $posting_foto = $request->file('foto');
                $destinationPath = 'uploads';
                if($posting_foto == NULL || !$posting_foto || $posting_foto == ''){
                \DB::table('member')->where('id',$request->id)->update([
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'address' => $request->address,
                    'emer_contact' => $request->emer_contact,
                    'referal' => $request->referal,
                ]);

            }else{
                \DB::table('member')->where('id',$request->id)->update([
                    'title' => $request->title,
                    'barcode' => $request->barcode,
                    'member_name' => $request->member_name,
                    'id_number' => $request->id_number,
                    'dob' => $request->dob,
                    'pob' => $request->pob,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'address' => $request->address,
                    'emer_contact' => $request->emer_contact,
                    'referal' => $request->referal,
                    'foto' => $request->file('foto')->getClientOriginalName(),
                ]);
                $posting_foto->move($destinationPath,$posting_foto->getClientOriginalName());
            }

        }

    }

    public function datalist(Request $request){
        if ($request->ajax()) {
            $data = MemberModel::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.url('/member_kartu/'.$row->id).'" target="_blank" class="edit btn btn-warning btn-sm"> Kartu</a> <a href="javascript:void(0)" onclick="UbahData('.$row->id.');" class="edit btn btn-success btn-sm"> Edit</a>
                    <a href="javascript:void(0)" onclick="DeleteData('.$row->id.');" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function datalist_get(Request $request){
        if ($request->ajax()) {
            $data = MemberModel::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                    <button class="btn btn-primary" onclick="ChooseMember('.$row->id.')"> Pilih Data</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }



    public function destroy(Request $request){
        $id  = $request->id;
        $member = MemberModel::findOrFail($id);

        //delete image
        Storage::delete('public'. $member->foto);

        //delete post
        $member->delete();

    }
    public function add_form(){
        echo(rand(50000,80000));
    }

    public function get_data(Request $request){
        $id = $request->id;
        $member = MemberModel::where('id',$id)->first();
        return $member;
    }

    public function kartu($id){
        $data = MemberModel::findOrfail($id);
        return view ('kartu',['data'=>$data]);
    }
}
