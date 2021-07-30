<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
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
        //
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Recupero la lista de categorias para pasarla al formulacion de creacion de POST
        $categories = Category::pluck('name', 'id');
        //Recupero la lista de etiquetas para pasrala al formulario de creacion de POST
        $tags = Tag::all();

        //
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        //Agrego el nuevo registro en una variable llamada post
        $post = Post::create($request->all());
        //Si el usuarioa grega imagen muevo dicha imagen el STORAGE
        if ($request->file('file')) {
            $url =  Storage::put('posts', $request->file('file'));
            $post->image()->create([
                'url' => $url
            ]);
        }

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }
        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)


    {
        //Hago referencia de la Policie que he creado para autentificar el usuario
        $this->authorize('author', $post);

        //Recupero la lista de categorias para pasarla al formulacion de creacion de POST
        $categories = Category::pluck('name', 'id');
        //Recupero la lista de etiquetas para pasrala al formulario de creacion de POST
        $tags = Tag::all();

        //
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        //Hago referencia de la Policie que he creado para autentificar el usuario
        $this->authorize('author', $post);
        //
        $post->update($request->all());
        if ($request->file('file')) {
            $url = Storage::put('posts', $request->file('file'));

            if ($post->image) {
                Storage::delete($post->image->url);
                $post->image->update([
                    'url' => $url
                ]);              
            }else{
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }
        return redirect()->route('admin.posts.edit', $post)->with('info', 'El post se ha actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //Hago referencia de la Policie que he creado para autentificar el usuario
        $this->authorize('author', $post);
        //Elimino el post que viene por $post
        $post->delete();
        return redirect()->route('admin.posts.index')->with('info', 'El post se ha eliminado');
    }
}
