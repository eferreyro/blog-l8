<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Post extends Model
{
    use HasFactory;

    //Relacion uno a muchos Inversa POST con USUARIOS
    public function user(){
        return $this->belongsTo(User::class);
    }
    //Relacion uno a muchos Inversa POST con CATEGORY
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Relacion Muchos a Muchos POST con TAGS
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }


    //Relacion uno a uno Polimorfica con IMAGES
    public function image(){
        return $this->MorphOne(Image::class, 'imageable');
    }

}
