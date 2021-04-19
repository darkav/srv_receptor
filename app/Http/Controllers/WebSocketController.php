<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;
use stdClass;

class WebSocketController extends Controller implements MessageComponentInterface
{
    //
    private $connections = [];

    function onOpen(ConnectionInterface $conn)
    {
        $nodo = new stdClass();
        $nodo->conexion = $conn;
        $nodo->device = 'unregister';
        $nodo->estado = 'IDL';
        $this->connections[$conn->resourceId] = $nodo;
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

        if(is_null($this->connections[$conn->resourceId]['user_id'])){
            $this->connections[$conn->resourceId]['user_id'] = $msg;
            $onlineUsers = [];
            foreach($this->connections as $resourceId => &$connection){
                $connection['conn']->send(json_encode([$conn->resourceId => $msg]));
                if($conn->resourceId != $resourceId)
                    $onlineUsers[$resourceId] = $connection['user_id'];
            }
            $conn->send(json_encode(['online_users' => $onlineUsers]));
        } else{
            $fromUserId = $this->connections[$conn->resourceId]['user_id'];
            $msg = json_decode($msg, true);
            $this->connections[$msg['to']]['conn']->send(json_encode([
                'msg' => $msg['content'],
                'from_user_id' => $fromUserId,
                'from_resource_id' => $conn->resourceId
            ]));
        }      

    }

}
