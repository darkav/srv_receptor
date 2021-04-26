<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ApiServicioController extends Controller
{
    //

    public function index()
    {
        return Servicio::where("estado","=","ACT")->get();
    }

    public function show($id)
    {
        $categoria = Servicio::find($id);
        return $categoria;
    }

    public function update(Request $request)
    {
        $id = Servicio::whereId($request->id)->update($request->all());
        return $id;
    }



}
