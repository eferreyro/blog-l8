<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.tags.index')->only('index');
        $this->middleware('can:admin.tags.create')->only('create', 'store');
        $this->middleware('can:admin.tags.edit')->only('edit', 'update');
        $this->middleware('can:admin.tags.destroy')->only('destroy');
    }

    public function index()
    {
        $tags = Tag::all();
        //Indico que este metodo retorna una vista view
        return view('admin.tags.index', compact('tags'));
    }


    public function create()
    {
        //Defino variable de nombre color y lo convierto en un array
        $colors = [
            'red' => 'Color Rojo',
            'yellow' => 'Color Amarillo',
            'green' => 'Color Verde',
            'blue' => 'Color Azul',
            'indigo' => 'Color Indigo',
            'purple' => 'Color Morado',
            'pink' => 'Color Rosado',
            'brown' => 'Color Cafe',
            'magenta' => 'Color Magenta'
        ];
        //Indico que este metodo retorna una vista view
        return view('admin.tags.create', compact('colors'));
    }


    public function store(Request $request)
    {
        //Retorno el valor de lo que se manda por el formulario
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:tags',
            'color' => 'required',

        ]);
        $tag = Tag::create($request->all());
        return redirect()->route('admin.tags.edit', compact('tag'))->with('info', 'La etiqueta fue creada');
    }


    public function edit(Tag $tag)
    {
        $colors = [
            'red' => 'Color Rojo',
            'yellow' => 'Color Amarillo',
            'green' => 'Color Verde',
            'blue' => 'Color Azul',
            'indigo' => 'Color Indigo',
            'purple' => 'Color Morado',
            'pink' => 'Color Rosado',
            'brown' => 'Color Cafe',
            'magenta' => 'Color Magenta'
        ];
        //Indico que este metodo retorna una vista view
        return view('admin.tags.edit', compact('tag', 'colors'));
    }


    public function update(Request $request, Tag $tag)
    {
        //Regla de validacion  del formulario tags
        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:tags,slug,$tag->id",
            'color' => 'required',

        ]);
        $tag->update($request->all());
        return redirect()->route('admin.tags.edit', $tag)->with('info', 'La etiqueta fue actualizada');

    }


    public function destroy(Tag $tag)
    {
        //llamamos al objeto TAG y luego le pasamos el metodo DELETE
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('info', 'La etiqueta fue eliminada');

    }
}
