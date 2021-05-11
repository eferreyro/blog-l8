<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class Navigation extends Component
{
    public function render()
    {
        //Recupero toda la coleccion de la base de datos Category
        $categories = Category::all();
        return view('livewire.navigation', compact('categories'));
    }
}
