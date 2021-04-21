<?php
    namespace App\Custom;

use Carbon\Carbon;
use Illuminate\Support\Str;
    use Illuminate\Support\Arr;
use stdClass;

class BOComandos
    {
        private $conexion = [];


        public function set($conexiones)
        {
            $this->conexion = $conexiones;
        }

        public function sendAll($destinos,$mensaje)
        {
            foreach($destinos as $clave => $nodo)
            {
                $nodo->conexion->send(json_encode($mensaje));
            }
        }

        public function sendOnly($destino,$mensaje)
        {
            $this->conexion[$destino]->send(json_encode($mensaje));
        }


        public function execComando($mensaje,$conId,$conn)
        {
            $comando = json_decode($mensaje);
            switch($comando->comando)
            {
                case 1: //PING
                    $this->conexion =  $this->_ping($comando,$conId);
                    break;
                case 2: //STOP
                    $this->conexion =  $this->_stop($comando,$conId);
                    break;
                case 3: //START
                    $this->conexion =  $this->_start($comando,$conId);
                    break;
                case 4: //REGISTER
                    $this->conexion =  $this->_register($comando,$conId);
                    break;
                case 5: //UNREGISTER
                    $this->conexion =  $this->_unregister($comando,$conId);
                    break;
                case 6: //SENDINFO
                    $this->conexion =  $this->_sendInfo($comando,$conId);
                    break;
                case 7: //SENDERROR
                    $this->conexion =  $this->_sendError($comando,$conId);
                    break;
                case 8: //GETSTATUS
                    $this->conexion =  $this->_getStatus($comando,$conId);
                    break;
                case 9: //SETCONFIG
                    $this->conexion =  $this->_setConfig($comando,$conId);
                    break;
                case 10: //GETCONFIG
                    $this->conexion =  $this->_getConfig($comando,$conId);
                    break;
                case 11: //CONNECTED
                    $this->conexion =  $this->_connected($comando,$conId,$conn);
                    break;
                case 12: //DISCONNECTED
                    $this->conexion =  $this->_disconnected($comando,$conId);
                    break;
                case 99: //ERROR
                    //$this->conexion =  $this->_ping($comando,$conId);
                    echo "Error de conexion con el socket \n";
                    break;
                
                    
            }
            return $this->conexion;
        }

        private function _ping($mensaje,$conId)
        {
            $navegadores = Arr::where($this->conexion, function ($key, $value) {
                return Str::contains(Str::lower($this->conexion[$value]->device), 'nav') ;
            });

            if(count($navegadores) > 0)
            {
                $this->sendAll($navegadores,$mensaje);
            }
            return $this->conexion;
        }

        private function _stop($mensaje,$conId)
        {
            $app = Arr::where($this->conexion,function($key,$value){
                return Str::contains(Str::lower($this->conexion[$value]->device), 'appsys');
            });

            if(count($app) > 0)
            {
                $this->sendOnly($app[0],$mensaje);
            }
            return $this->conexion;            
        }

        private function _start($mensaje,$conId)
        {
            $app = Arr::where($this->conexion,function($key,$value){
                return Str::contains(Str::lower($this->conexion[$value]->device), 'appsys');
            });

            if(count($app) > 0)
            {
                $this->sendOnly($app[0],$mensaje);
            }
            return $this->conexion;            

        }


        private function _register($mensaje,$conId)
        {
            $this->conexion[$conId]->device=$mensaje->device;

            $navegadores = Arr::where($this->conexion, function ($key, $value) {
                return Str::contains(Str::lower($this->conexion[$value]->device), 'nav') ;
            });
                
            if(count($navegadores) > 0)
            {
                $this->sendAll($navegadores,$mensaje);
            }
            return $this->conexion;            

        }

        private function _unregister($mensaje,$conId)
        {
            $this->conexion[$conId]->device='unregister';
            $navegadores = Arr::where($this->conexion, function ($key, $value) {
                return Str::contains(Str::lower($this->conexion[$value]->device), 'nav') ;
            });

            if(count($navegadores) > 0)
            {
                $this->sendAll($navegadores,$mensaje);
            }
            return $this->conexion;            
        }

        private function _sendInfo($mensaje,$conId)
        {
            $navegadores = Arr::where($this->conexion, function ($key, $value) {
                return Str::contains(Str::lower($this->conexion[$value]->device), 'nav') ;
            });

            if(count($navegadores) > 0)
            {
                $this->sendAll($navegadores,$mensaje);
            }
            return $this->conexion;            
        }

        private function _sendError($mensaje,$conId)
        {
            $navegadores = Arr::where($this->conexion, function ($key, $value) {
                return Str::contains(Str::lower($this->conexion[$value]->device), 'nav') ;
            });

            if(count($navegadores) > 0)
            {
                $this->sendAll($navegadores,$mensaje);
            }
            return $this->conexion;            
        }

        private function _getStatus($mensaje,$conId)
        {
            $mensaje->datos = $this->conexion;
            $navegadores = Arr::where($this->conexion, function ($key, $value) {
                return Str::contains(Str::lower($this->conexion[$value]->device), 'nav') ;
            });

            if(count($navegadores) > 0)
            {
                $this->sendAll($navegadores,$mensaje);
            }
            return $this->conexion;            

        }

        private function _setConfig($mensaje,$conId)
        {
            $app = Arr::where($this->conexion,function($key,$value){
                return Str::contains(Str::lower($this->conexion[$value]->device), 'appsys');
            });

            if(count($app) > 0)
            {
                $this->sendOnly($app[0],$mensaje);
            }
            return $this->conexion;            
        }

        private function _getConfig($mensaje,$conId)
        {
            $app = Arr::where($this->conexion,function($key,$value){
                return Str::contains(Str::lower($this->conexion[$value]->device), 'appsys');
            });

            if(count($app) > 0)
            {
                $this->sendOnly($app[0],$mensaje);
            }
            return $this->conexion;            
        }

        private function _connected($mensaje,$conId,$conn)
        {
            if(!Arr::has($this->conexion,$conId))
            {
                $nodo = new stdClass();
                $nodo->conexion = $conn;
                $nodo->device = 'unregister';
                $nodo->estado = 'IDL';
                $this->connections[$conn->resourceId] = $nodo;
                echo "conectando al resource {$conn->resourceId} \n";
            }

            $this->mensaje->datos = $this->conexion;

            $app = Arr::where($this->conexion,function($key,$value){
                return Str::contains(Str::lower($this->conexion[$value]->device), 'nav');
            });

            if(count($app) > 0)
            {
                $this->sendAll($app[0],$mensaje);
            }
            return $this->conexion;            
        }

        private function _disconnected($mensaje,$conId)
        {
            if(Arr::has($this->conexion,$conId))
            {
                $disconnectedId = $conId;
                $mensaje->comando = 12;
                $mensaje->device = $this->connections[$disconnectedId]->device;
                $mensaje->info = "Desconexión del equipo ${Carbon::now()->timezone(env('TIEMPO_LOCAL'))->format('Y-m-d H:i:s')}";
                unset($this->connections[$disconnectedId]);
            }

            $this->mensaje->datos = $this->conexion;

            $app = Arr::where($this->conexion,function($key,$value){
                return Str::contains(Str::lower($this->conexion[$value]->device), 'nav');
            });

            if(count($app) > 0)
            {
                $this->sendAll($app[0],$mensaje);
            }
            return $this->conexion;            
        }


    }


?>