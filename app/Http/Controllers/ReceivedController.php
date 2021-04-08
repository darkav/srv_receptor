<?php

namespace App\Http\Controllers;

use App\Custom\HardCodeMenu;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use stdClass;

class ReceivedController extends Controller
{
    // creacion de metodos para crear y borrar tablas de categorias dinamicas

    public function CreateTable($tabla)
    {
        Schema::create($tabla, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("local",10)->nullable();
            $table->string("tabla",50)->nullable();
            $table->string("key",50)->nullable();
            $table->dateTime("fecha_insercion")->nullable();
            $table->dateTime("fecha_actualizacion")->nullable();
            $table->string('registro')->nullable();
            $table->timestamps();

            $table->index(['local','tabla']);
        });
        return redirect()->back()
                    ->with('message',"Creado con éxito la tabla {$tabla}");

    }

    public function ExistTable($tabla)
    {
        $existe = Schema::hasTable($tabla);
    }

    public function DropTable($tabla)
    {
        Schema::dropIfExists($tabla);
        return redirect()->back()
                    ->with('message',"Eliminado con éxito la tabla {$tabla}");
    }

    // retornando toda la data de la tabla
    public function AllRecordTable($categoria)
    {
        $result = DB::table($categoria)
                    ->where([]);
    }

    // metodos para insercion , editar y eliminacion de registros tablas.

    public function InsertTable(Request $request)
    {
        $result = new stdClass();
        //$result->id = DB::()insertGetId("insert into {$request->categoria} (local, tabla,key,fecha_insercion,fecha_actualizacion,registro) 
        //values (?, ?,?,?,?,?)", [$request->local, $request->tabla,$request->key,$request->fecha_insercion,$request->fecha_actualizacion,$request->registro]);
        
        $result->id = DB::table($request->categoria)->insertGetId([
            'local' => $request->local,
            'tabla' => $request->tabla,
            'key' => $request->key,
            'fecha_insercion' => $request->fecha_insercion,
            'fecha_actualizacion' => $request->fecha_actualizacion,
            'registro' => $request->registro                                                          
        ]);
            
        return response()->json($result);
    }

    public function UpdateTable(Request $request)
    {
        $result = new stdClass();
        //$result->id = DB::()insertGetId("insert into {$request->categoria} (local, tabla,key,fecha_insercion,fecha_actualizacion,registro) 
        //values (?, ?,?,?,?,?)", [$request->local, $request->tabla,$request->key,$request->fecha_insercion,$request->fecha_actualizacion,$request->registro]);
        
        $result->id = DB::table($request->categoria)
        ->where([
            'local' => $request->local,
            'tabla' => $request->tabla,
            'key' => $request->key
        ])
        ->update([
            'fecha_actualizacion' => $request->fecha_actualizacion,
            'registro' => $request->registro                                                          
        ]);
            
        return response()->json($result);
    }

    public function MaxRegistro($categoria,$local,$tabla)
    {
        $result = new stdClass();
        $result->max = DB::table($categoria)
        ->where([
            'local' => $local,
            'tabla' => $tabla
        ])
        ->max('key');
        return response()->json($result);
    }



    // presentación
    public function index()
    {
        $categoria = Categoria::all();
        return Inertia::render('GenTable',['categoria' => $categoria,'accion' => 'N','menus' => HardCodeMenu::get_menu()]);
    }
    // presentacion de los movimientos en pantalla con websockets.
}
