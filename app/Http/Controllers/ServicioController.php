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

    public function create()
    {
        //
        $servicio = new Servicio();
        return Inertia::render('Servicio/create',['registro' => $servicio,'accion' => 'N','menus' => HardCodeMenu::get_menu()]);
    }


    public function store(Request $request)
    {
        //
        $servicio = Servicio::create($request->all());
        return redirect()->back()
                    ->with('message','Servicio creado con éxito');
    }

    public function edit($id)
    {
        //
        $servicio = Servicio::find($id);                
        return Inertia::render('Servicio/create',['registro' => $servicio,'accion' => 'E','menus' => HardCodeMenu::get_menu()]);
    }


    public function update(Request $request, $id)
    {
        //
        Servicio::whereId($id)->update($request->all());
        return redirect()->back()
                    ->with('message','Servicio actualizado con exito');
                    
    }

    public function destroy($servicio)
    {
        //
        $servicio = Servicio::find($servicio);
        $servicio->delete();
        return redirect()->back()
        ->with('message','Servicio eliminado con exito');
       
    }


}
