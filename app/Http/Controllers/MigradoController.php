<?php

namespace App\Http\Controllers;

use App\Custom\HardCodeMenu;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MigradoController extends Controller
{
    //
    public function index()
    {
        $categorias = Categoria::all();
        foreach($categorias as $key => $valor)
        {
            $valor->tablas =  $categorias[$key]->categoriatablas()->get();
        }
        return Inertia::render('Migrado',['categorias' => $categorias,'menus' => HardCodeMenu::get_menu()]);        
    }
}
