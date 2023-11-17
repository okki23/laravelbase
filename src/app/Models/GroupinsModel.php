<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupinsModel extends Model
{
    use HasFactory;
    protected $table = "groupins";
    protected $fillable = ['id','group_name'];
}
