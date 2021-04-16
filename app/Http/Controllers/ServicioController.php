<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use App\Custom\HardCodeMenu;
use Inertia\Inertia;

class ServicioController extends Controller
{
    //

    public function index()
    {
        $data = Servicio::all();
        return Inertia::render('Servicio',['data' => $data,'menus' => HardCodeMenu::get_menu()]);
    }


}
