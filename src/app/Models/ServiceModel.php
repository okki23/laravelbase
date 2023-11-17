<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    use HasFactory;
    protected $table = "service";
    protected $fillable = ['id','service_code','service_name','remark','id_group','category','kategori','qty','price','expire_service','acc_revenue','agreement_type','created_at','updated_at'];
    

    public static function get_no(){ 
        $data = \DB::table('service')
        ->selectRaw('substr(max(service_code),-7) as id')
        ->get();
   
        return $data;
   } 

   public static function getlist(){
        $data = \DB::table('service')
        ->join('groupins','groupins.id','=','service.id_group')
        ->select('service.*','groupins.group_name')->get();
        return $data;
   }
}
