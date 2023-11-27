<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeleteLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id','local_id','propietario_id','nombre_local'
     ];
}
