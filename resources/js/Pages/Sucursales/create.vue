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
                        <label class="cell-2">Base de Datos</label>
                        <div class="cell-10">
                            <input type="text" v-model="parent.form.bd" class="metro-input" >
                        </div>
                    </div>

                    <div class="row mb-2 d-flex flex-align-center">
                        <label class="cell-2">IP</label>
                        <div class="cell-10">
                            <input type="text" v-model="parent.form.ip" class="metro-input" >
                        </div>
                    </div>


                    <div class="row mb-2 d-flex flex-align-center">
                        <label class="cell-2">Usuario</label>
                        <div class="cell-10">
                            <input type="text" v-model="parent.form.usuario" class="metro-input" maxlength="15" >
                        </div>
                    </div>


                    <div class="row mb-2 d-flex flex-align-center">
                        <label class="cell-2">Clave</label>
                        <div class="cell-10">
                            <input type="password" v-model="parent.form.clave" class="metro-input" maxlength="15">
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
                titulo:"Sucursales",
                linkStore:"sucursal.store",
                linkUpdate:"sucursal.update",
                linkBack:"sucursal.index"
            }
        },
        methods:
        {

        }

    }
</script>
