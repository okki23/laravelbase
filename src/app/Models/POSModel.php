<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POSModel extends Model
{
    use HasFactory;

    protected $table = "t_pos_detail";
    protected $fillable = ['id','id_trans_code','id_service','qty'];
    
    public static function get_no(){ 
        $data = \DB::table('t_pos')
        ->selectRaw('substr(max(trans_code),-7) as id')
        ->get();
   
        return $data;
   } 

    public static function getlistpos($params){ 
        $data = \DB::table('t_pos_detail')->where('id_trans_code',$params);
        return $data;
    } 

  
}
