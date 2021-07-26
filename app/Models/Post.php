<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//MongoDB
use Jenssegers\Mongodb\Eloquent\Model;

use App\Models\Tag;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'subtitle',
        'slug',
        'image',
        'category_id',
        'tags_ids',
        'status',
        'activo',
        'user_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getTagsIdsAttribute($value){
        $ids = $value;
        $tags = [];
        foreach ($ids as $id) {
            $etiqueta = Tag::find($id);
            array_push($tags, $etiqueta);
        }
        return $tags;
    }
}
