<template>
    <pantalla
        :menus="menus"
        :registro="registro"
        :accion="accion"
        :linkUpdate="linkUpdate"
        :linkStore="linkStore"
        :linkBack="linkBack"
        :titulo="titulo"
    >
        <template v-slot:default="parent">
                    <div class="row mb-2 d-flex flex-align-center">
                        <label class="cell-2">Nombre</label>
                        <div class="cell-10">
                            <input type="text" v-model="parent.form.nombre" class="metro-input" >
                        </div>
                    </div>
                    <div class="row mb-2 d-flex flex-align-center">
                        <label class="cell-2">Abreviatura</label>
                        <div class="cell-10">
                            <input type="text" v-model="parent.form.abreviatura" class="metro-input" >
                        </div>
                    </div>
        </template>
    </pantalla>

</template>
<script>
    import Pantalla from '../../controles/pantalla'

    export default {
        props:['registro','accion','menus'],
        components:{
            'pantalla' : Pantalla,
        },
        errorCaptured: (err,vm,info) =>
        {
            console.log("error capturado",err,info);
        },
        data(){
            return{
                titulo:"Categorias",
                linkStore:"categoria.store",
                linkUpdate:"categoria.update",
                linkBack:"categoria.index"
            }
        },
        methods:
        {

        }

    }
</script>
