<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        //Indico que este metodo retorna una vista view
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //Indico que este metodo retorna una vista view
        return view('admin.tags.show', compact($tag));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Tag $tag
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Tag $tag
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //llamamos al objeto TAG y luego le pasamos el metodo DELETE
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('info', 'La etiqueta fue eliminada');

    }
}
