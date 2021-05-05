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
                    <div class="cell-12">
                        <table class="table" id="gridDoc"
                            data-role="table"
                            data-rows="50"
                            data-rows-steps="50,100,500,1000"
                            data-show-activity="false"
                            data-table-search-title="Buscar"
                            data-table-rows-count-title="Registros"
                            data-horizontal-scroll="true"
                            data-table-info-title="Mostrando $1 a $2 de $3 registros"
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
    data(){
        return{
            titulo: "Datos Migrado",    
            device:"",
            accion:"R",
            linkBack:"categoria.index",
            icono:"<span class='mif-database'></span>",
            selCategoria:"",
            selTabla:null,
            filtro:{
                categoria:"",
                tabla:"",
                fecini:null,
                fecfin:null
            },
            rfsTb:0,
            rfsGrid:0,
            datatable:{}
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
            return this.datatable.data || [];
        },
    },
    methods:{
        async filtrar()
        {
            var vfecini = $("#fechaini").data("calendarpicker");
            var vfecfin = $("#fechafin").data("calendarpicker");
            this.filtro.fecini = format(vfecini.val().date,"yyyy-MM-dd");
            this.filtro.fecfin = format(vfecfin.val().date,"yyyy-MM-dd");
            this.filtro.pagineo = $("#gridDoc").data("rows");
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
        }

    }
}

</script>
