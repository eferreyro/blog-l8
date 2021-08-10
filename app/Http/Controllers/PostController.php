<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    //Creanto un metodo de POST
    public function index(){
        if (request()->page) {
            # code...
            $key = 'posts' . request()->page;
        }else {
            # code...
            $key = 'posts';
        }
        if (Cache::has($key)) {
            //verifico que tengo algo almacenado en la cache
            $posts = Cache::get($key);
        } else {
            //Ejecuto la consulta a la ba se de datos
            $posts = Post::where('status', 2)->latest('id')->paginate(8);
            //Almaceno la informacion en cache
            Cache::put($key, $posts);
        }
        
        
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post){
        //regla de validacion para mostrar un POST publicado
        $this->authorize('published', $post);

        //Regla para mostrar post similares
        $similares = Post::where('category_id', $post->category_id)
                            ->where('status', 2)
                            ->where('id', '!=', $post->id)
                            ->latest('id')
                            ->take(4)
                            ->get();
        return view('posts.show', compact('post', 'similares'));
    }

    public function category(Category $category){
        $posts = Post::where('category_id', $category->id)
                        ->where('status', 2)
                        ->latest('id')
                        ->paginate(6);

        return view('posts.category', compact('posts', 'category'));
    }

    public function tag(Tag $tag){
        $posts = $tag->posts()->where('status', 2)
                            ->latest('id')
                            ->paginate(4);

        return view('posts.tag', compact('posts', 'tag'));
    }
}
