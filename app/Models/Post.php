<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//MongoDB
use Jenssegers\Mongodb\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'category_id',
        'tag_id',
        'status',
        'activo',
        'user_id',
    ];
}
