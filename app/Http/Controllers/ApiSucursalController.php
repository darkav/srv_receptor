<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class ApiSucursalController extends Controller
{
    //

    public function index()
    {
        return Sucursal::all();
    }

    public function show($id)
    {
        $sucursal = Sucursal::find($id);
        return $sucursal;
    }


}
