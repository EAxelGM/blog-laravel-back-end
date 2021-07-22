<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::where('activo', 1)->get();
        return $this->successResponse($tags);
    }
    
    public function store(Request $request)
    {
        $tag = Tag::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'activo' => 1,
        ]);

        return $this->successResponse($tags);
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        if($tag){
            if($tag->activo == 1){
                $tag->activo = 0;
                $message = 'Tag borrado';
            }else{
                $tag->activo = 1;
                $message = 'Tag reactivado';
            }
            $tag->save();
            return $this->successResponse($tag, $message);
        }
        return $this->errorResponse('Tag no encontrado', 404);
    }
}
