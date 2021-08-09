<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.categories.index')->only('index');
        $this->middleware('can:admin.categories.create')->only('create', 'store');
        $this->middleware('can:admin.categories.edit')->only('edit', 'update');
        $this->middleware('can:admin.categories.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //rescato la lista de todo lo que tenga la tabla categories en la DB
        $categories = Category::all();
        //Retorno la vista index y le paso lo que viene en la variable $categories de la fila 19
        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        //
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);
        //Genera un registro de categoria de lo que viene desde el create.blade.php
        $category = Category::create($request->all());
        return redirect()->route('admin.categories.edit', $category)->with('info', 'Se ha creado la categoria con exito');
    }


    public function edit(Category $category)
    {
        //
        return view('admin.categories.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:categories,slug,$category->id"
        ]);
        $category->update($request->all());
        return redirect()->route('admin.categories.edit', $category)->with('info', 'Se ha editado la categoria con exito');
    }


    public function destroy(Category $category)
    {
        //Habilito este metodo para activar el boton ELIMINAR
        $category->delete();
        //Redirecciono a la vista
        return redirect()->route('admin.categories.index')->with('info', 'La categoria se elimino con Exito');
    }
}
