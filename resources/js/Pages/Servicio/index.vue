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
            titulo: "Servicio",
            linkCreate: "servicio.create",
            linkEdit: "servicio.edit",
            linkDelete: "servicio.destroy",
            accion: "B",
            icono: "<span class='mif-power'></span>",
            header:[
                {label: "Id", campo: "id"},
                {label: "Nombre", campo: "nombre"},
                {label: "Live", campo: "live"},
                {label: "Enviar Eventos", campo: "push_event"},
                {label: "T. Rastreo (Min.)", campo: "tiempo_rastreo"},
                {label: "T. Espera Rastreo (Min.)", campo: "timeout_rastreo"},
                {label: "T. Ping (seg.)", campo: "tiempo_ping"},
                {label: "T. Espera Ping (seg.)", campo: "timeout_ping"},
                {label: "Enviar Correo", campo: "enviar_correo"},
                {label: "Correos", campo: "correo"},
                {label: "Estado", campo: "estado"}
            ]
        }
    }
}

</script>
