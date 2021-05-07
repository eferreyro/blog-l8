<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    //Relacion muchos a muchos TAG con USER
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
