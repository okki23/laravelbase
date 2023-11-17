<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberModel extends Model
{
    use HasFactory;
    protected $table = "member";
    protected $fillable = ['id','barcode','title','member_name','id_number','dob','pob','phone','gender','email','address','emer_contact','referal','foto','created_at','updated_at'];
} 