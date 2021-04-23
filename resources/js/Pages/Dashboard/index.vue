<template>
    <pantalla
        ref="pantalla"
        :menus="menus"
        :registro="getRegistro"
        :accion="accion"
        :linkBack="linkBack"
        :titulo="titulo"
        :linkStoreShow="false"
        :icono="icono"
        sizeclase="card w-100"
    >
        <template v-slot:reporte>
            <div class="row">
                <!-- Activar el servicio -->
                <div class="cell-12">
                    <div class="row">
                        <div class="cell-4">
                            <select data-role="select" data-add-empty-value="true" data-empty-value="Servicios"
                                v-model="selServicio"
                            >
                                <optgroup label="Servicios">
                                    <option v-for="(serv,idx) in getServicios" :value="serv.id" :key="idx"
                                    :data-template="serv.icono"
                                    >
                                        {{serv.nombre}}
                                    </option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="cell-1">
                            <input type="checkbox" data-role="switch" data-on="ON" data-off="OFF">
                        </div>
                        <div class="cell-1 offset-5">
                            <div class="button success outline" @click="refreshPage">Refrescar</div>
                        </div>

                    </div>
                </div>
                <!-- marquee -->
                <div class="cell-12">
                    <span class="marquee" data-role="marquee">
                        <p class="py-5 w-100">
                            <template v-for="(msg,ims) in getMensajes" :key="ims">{{msg}} |</template>                            
                        </p>
                    </span>  
                </div>
                <!-- enviar comandos -->
                <div class="cell-12">
                    <div data-role="panel" class="w-100"
                        data-title-caption="Enviar comandos"
                        data-collapsible = "true"
                        data-title-icon="<span class='mif-flash-on'></span>"
                    >
                        <div class="row w-100 d-flex flex-align-center">
                            <div class="cell-3">
                                <select data-role="select" data-add-empty-value="true" data-empty-value="Servicios"
                                    v-model="selEvento"
                                >
                                    <optgroup label="Conexión">
                                        <option value="1">Ping</option>
                                        <option value="11">Conectar</option>
                                        <option value="12">Desconectar</option>
                                    </optgroup>
                                    <optgroup label="Proceso">
                                        <option value="3">Iniciar</option>
                                        <option value="2">Detener</option>
                                    </optgroup>
                                    <optgroup label="Información">
                                        <option value="8">Status</option>
                                    </optgroup>
                                    <optgroup label="Configuración">
                                        <option value="8">Setear</option>
                                        <option value="2">Obtener</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="cell-4">
                                <select v-model="selectSucursal" data-role="select" multiple
                                    @change="changeSucursal"
                                >
                                    <optgroup label="Sucursales">
                                        <option :value=-1>TODAS LAS SUCURSALES</option>
                                        <option v-for="(suc,isc) in getSucursales" :key=isc
                                        :value="suc.alias">{{suc.nombre}}</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="cell-1">
                                <div class="button primary outline" @click="sendComandos">Enviar</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sucursales -->
                <div class="cell-12">
                    <div data-role="panel" class="w-100"
                        data-title-caption="Sucursales"
                        data-collapsible="true"
                        data-title-icon="<span class='mif-shop'></span>"
                    >
                        <div class="row h-25 w-100 d-flex flex-align-center">
                            <div class="cell-4">
                                <span>Conectados:</span><b class="mx-5">{{getConectados}}</b>
                            </div>
                            <div class="cell-4">
                                <span>Desconectados:</span><b class="mx-5">{{getNoConectados}}</b>
                            </div>
                            <div class="cell-4">
                                <input v-model="sucSearch" type="text" data-role="input" data-search-button="true">
                            </div>
                        </div>
                        <div class="my-10 w-100 d-flex flex-wrap">
                            <div :class="'shortcut mx-4 my-4 px-5' +  (suc.conectado ? ' success ' : '') "
                                v-for="(suc,isx) in getSucursales"
                                :key="isx"
                            >
                                <span class="caption text-lower ">{{suc.alias}}</span>
                                <span class="mif-shop mif-3x"></span>
                                <span class="badge">
                                    <span class="mif-wifi-off"></span>
                                </span>
                            </div>
                        </div>

                    </div>

                </div>
                
            </div>
            <!-- -->
                    
        </template>
    </pantalla>

</template>
<script>
import Pantalla from '../../controles/pantalla';
import { format } from 'date-fns';

export default {
    props:["dato","menus"],
    components:{
        'pantalla' : Pantalla
    },

    mounted(){
        // preguntando si esta conectado el websocket
        let my = this;
        if(window.Echo == null)
        {
            this.mensajes.push("Error Grave al conectar");
        }

        console.log("window echo", window.Echo.readyState);
        if(window.Echo.readyState == 1)
        {
            console.log("conectado crv");
            this.mensajes.push("Conectando al Live Data");
            this.device = `nav${format(new Date(),'yyyyMMddHHmmss')}`;
            let mensaje = {};
            mensaje.device = this.device;
            mensaje.info = "Registrando device";
            mensaje.comando = 4;
            window.Echo.send(JSON.stringify(mensaje));
        }else{
            this.dato.sucursales.map((suc) => {
                suc.conectado=false;
            });
        }

        window.Echo.addEventListener('open', function(evt){
            console.log("conectado crv");
            my.mensajes.push("Conectando al Live Data");
        });

        window.Echo.addEventListener('error', function(evt){
            console.log("no se pudo conectar crv");
            my.mensajes.push("No se puede conectar al Live Data");
        });

        window.Echo.addEventListener('message', function(evt){
            //aqui debe de actualizar las sucursales;
            my.captStream(evt.data);
            //my.mensajes.push("enviando mensaje");
        });



    },
    data(){
        return{
            titulo: "Dashboard",    
            device:"",
            accion:"R",
            linkBack:"categoria.index",
            selServicio:"",
            sucSearch:"",
            icono:"<span class='mif-dashboard'></span>",
            mensajes:[],
            cssconectado:'',
            wsServicio:'',
            selectSucursal:[],
            selEvento:""
        }
    },
    computed:{
        getServicios()
        {
            console.log("getServicios", this.dato.servicios);
            if(this.dato.servicios == undefined) return [];
            console.log("entrando carajo", this.servicios);
            this.dato.servicios.map((x) => {
                x.icono =   x.estado == "IDL" ? "<span class='mif-done'></span> $1" :
                            x.estado == "STP" ? "<span class='mif-not'></span> $1" :
                            "<span class='mif-checkmark'></span> $1"
            });
            return this.dato.servicios;
        },

        getSucursales()
        {
            let my = this;
            return this.dato.sucursales.filter( (suc) => {
                return suc.nombre.toLowerCase().contains(my.sucSearch.toLowerCase()) 
            }) || [];
        },

        getMensajes()
        {
            console.log("entrando a mensajes", this.mensajes);
            return this.mensajes || [];
        },

        getRegistro()
        {
            return {};
        },
        getConectados()
        {
            if(this.dato.sucursales == undefined) return 0;
            return this.dato.sucursales.filter(x => x.conectado == true).length;
        },
        getNoConectados()
        {
            if(this.dato.sucursales == undefined) return 0;
            return this.dato.sucursales.filter(x => !x.conectado ).length;
        }


    },
    methods:{
        captStream(mensaje)
        {
            let comando = JSON.parse(mensaje);
            switch(comando.comando)
            {
                case 1:
                    this.ping(comando);
                    break;
                case 4:
                    this.register(comando);
                    break;
                case 5:
                    this.unRegister(comando);
                    break;
                case 6:
                    this.sendInfo(comando);
                    break;
                case 7:
                    this.sendError(comando);
                    break;
                case 8:
                    this.getStatus(comando);
                    break;
                case 10:
                    this.getConfig(comando);
                    break;
                case 11:
                    this.connected(comando);
                    break;
                case 12:
                    this.disconnected(comando);
                    break;
                case 99:
                    this.errorMsg(mensaje);
                    break;
            }
        },
        ping(mensaje)
        {
            console.log("mapeando ping",mensaje,this.dato.sucursales);
            this.dato.sucursales.map( (suc) => {
                if(suc.alias == mensaje.device)
                {
                    if(mensaje.info.contains('ATTACH'))
                        suc.conectado = true;
                    else
                        suc.conectado = false;
                }
            });
        },
        register(mensaje)
        {

        },
        unregister(mensaje)
        {

        },
        sendInfo(mensaje)
        {

        },
        sendError(mensaje)
        {

        },
        getStatus(mensaje)
        {

        },
        getConfig(mensaje)
        {

        },
        connected(mensaje)
        {

        },
        disconnected(mensaje)
        {

        },
        errorMsg(mensaje)
        {

        },
        
        refreshPage()
        {
            location.reload();
        },
        sendComandos()
        {
            console.log("obteniendo informacion de la matriz",this.selectSucursal);
            if(window.Echo.readyState == 1)            
            {
                let obj = {};
                obj.comando = parseInt(this.selEvento);
                obj.device = "ALL"
                obj.info = "Enviando comandos";
                obj.datos =  this.selectSucursal.findIndex(val => val == "-1") >=0 ? [] : this.selectSucursal;
                window.Echo.send(JSON.stringify(obj));
            }
            
        },

        changeSucursal()
        {
            if(this.selectSucursal.findIndex(val => val == "-1") >=0  && this.selectSucursal.length>0)
            {
                alert("Si ingresa todas las sucursales, no puede ingresar más")
                this.selectSucursal = [];
                return;
            }

        }
    }
}
</script>