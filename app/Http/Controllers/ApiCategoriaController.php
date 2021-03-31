<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class ApiCategoriaController extends Controller
{
    //
    public function index()
    {
        return Categoria::all();
    }

    public function show($id)
    {
        $categoria = Categoria::find($id);
        return $categoria;
    }


    public function listarTablas($id)
    {
        $categoria = Categoria::find($id);
        return $categoria->categoriatablas->all();
    }

    public function ally()
    {
        $categorias = Categoria::all()->map(function($cat){
            $tablas = $cat->categoriatablas->all();
            $cat->tablas = $tablas;
            return $cat;
        });
        return $categorias;
    }

}


