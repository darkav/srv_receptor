<template>
    <pantalla
        :menus="menus"
        :registro="registro"
        :accion="accion"
        linkUpdate=""
        linkStore=""
        linkBack=""
        :showBotones="false"
        :titulo="titulo"
    >
        <template v-slot:default="parent">
                    <div class="row mb-2 d-flex flex-align-center">
                        <label class="cell-2">Nombre</label>
                        <div class="cell-10">
                            <select data-role="select" v-model="selItem">
                                <option 
                                    v-for="(item,idx) in getCategorias"
                                    :key="idx"
                                :value="item.nombre">{{item.nombre}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="cell-4">
                            <div class="button primary outline w-100" @click="creaTabla">Crear</div>
                        </div>
                        <div class="cell-4">
                            <div class="button warning outline w-100" @click="borraTabla">Borrar</div>
                        </div>
                        <div class="cell-4">
                            <div class="button success outline w-100" @click="salir">Salir</div>
                        </div>
                    </div>
        </template>
    </pantalla>

</template>
<script>
import Pantalla from '../../controles/pantalla'
export default {
    props:['categoria','accion','menus'],
    components:{
        'pantalla' : Pantalla,
    },
    data(){
        return{
            selItem:undefined,
            registro:{},
            titulo: 'Generar Tablas de Categorías'
        }
    },
    computed:{
        getCategorias(){
            return this.categoria;
        }
    },
    methods:{
        creaTabla()
        {
            if(this.selItem == undefined) {
                alert("Debe de seleccionar la tabla");
                return;
            }
            this.$inertia.get(`/received/crea-tabla/${this.selItem}`);
        },
        borraTabla()
        {
            if(this.selItem == undefined) {
                alert("Debe de seleccionar la tabla");
                return;
            }

            this.$inertia.get(`/received/borra-tabla/${this.selItem}`);
        },
        salir()
        {

        }
    }
}
</script>