<?php

namespace App\Http\Controllers;

use App\Custom\HardCodeMenu;
use App\Models\Sucursal;
use Database\Factories\SucursalFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Sucursal::all();
        return Inertia::render('Sucursales',['data' => $data,'menus' => HardCodeMenu::get_menu()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sucursal = new Sucursal();
        return Inertia::render('Sucursales/create',['sucursal' => $sucursal,'accion' => 'N','menus' => HardCodeMenu::get_menu()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd($request->all());
        $sucursal = Sucursal::create($request->all());
        return redirect()->back()
                    ->with('message','Sucursal creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $sucursal = Sucursal::find($id);                
        return Inertia::render('Sucursales/create',['sucursal' => $sucursal,'accion' => 'E','menus' => HardCodeMenu::get_menu()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $sucursal = new Sucursal();
        Sucursal::whereId($id)->update($request->all());
        return redirect()->back()
                    ->with('message','Sucursal actualizado con exito');
                    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sucursal)
    {
        //

        $sucursal = Sucursal::find($sucursal);
        $sucursal->delete();
        return redirect()->back()
        ->with('message','Sucursal eliminado con exito');
       
    }
}
