<template>
    <pantalla
        ref="pantalla"
        :menus="menus"
        :registro="{}"
        :accion="accion"
        :linkBack="linkBack"
        :titulo="titulo"
        :linkStoreShow="false"
        :icono="icono"
        sizeclase="card w-100"
    >
        <template v-slot:reporte>
            <div class="h-100 w-100">
                <div class="row">
                    <div class="cell-3" >
                        <select data-role="select" v-model="filtro.categoria">
                            <option v-for="(categoria,cix) in getCategorias" :key="cix"
                                :value="categoria.id" 
                            >
                            {{categoria.nombre}}
                            </option>
                        </select>
                    </div>
                    <div class="cell-3" :key="rfsTb">
                        <select data-role="select" v-model="filtro.tabla">
                            <option v-for="(tb,tix) in getTablas" :key="tix"
                            :value="tb.id">{{tb.tabla}}</option>
                        </select>
                    </div>
                    <div class="cell-2">
                        <input id="fechaini"  data-role="calendarpicker" data-format="%d %B %Y" data-locale="es-MX"
                            data-input-format="%Y-%m-%d" 
                        >
                    </div>
                    <div class="cell-2">
                        <input id="fechafin"  data-role="calendarpicker" data-format="%d %B %Y" data-locale="es-MX">
                    </div>
                    <div class="cell-2">
                        <div class="button primary outline" @click="filtrar">Filtrar</div>
                    </div>
                </div>
                <div class="row">
                    <div class="cell-6">
                        <input v-model="searched" type="text" data-role="input" data-prepend="Buscar">
                    </div>
                    <div class="cell-1">
                            <div class="button outline primary w-100">
                                <span class="mif-table"></span>
                            </div>
                    </div>
                    <div class="cell-3 offset-2">
                        <select data-role="select" v-model="filtro.pagineo" data-prepend="Registros:">
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="cell-12">
                        <table class="table" id="gridDoc"
                            data-role="table"
                            data-rows="50"
                            data-rows-steps="50,100,500,1000"
                            data-show-activity="false"
                            data-table-search-title="Buscar"
                            data-table-rows-count-title="Registros"
                            data-horizontal-scroll="true"
                            data-show-search="false"
                            data-show-pagination="false"
                            data-show-rows-steps="false"	
                            data-show-table-info="false"	
                        >
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Local</th>
                                    <th>Tabla</th>
                                    <th>IdKey</th>
                                    <th>Fecha Insercion</th>
                                    <th>Fecha Actualizacion</th>
                                    <th>Registro</th>
                                </tr>
                            </thead>                            
                            <tbody :key="rfsGrid">
                                <tr
                                    v-for="(registro,rix) in getRegistros" :key="rix"
                                >
                                    <td>{{registro.id}}</td>
                                    <td>{{registro.local}}</td>
                                    <td>{{registro.tabla}}</td>
                                    <td>{{registro.idkey}}</td>
                                    <td>{{registro.fecha_insercion}}</td>
                                    <td>{{registro.fecha_actualizacion}}</td>
                                    <td>
                                        <div class="button outline primary">
                                            <span class="mif-eye"></span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="wndinfo" class="p-2"
                data-role="window"
                data-resizable="true"
                data-draggable="true"
                data-width="452"
                data-height="300"
                data-shadow="true"
                data-title="Información del registro"
            >
                    <JsonEditor
                        :options="opcion"
                        :objData="get"
                    >

                    </JsonEditor>
            </div>
        </template>
    </pantalla>    
</template>
<script>
import Pantalla from '../../controles/pantalla';
import { format } from 'date-fns';

export default{
    props:["categorias","dataset","menus"],
    components:{
        'pantalla' : Pantalla
    },
    mounted(){

    },
    data(){
        return{
            titulo: "Datos Migrado",    
            device:"",
            accion:"R",
            linkBack:"categoria.index",
            icono:"<span class='mif-database'></span>",
            selCategoria:"",
            selTabla:null,
            searched:"",
            filtro:{
                categoria:"",
                tabla:"",
                fecini:null,
                fecfin:null,
                pagineo:0
            },
            rfsTb:0,
            rfsGrid:0,
            datatable:{},
            opcion:{
                confirmText: "Confirmar",
                cancelText: "Cancelar"
            },
            regIndex:null
        }
    },
    computed:{
        getCategorias()
        {
            console.log("categorias", this.categorias);
            return this.categorias;
        },
        getTablas()
        {
            var cat = {};
            if(this.selCategoria != null)
            {
                cat = this.getCategorias.find((x) => {
                    console.log("categoria id",x)
                    return x.id == this.filtro.categoria
                }) || [];

            }
            this.rfsTb++;                
            return cat.tablas;
        },
        getRegistros()
        {

            return (this.datatable.data || []).filter( (x) => {
                return  JSON.stringify(x).toLowerCase().includes(this.searched.toLowerCase());
            }) || [];
        },
        getRegActual()
        {
            return this.regIndex || {};
        }
    },
    methods:{
        async filtrar()
        {
            var vfecini = $("#fechaini").data("calendarpicker");
            var vfecfin = $("#fechafin").data("calendarpicker");
            this.filtro.fecini = format(vfecini.val().date,"yyyy-MM-dd");
            this.filtro.fecfin = format(vfecfin.val().date,"yyyy-MM-dd");
            var response = await fetch('../api/migracion/v1/filtro',{
                method: "POST",
                headers:{
                    "Accept": 'application/json',
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(this.filtro)
            });
            var listado = await response.json();
            this.datatable = listado;
            this.rfsGrid++;

        },
        changeFecIni(val,fecha,el)
        {
            console.log("fecha cambio",val,fecha,el);
        },
        verInfo(item)
        {
            this.regIndex = item;
        }

    }
}

</script>
