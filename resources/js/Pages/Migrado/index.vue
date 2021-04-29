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
                    <div class="cell-2" >
                        <select data-role="select" v-model="selCategoria">
                            <option v-for="(categoria,cix) in getCategorias" :key="cix"
                                :value="categoria.id" 
                            >
                            {{categoria.nombre}}
                            </option>
                        </select>
                    </div>
                    <div class="cell-2" :key="rfsTb">
                        <select data-role="select" v-model="selTabla">
                            <option v-for="(tb,tix) in getTablas" :key="tix"
                            :value="tb.id">{{tb.tabla}}</option>
                        </select>
                    </div>
                    <div class="cell-2">
                        <input type="text" data-role="calendarpicker" data-format="%d %B %Y" data-locale="es-MX">
                    </div>
                    <div class="cell-2">
                        <input type="text" data-role="calendarpicker" data-format="%d %B %Y">
                    </div>
                    <div class="cell-2">
                        <div class="button primary outline">Filtrar</div>
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
            rfsTb:0,
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
                    return x.id == this.selCategoria
                }) || [];

            }
            this.rfsTb++;                
            return cat.tablas;
        }
    }
}

</script>
