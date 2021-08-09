<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    //Activo la paginacion controlada de Livewire WithPagination
    use WithPagination;
    //Activo un buscador de usuarios
    public $search;

    //Protejo la vista para que sea usado Bootstrap y no tailwind css
    protected $paginationTheme = "bootstrap";
    
    //funcion que limpia la pagina cuando se hace una busqueda
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
       

        //recupero la lista de usuarios de la base de datos y la agrego a lavariable $users
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')->paginate();
        return view('livewire.admin.users-index', compact('users'));
    }
}
