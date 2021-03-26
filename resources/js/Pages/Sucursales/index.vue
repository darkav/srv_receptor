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
    />

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
            titulo: "Sucursales",
            linkCreate: "sucursal.create",
            linkEdit: "sucursal.edit",
            linkDelete: "sucursal.destroy",
            accion: "B",
            icono: "<span class='mif-home'></span>",
            header:[
                {label: "Id", campo: "id"},
                {label: "Nombre", campo: "nombre"},
                {label: "BD", campo: "bd"},
                {label: "Creado", campo: "created_at"},
                {label: "Actualizado", campo: "updated_at"}
            ]
        }
    }
}

</script>
