<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InstrukturModel extends Model
{
    use HasFactory;
 
    protected $table = "instruktur";
    protected $fillable = ['id','instructur_code','instructur_name','birth_date','gender','marital_status','address','join_date','npwp','id_bank','account_bank','phone','email','foto','id_group','created_at','updated_at'];
    
    public static function get_no(){ 
        $data = \DB::table('instruktur')
        ->selectRaw('substr(max(instructur_code),-7) as id')
        ->get();
   
        return $data;
   } 

   public static function KartuInstruktur($id){
        $data = \DB::table('instruktur')
        ->join('groupins','groupins.id','=','instruktur.id_group')
        ->select('instruktur.instructur_code','instruktur.instructur_name','instruktur.email','instruktur.foto','groupins.group_name')
        ->where('instruktur.id','=',$id)
        ->first();
        return $data;        
   }
}