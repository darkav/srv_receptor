<?php

namespace App\Http\Controllers;

use App\Custom\HardCodeMenu;
use App\Models\Categoria;
use App\Models\CategoriaTabla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function filter(Request $request)
    {
        // validacion

        $categoria = Categoria::whereId($request->categoria)->get()[0];
        $tabla = CategoriaTabla::whereId($request->tabla)->get()[0];

        $from = date($request->fecini);
        $to = date($request->fecfin);

       
        return DB::table($categoria->nombre)
            ->where("tabla","=",$tabla->tabla)
            ->whereBetween("fecha_insercion",[$from,$to])
            ->paginate($request->pagineo);
    }
}
