<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'color'];

    //funcion para que en lugar ed enviar el ID al editar, muestre el SLUG
    public function getRouteKeyName()
    {
        return "slug";
    }
    
    //Relacion muchos a muchos TAG con USER
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
