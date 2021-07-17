<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    //Habilito la asignacion masiva para que pueda mover las imagenes desde la variable url
    protected $fillable = ['url'];
    //Aceptamos las relaciones polimorficas
    public function imageable(){
        return $this->morphTo();
    }
}
