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
use SebastianBergmann\Environment\Console;
use stdClass;

class ReceivedController extends Controller
{
    // creacion de metodos para crear y borrar tablas de categorias dinamicas

    public function CreateTable($tabla)
    {
        Schema::create($tabla, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("local",100)->nullable();
            $table->string("tabla",50)->nullable();
            $table->string("idkey",50)->nullable();
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
    public function AllRecordTable($categoria,$local)
    {
        $sentencia = "select local,tabla,idkey,registro from {$categoria} where local = '{$local}' and datediff(fecha_actualizacion,curdate()) < 2";
        $result = DB::select($sentencia);
        return response()->json($result);
    }

    // metodos para insercion , editar y eliminacion de registros tablas.

    public function InsertTable(Request $request)
    {
        $result = new stdClass();
        $result->correctos=0;
        $result->incorrectos=0;
        $result->registrosOK=[]; 
        
        foreach($request->listado as $key => $transaccion) 
        {
            $ok = DB::table($transaccion["categoria"])->insert([
                'local' => $transaccion["local"],
                'tabla' => $transaccion["tabla"],
                'idkey' => $transaccion["idkey"],
                'fecha_insercion' => $transaccion["fecha_insercion"],
                'fecha_actualizacion' => $transaccion["fecha_actualizacion"],
                'registro' => $transaccion["registro"] ,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            if($ok){
                $result->correctos++;
                $result->registrosOK[] = (object) ["idkey" => $transaccion["idkey"], "tabla" => $transaccion["tabla"]];
            }else{
                $result->incorrectos++;
            }
        }

        return response()->json($result);
    }

    public function UpdateTable(Request $request)
    {
        $result = new stdClass();
        $result->correctos=0;
        $result->incorrectos=0;
        $result->registrosOK=[]; 

        foreach($request->listado as $key => $transaccion) 
        {
            $ok = DB::table($transaccion["categoria"])
            ->where([
                'local' => $transaccion["local"],
                'tabla' => $transaccion["tabla"],
                'idkey' => $transaccion["idkey"]
            ])
            ->update([
                'fecha_actualizacion' => now(),
                'registro' => $transaccion["registro"]  ,
                'updated_at' => now()                                                        
            ]);
            if($ok > 0){
                $result->correctos++;
                $result->registrosOK[] = (object) ["idkey" => $transaccion["idkey"], "tabla" => $transaccion["tabla"]];
            }else{
                $result->incorrectos++;                
            }
        }        
        
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
        ->max('idkey');
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
