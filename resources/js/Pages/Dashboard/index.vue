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
                        <div class="cell-4">
                            <input type="checkbox" data-role="switch" data-on="ON" data-off="OFF">
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
                            <div class="shortcut mx-4 my-4 px-5"
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
                <!-- enviar comandos -->
            </div>
            <!-- -->
                    
        </template>
    </pantalla>

</template>
<script>
import Pantalla from '../../controles/pantalla'

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
            my.mensajes.push("Conectando al Live Data");
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
            console.log("enviando data", evt);
            my.mensajes.push("enviando mensaje");
        });



    },
    data(){
        return{
            titulo: "Dashboard",
            accion:"R",
            linkBack:"categoria.index",
            selServicio:"",
            sucSearch:"",
            icono:"<span class='mif-dashboard'></span>",
            mensajes:[]
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
    }
}
</script>