<?php

namespace App\Http\Controllers;

use App\Custom\HardCodeMenu;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Inertia\Inertia;
use stdClass;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Categoria::all();
        return Inertia::render('Categoria',['data' => $data,'menus' => HardCodeMenu::get_menu()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categoria = new Categoria();
        return Inertia::render('Categoria/create',['registro' => $categoria,'accion' => 'N','menus' => HardCodeMenu::get_menu()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $categoria = Categoria::create($request->all());
        return redirect()->back()
                    ->with('message','Categoria creado con éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categoria = Categoria::find($id);                
        return Inertia::render('Categoria/create',['registro' => $categoria,'accion' => 'E','menus' => HardCodeMenu::get_menu()]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        Categoria::whereId($id)->update($request->all());
        return redirect()->back()
                    ->with('message','Categoría actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $categoria = Categoria::find($id);
        $categoria->delete();
        return redirect()->back()
        ->with('message','Categoría eliminado con exito');

    }

    public function edit_tabla($id)
    {
        $categoria = Categoria::find($id);
        $cat_tabla = $categoria->categoriatablas->all();

        $resultado = new stdClass();
        $resultado->categoria_id = $categoria->id;
        $resultado->categoria = $categoria->nombre;
        $resultado->tabla = empty($cat_tabla) ? [] : $cat_tabla;
        return Inertia::render("Categoria/tabla",[  'registro' => $resultado,
                                                    'accion' => "E",
                                                    'menus' => HardCodeMenu::get_menu()
                                                ]);
    }
}
