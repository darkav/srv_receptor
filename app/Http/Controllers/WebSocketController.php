<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class WebSocketController extends Controller implements MessageComponentInterface
{
    //
    private $connections = [];

    function onOpen(ConnectionInterface $conn)
    {
        $this->connections[$conn->resourceId] = compact('conn') + ['user_id' => null];
    }

    function onClose(ConnectionInterface $conn)
    {
        $disconnectedId = $conn->resourceId;
        unset($this->connections[$disconnectedId]);
        foreach($this->connections as &$connection)
            $connection['conn']->send(json_encode([
                'offline_user' => $disconnectedId,
                'from_user_id' => 'server control',
                'from_resource_id' => null
            ]));
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        $userId = $this->connections[$conn->resourceId]['user_id'];
        echo "An error has occurred with user $userId: {$e->getMessage()}\n";
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
