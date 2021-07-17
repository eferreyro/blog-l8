<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function creating(Post $post)
    {
       if (! \App::runningInConsole()) {
            //Cada VEZ QUE SE CREA un nuevo POST se le asigna el usuario logeado
            $post->user_id = auth()->user()->id;
       }
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleting(Post $post)
    {
        //
        if ($post->image) {
            # Cada vez que elimino un POST que tiene una imagen, tambien se elimina el archivo de imagen
            Storage::delete($post->image->url);
        }

    }
}
