<?php

namespace App\Http\Controllers;

use App\Custom\BOComandos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Inertia\Inertia;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;
use stdClass;

class WebSocketController extends Controller implements MessageComponentInterface
{
    //
    private $connections = [];
    private $bo ;
    private $exitCode;

    function onOpen(ConnectionInterface $conn)
    {
        if($this->bo == null)
            $this->bo = new BOComandos();

        $nodo = new stdClass();
        $nodo->conexion = $conn;
        $nodo->device = 'unregister';
        $nodo->estado = 'IDL';
        $this->connections[$conn->resourceId] = $nodo;
        $this->bo->set($this->connections);
        echo "conectando al resource {$conn->resourceId} \n";
    }

    function onClose(ConnectionInterface $conn)
    {
        $mensaje = new stdClass();
        $disconnectedId = $conn->resourceId;
        $mensaje->comando = 12;
        $mensaje->device = $this->connections[$disconnectedId]->device;
        $mensaje->info = "Desconexión del equipo ${Carbon::now()->timezone(env('TIEMPO_LOCAL'))->format('Y-m-d H:i:s')}";
        unset($this->connections[$disconnectedId]);
        foreach($this->connections as &$connection)
            $connection['conn']->send(json_encode($mensaje));
        $this->bo->set($this->connections);
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        $userId = $this->connections[$conn->resourceId]->device;
        echo "Un error ha ocurrido con el dispositivo $userId: {$e->getMessage()}\n";
        unset($this->connections[$conn->resourceId]);
        $conn->close();
    }

    function onMessage(ConnectionInterface $conn, $msg)
    {
        $this->connections = $this->bo->execComando($msg,$conn->resourceId,$conn);
    }

    function OnOffWebSocketServer($flag)
    {
        
        switch($flag)
        {
            case true:
                $this->exitCode = Artisan::queue('websocket:init');
                break;
            case false:
                $this->exitCode->__destruct();
                break;
        }
        return redirect()->back();
    }


}
