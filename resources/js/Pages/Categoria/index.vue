<template>
    <pantalla 
        :data="data"
        :menus="menus"
        :header="header"
        :linkCreate="linkCreate"
        :linkEdit="linkEdit"
        :linkDelete="linkDelete"
        :accion="accion"
        :titulo="titulo"
        :icono="icono"
    >
        <template v-slot:extra-comando="{ fila }">
            <div class="tool-button secondary outline" @click="callTablasCat(fila)"><span class="mif-table "></span></div>
        </template>
    </pantalla>

</template>
<script>
import Pantalla from '../../controles/pantalla'

export default{
    props:['data', 'menu'],
    components:{
        'pantalla': Pantalla
    },
    
    data(){
        return{
            titulo: "Categorías",
            linkCreate: "categoria.create",
            linkEdit: "categoria.edit",
            linkDelete: "categoria.destroy",
            accion: "B",
            icono: "<span class='mif-cabinet'></span>",
            header:[
                {label: "Id", campo: "id"},
                {label: "Nombre", campo: "nombre"},
                {label: "Abreviatura", campo: "abreviatura"},
                {label: "Creado", campo: "created_at"},
                {label: "Actualizado", campo: "updated_at"}
            ]
        }
    },
    methods:{
        callTablasCat(fila)
        {
            this.$inertia.get(`/categoria/edit_tabla/${fila.id}`,);
        }
    }
}

</script>
