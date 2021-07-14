<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;

use Livewire\WithPagination;

class PostsIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;
    //funcion que limpia la pagina cuando se hace una busqueda
    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        //recupero la lista de POST que ha creado el usuario actualmente logeado
        $posts = Post::where('user_id', auth()->user()->id)
                    ->where('name', 'LIKE','%' . $this->search . '%') //Filtro de buscador
                    ->latest('id') //Orden Descendente
                    ->paginate(); //Paginacion


        return view('livewire.admin.posts-index', compact('posts'));
    }
}
