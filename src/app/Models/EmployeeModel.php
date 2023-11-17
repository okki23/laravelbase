<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    use HasFactory;
 
    protected $table = "employee";
    protected $fillable = ['id','employee_code','employee_name','birth_date','gender','marital_status','job_title','status','address','join_date','npwp','id_bank','account_bank','phone','email','foto','id_group','created_at','updated_at'];
    
    public static function get_no(){ 
        $data = \DB::table('employee')
        ->selectRaw('substr(max(employee_code),-7) as id')
        ->get();
   
        return $data;
   } 

   public static function KartuEmployee($id){
        $data = \DB::table('employee') 
        ->where('employee.id','=',$id)
        ->first();
        return $data;        
   }
}
