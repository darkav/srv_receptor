<?php

namespace App\Http\Controllers;

use App\Custom\ICMP;
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

    public function ping(Request $request)
    {
        $sucursales = $request->datos;
        
        foreach($sucursales as $clave => $sucursal)
        {
            if((new ICMP())->ping($sucursal['ip']))
                $sucursales[$clave]["conectado"] = true;
            else
                $sucursales[$clave]["conectado"] = false;
        }
        return $sucursales;
    }


}
