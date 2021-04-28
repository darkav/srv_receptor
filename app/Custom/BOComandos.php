<?php
    namespace App\Custom;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
    use Illuminate\Support\Arr;
use stdClass;

use function GuzzleHttp\json_decode;

class BOComandos
    {
        private $conexion = [];



        public function toJSON($objeto)
        {
            $retorno = null;
            try
            {
                $retorno = json_decode($objeto);
            }catch(Exception $ex)
            {
                $retorno = $objeto;
            }
            return $retorno;
        }

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
           array_values($destino)[0]->conexion->send(json_encode($mensaje));
        }


        public function execComando($mensaje,$conId,$conn)
        {
            echo( $mensaje);
            echo("\r\n");
            $comando = $this->toJSON($mensaje);
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
                case 13: //STOPALL
                    $this->conexion =  $this->_stopAll($comando,$conId);
                    break;
                case 14: //RESET
                    $this->conexion =  $this->_reset($comando);
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

        private function _stop($mensaje,$conId)
        {
            $app = Arr::where($this->conexion,function($key,$value){
                return Str::contains(Str::lower($this->conexion[$value]->device), 'appsys');
            });
            if(count($app) > 0)
            {
                $this->sendOnly($app,$mensaje);
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
                $this->sendOnly($app,$mensaje);
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
            $responde = new stdClass();
            $responde->proviene = $mensaje;
            $responde->datos = $this->conexion; 
            $responde->comando = 6;
            $responde->device = "ALL";
            $responde->info = "Obteniendo status de dispositivos conectados";
            $navegadores = Arr::where($this->conexion, function ($key, $value) {
                return Str::contains(Str::lower($this->conexion[$value]->device), 'nav') ;
            });

            if(count($navegadores) > 0)
            {
                $this->sendAll($navegadores,$responde);
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
                $this->sendOnly($app,$mensaje);
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
                $this->sendOnly($app,$mensaje);
            }
            return $this->conexion;            
        }

        private function _connected($mensaje,$conId,$conn)
        {
            $app = Arr::where($this->conexion,function($key,$value){
                return Str::contains(Str::lower($this->conexion[$value]->device), 'appsys');
            });

            if(count($app) > 0)
            {
                $this->sendOnly($app,$mensaje);
            }
            return $this->conexion;            
        }

        private function _disconnected($mensaje,$conId)
        {
            $app = Arr::where($this->conexion,function($key,$value){
                return Str::contains(Str::lower($this->conexion[$value]->device), 'appsys');
            });
            if(count($app) > 0)
            {
                $this->sendOnly($app,$mensaje);
            }
            return $this->conexion;            
        }

        private function _stopAll($mensaje,$conId)
        {
            $mensaje->datos = [];            
            foreach($this->conexion as $key => $valor)
            {
                if(!Str::contains(Str::lower($valor->device),'nav') && !Str::contains(Str::lower($valor->device),'appsys'))
                {
                    $mensaje->datos[] = $valor->device;
                }
            }
            $mensaje->info="DETACH SUCURSAL";
            $navegadores = Arr::where($this->conexion, function ($key, $value) {
                return Str::contains(Str::lower($this->conexion[$value]->device), 'nav') ;
            });

            if(count($navegadores) > 0)
            {
                $this->sendAll($navegadores,$mensaje);
            }
            return $this->conexion;            
        }

        private function _reset($mensaje)
        {
            echo("entro en el modo _reset {$mensaje->conId} {$mensaje->comando}");
            if($mensaje->nodo == null)
            {
                foreach($this->conexion as $clave => $valor)
                {
                    unset($valor);
                }
            }else{
                    unset($this->conexion[$mensaje->conId]);
            }
            $this->_getStatus($mensaje,null);
            return $this->conexion;
        }

    }


?>