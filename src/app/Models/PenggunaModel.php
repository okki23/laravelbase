<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PenggunaModel extends Model
{
    use HasFactory; 

    protected $table = "users";
    protected $fillable = ['id','name','email','password','id_employee'];

    public static function getAll(){
        $data = \DB::table('users')->join('employee','employee.id','=','users.id_employee')
        ->select('users.id','users.name as username','users.password','employee.employee_name','employee.employee_code')
        ->get();
        return $data;
        
    }
}
