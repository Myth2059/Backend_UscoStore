<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locales extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id','nombre','ubicacion','estado','categoria','subcategoria','imgUrl','detalles'
    ];
}
