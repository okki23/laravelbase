<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UomModel extends Model
{
    use HasFactory;
    protected $table = "uom";
    protected $fillable = ['id','uom'];
}
