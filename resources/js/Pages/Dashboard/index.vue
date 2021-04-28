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
                        <div class="cell-4" :key="rfsServicio">
                            <select ref="cmbServicio"   data-role="select" data-add-empty-value="true" data-empty-value="Servicios"
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
                            <input type="checkbox" :checked="selActivo" v-model="selActivo" data-role="switch" data-on="ACT" data-off="STP">
                        </div>
                        <div class="cell-1">
                            <div class="button primary outline" @click="loadService">Actualizar</div>
                        </div>
                        <div class="cell-1 offset-5 ">
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
                                        <option value="9">Setear</option>
                                        <option value="10">Obtener</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="cell-4" :key="rfsSucursal">
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
            <aside id="sideInfo" :class="cls_sidebar" data-role="sidebar">
                <div class="sidebar-header">
                    <a href="/" class="fg-blue sub-action"
                        onclick="Metro.sidebar.close('#sideInfo'); return false;">
                        <span class="mif-arrow-left mif-2x"></span>
                    </a>
                    <span class="title">Información</span>
                </div>
                <div class="card-content" v-if="getInfo.miAccion != 8 && getInfo.miAccion != 14" :ref="rfsAside">
                    <div v-for="(info,idx) in getInfo.datos" :key="idx"
                        data-role="panel"
                        :data-title-caption="info.sucursal.nombre"
                        data-title-icon="<span class='mif-home'></span>">                        
                    >
                        <div class="row">
                            <div class="cell-4">Sucursal:</div>
                            <div class="cell-8">{{info.sucursal.alias}}</div>
                        </div>
                        <div class="row">
                            <div class="cell-4">IP:</div>
                            <div class="cell-8">{{info.sucursal.ip}}</div>
                        </div>
                        <div class="row">
                            <div class="cell-4">DB:</div>
                            <div class="cell-8">{{info.sucursal.bd}}</div>
                        </div>
                        <div class="item-separator"></div>                        
                    </div>
                </div>
                <div class="card-content scrollbox h-100" v-if="getInfo.miAccion == 8 || getInfo.miAccion == 14">
                    <div data-role="panel">
                        <div class="row"
                            v-for="(info,ifx) in getInfo.datos"
                            :key="ifx"
                        >
                            <div class="cell-12 d-flex flex-justify-end">
                                <span class="mif-cross fg-red" @click="reset(info)"></span>
                            </div>
                            <div class="cell-4 text-small">Conexión:</div>
                            <div class="cell-8 text-small"><b>{{info.conId}}</b></div>
                            <div class="cell-4 text-small">Dispositivo:</div>
                            <div class="cell-8 text-small"><b>{{info.nodo.device}}</b></div>
                            <div class="cell-4 text-small">Estado</div>
                            <div class="cell-8 text-small">{{info.nodo.estado}}</div>
                            <hr class="bg-gray w-100" style="border-style: dashed; border-color: gray; border-width: thin;" />
                        </div>
                        <div class=" row h-50 w-100"></div>
                    </div>
                </div>
            </aside>
        </template>
    </pantalla>
</template>
<script>
import Pantalla from '../../controles/pantalla';
import { format } from 'date-fns';

export default {
    props:["servicios","dato","menus"],
    components:{
        'pantalla' : Pantalla
    },

    mounted(){
        // preguntando si esta conectado el websocket
        let my = this;
        this.noticia = Metro.notify;
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

        // eventos del Worker
        console.log("worker activo", window.wrkPing);

        window.wrkPing.addEventListener('message', (e) => {
            // retornando que todo funciona
            var wrkdata = JSON.parse(e.data);
            console.log("llego la comunicacion ", wrkdata);
        });

        window.wrkPing.addEventListener('error', (e) => {
            // retornando error al llamar webworker
        });



    },
    data(){
        return{
            titulo: "Dashboard",    
            device:"",
            accion:"R",
            linkBack:"categoria.index",
            selServicio:"",
            selActivo:"",
            sucSearch:"",
            icono:"<span class='mif-dashboard'></span>",
            mensajes:[],
            cssconectado:'',
            wsServicio:'',
            selectSucursal:[],
            selEvento:"",
            rfsSucursal:0,
            rfsServicio: 0,
            rfsAside:0,
            noticia:{},
            cls_sidebar:"sidebar pos-absolute z-2",
            info:[]
        }
    },
    computed:{
        getServicios()
        {
            console.log("getServicios", this.servicios);
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
        },

        getInfo()
        {
            var midata = {};
            if(this.info== null)
            {
                midata.miAccion=0;
            }else
            {
                midata=this.info;
                if(midata.proviene)
                    midata.miAccion = midata.proviene.comando || 0;
                    if(midata.miAccion == 8 || midata.miAccion == 14)
                    {
                        midata.datos = Object.entries(midata.datos).map(([k,x]) => ({conId :k,nodo: x}));
                    }
                else
                    midata.miAccion = 0;
            }
            return midata;
        }


    },
    watch:{
        selServicio: function(newval,oldval)
        {
            var nodo = this.getServicios.filter(x => x.id == newval)[0] || {};
            this.selActivo = nodo.estado == "ACT" ? 1 : 0;
            this.$forceUpdate();
            console.log("el selactivo",nodo, this.selActivo);
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
                case 14:
                    this.reset(comando);
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

            
            this.noticia.create(mensaje.info,"Información",{
                cls:"success"
            });
            switch(mensaje.proviene.comando)
            {
                case 8: //getstatus
                    this.getStatus(mensaje);
                    break;
                case 9: //getconfig
                    this.getConfig(mensaje);
                    break;
                case 14: // reset
                    this.getStatus(mensaje);
                    break;       
                             
            }

        },
        sendError(mensaje)
        {
            this.noticia.create(mensaje.info,"Error",{
                cls:"alert"
            });

        },
        getStatus(mensaje)
        {
            this.info = mensaje;
            this.rfsAside++;
            console.log("mostrar status", mensaje);
            this.mostrarAside(mensaje);
        },
        getConfig(mensaje)
        {
            this.info = mensaje.datos;
            this.mostrarAside(mensaje);
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
        sendDirectCommando(mensaje)
        {
            if(window.Echo.readyState == 1)            
            {
                window.Echo.send(JSON.stringify(mensaje));
            }else
            {
                this.noticia.create("No hay conexión con el servicio POSFix","Error",{
                    cls:"alert"
                });
            }
        },
        sendComandos()
        {
            console.log("sende comando ",this.selServicio);
            if(this.selEvento == "Servicios")
            {
                alert("Debe de seleccionar un evento");
                return;
            }

            if(this.selectSucursal.length == 0 && this.selEvento != 8)
            {
                alert("Debe de seleccionar una o varias sucursales o todos");
                return;
            }

            if(this.selEvento == 1)
            {
                this.pingme();
                return;
            }



            if(this.selEvento == 9 && this.selServicio == "Servicios")
            {
                alert("Debe de seleccionar un Servicio");
                return;
            }


            if(window.Echo.readyState == 1)            
            {
                let obj = {};
                obj.comando = parseInt(this.selEvento);
                obj.device = "ALL"
                obj.info = "Enviando comandos";
                obj.datos =  this.selectSucursal.findIndex(val => val == "-1") >=0 ? null : this.selectSucursal;
                obj.servicio = this.getServicios.filter(x => x.id == this.selServicio)[0] || null;
                if(obj.servicio != null)
                {
                    delete obj.servicio.created_at;
                    delete obj.servicio.updated_at;
                    delete obj.servicio.icono;
                }
                window.Echo.send(JSON.stringify(obj));
            }else
            {
                this.noticia.create("No hay conexión con el servicio POSFix","Error",{
                    cls:"alert"
                });

            }
            
        },

        changeSucursal()
        {
            if(this.selectSucursal.findIndex(val => val == "-1") >=0  && this.selectSucursal.length>1)
            {
                alert("Si ingresa todas las sucursales, no puede ingresar más")
                this.selectSucursal = [];
                this.rfsSucursal++;
                this.$forceUpdate();
                return;
            }

        },
        async loadService()
        {
            console.log("servicio",this.selServicio);
            if(this.selServicio == "Servicios")
            {
                alert("Debe de seleccionar un servicio");
                return;
            }
            var srv = Object.assign({},this.getServicios.filter(x => x.id == this.selServicio)[0]);
            delete srv.created_at;
            delete srv.updated_at;
            delete srv.icono;
            srv.estado = this.selActivo == 1 ? "ACT" : "STP";
            var response = await fetch("../api/servicio/v1",{
                method: "PUT",
                headers:{
                    "Accept": 'application/json',
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(srv)
            });
            if(response.ok)
            {
                this.noticia.create("Actualizado el estado del servicio","Correcto",{
                    cls:"success"
                });

                let pos = this.dato.servicios.findIndex(x => x.id==srv.id);
                this.dato.servicios.splice(pos,1,srv);
                this.$forceUpdate();
                this.rfsServicio++;
            }else
            {
                this.noticia.create("Erro al actualizar el estado del servicio","Error",{
                    cls:"alert"
                });
            }

        },
        mostrarAside(data)
        {
            var side = document.getElementById("sideInfo");
            Metro.sidebar.open(side);
            //this.cls_sidebar = "sidebar pos-absolute z-2 on-right sidebar-shadow open";
        },
        reset(comando)
        {
            console.log("aplicando restet",comando);
            comando.comando=14;
            this.sendDirectCommando(comando);
        },
        pingme()
        {
            var sucursales = [];
            if(this.selectSucursal.length > 0 )
            {
                this.selectSucursal.map((x) => {
                    if(x != -1)
                        sucursales.push(this.dato.sucursales.find(y => x.id == y.id));
                    else
                        sucursales = Object.assign([], this.dato.sucursales);
                });
            }else
            {
                sucursales = this.dato.sucursales;
            }
            
            window.wrkPing.postMessage(JSON.stringify(sucursales));

        }
    }
}
</script>