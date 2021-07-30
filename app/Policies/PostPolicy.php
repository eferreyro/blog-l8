<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Post;
class PostPolicy
{
    use HandlesAuthorization;
    //Creo un metodo para una regla de autorizacion de usuario logeado

    public function author(User $user, Post $post){
        if($user->id == $post->user_id){
            return true;
        }else{
            return false;
        }
    }
    public function published(?User $user, Post $post){
        //Regla de validacion que verifica que el Status de un POST esta como Publicado o pendiente
        if ($post->status == 2) {
            return true;
        }else{
            return false;
        }

    }
}
