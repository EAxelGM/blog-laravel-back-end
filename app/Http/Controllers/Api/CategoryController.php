<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('activo', 1)->get();
        return $this->successResponse($categories);
    }
    
    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'activo' => 1,
        ]);

        return $this->successResponse($categories);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if($category){
            if($category->activo == 1){
                $category->activo = 0;
                $message = 'category borrado';
            }else{
                $category->activo = 1;
                $message = 'category reactivado';
            }
            $category->save();
            return $this->successResponse($category, $message);
        }
        return $this->errorResponse('category no encontrado', 404);
    }
}
