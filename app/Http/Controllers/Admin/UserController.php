<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit', 'update');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.users.index');
    }

    
    public function edit(User $user)
    {
        //Recupero el listado de roles
        $roles = Role::all();

        //Retorno la vista EDIT con la lista del usuario
        return view('admin.users.edit', compact('user', 'roles'));

    }

    
    public function update(Request $request, User $user)
    {
        //
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.edit', $user)->with('info', 'Se asigno Rol correctamente');
    }

    
}
