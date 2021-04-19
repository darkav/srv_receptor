<?php
    namespace App\Custom;
    use Illuminate\Support\Str;
    use Illuminate\Support\Arr;



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


        public function execComando($mensaje,$conId)
        {
            $comando = json_decode($mensaje);
            switch($comando->comando)
            {
                case 1: //PING
                    $this->conexion =  $this->_ping($comando,$conId);
                    break;
                case 2: //STOP
                    break;
                case 3: //START
                    break;
                case 4: //REGISTER
                    break;
                case 5: //UNREGISTER
                    break;
                case 6: //SENDINFO
                    break;
                case 7: //SENDERROR
                    break;
                case 8: //GETSTATUS
                    break;
                case 9: //SETCONFIG
                    break;
                case 10: //GETCONFIG
                    break;
                case 11: //CONNECTED
                    break;
                case 12: //DISCONNECTED
                    break;
                case 99: //ERROR
                    break;
                
                    
            }
            return $this->conexion;
        }

        private function _ping($mensaje,$conId)
        {
            $navegadores = Arr::where($this->conexion, function ($key, $value) {
                return Str::contains(Str::lower($value->device), 'nav') ;
            });

            if(count($navegadores))
            {
                $this->sendAll($navegadores,$mensaje);
            }
        }

        private function _stop($mensaje,$conId)
        {

        }

        private function _register($mensaje,$conId)
        {

        }

        private function _unregister($mensaje,$conId)
        {
            
        }

        private function _sendInfo($mensaje,$conId)
        {

        }

        private function _sendError($mensaje,$conId)
        {

        }

        private function _getStatus($mensaje,$conId)
        {

        }

        private function _setConfig($mensaje,$conId)
        {

        }

        private function _getConfig($mensaje,$conId)
        {

        }

        


    }


?>