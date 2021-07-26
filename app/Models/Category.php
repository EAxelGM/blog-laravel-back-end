<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//MongoDB
use Jenssegers\Mongodb\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'activo',
    ];
}
