<?php

namespace App\Http\Controllers;

use App\Models\CategoriaTabla;
use Illuminate\Http\Request;

class CategoriaTablaController extends Controller
{
    //

    public function store(Request $request)
    {
        //
        $result = CategoriaTabla::create($request->all());
        return redirect()->back()
                    ->with('message','Tabla creado con éxito');

    }

    public function destroy($id)
    {
        //
        $cattab = CategoriaTabla::find($id);
        $cattab->delete();
        return redirect()->back()
        ->with('message','Tabla eliminado con exito');

    }


}
