<?php

namespace App\Http\Controllers;

use App\Custom\HardCodeMenu;
use App\Models\Servicio;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Inertia\Inertia;
use stdClass;

class DashboardController extends Controller
{
    //
    function index()
    {
        $data = new stdClass();
        $data->servicios = Servicio::all();
        $data->sucursales = Sucursal::all();

        return Inertia::render('Dashboard',['dato' => $data,'menus' => HardCodeMenu::get_menu()]);
    }
}
