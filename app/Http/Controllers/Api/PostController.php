<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginacion = 9;
        $withDeletes = isset($_GET['withDeletes']) ? true : false;
        $user_id = isset($_GET['userId']) ? $_GET['userId'] : '';
        $tag = isset($_GET['tag']) ? $_GET['tag'] : '';
        $category = isset($_GET['category']) ? $_GET['category'] : '';

        if($withDeletes){
            $post = Post::paginate($paginacion);
        }else if($tag != ''){
            $post = Post::where([['activo', 1], ['tags_ids', $tag]])->paginate($paginacion);
        }else if($category != ''){
            $post = Post::where([['activo', 1], ['category_id', $category]])->paginate($paginacion);
        }else{
            if($user_id == ''){
                $post = Post::where([['activo', 1], ['status', 'PUBLISHED']])->paginate($paginacion);
            }else{
                $post = Post::where([
                    ['activo', 1],
                    ['user_id', $user_id],
                ])->paginate($paginacion);
            }
        }

        $post->each(function($post){
            $post->category;
            $post->user;
        });
        
        return $this->successResponse($post);
        
    }
    
    public function store(Request $request)
    {   
        $slug = $this->TextToSlug($request->title);
        if(Post::where('slug', $slug)->first()){
            return $this->errorResponse('Este post ya existe, modifica el titulo.', 400);
        }

        $post = Post::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'slug' => $slug,
            'image' => null,
            'category_id' => $request->category_id,
            'tags_ids' => json_decode($request->tags_ids),
            'status' => $request->status,
            'activo' => 1,
            'user_id' => $request->user_id,
        ]);

        if($request->file('image')){
            $path = Storage::disk('public')->put('post_images', $request->file('image'));
            $post->fill(['image' => asset($path)])->save();
          }

        return $this->successResponse($post, 'Post creado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('slug', $id)->with(['category', 'user'])->first();
        if(!$post){
            return $this->errorResponse('No encontramos este post.', 404);
        }
        return $this->successResponse($post);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
