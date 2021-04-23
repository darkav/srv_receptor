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
                        <label class="cell-2">Tiempo Real Data</label>
                        <div class="cell-10">
                            <input type="checkbox" data-role="checkbox" v-model="parent.form.live" :checked="parent.form.live == 1 ? true : false" />
                        </div>
                    </div>

                    <div class="row mb-2 d-flex flex-align-center">
                        <label class="cell-2">Servicio</label>
                        <div class="cell-10">
                            <input type="radio" v-model="parent.form.push_event" value=1 data-role="radio" data-caption="Solo Eventos" @change="setEventos(1)">
                            <input type="radio" v-model="parent.form.push_event" value=2 data-role="radio" data-caption="Eventos y Pull"  @change="setEventos(2)">
                            <input type="radio" v-model="parent.form.push_event" value=3 data-role="radio" data-caption="Solo Pull"  @change="setEventos(3)">
                        </div>
                    </div>


                    <div class="row mb-2 d-flex flex-align-center" v-if="parent.form.push_event != 1">
                        <label class="cell-2">Tiempo Rastreo (Min.)</label>
                        <div class="cell-10">
                            <input type="number" v-model="parent.form.tiempo_rastreo" class="metro-input" >
                        </div>
                    </div>


                    <div class="row mb-2 d-flex flex-align-center" v-if="parent.form.push_event != 1">
                        <label class="cell-2">Tiempo Espera Rastreo (Min.) </label>
                        <div class="cell-10">
                            <input type="number" v-model="parent.form.timeout_rastreo" class="metro-input" maxlength="5" >
                        </div>
                    </div>

                    <div class="row mb-2 d-flex flex-align-center">
                        <label class="cell-2">Tiempo Ping (seg.)</label>
                        <div class="cell-10">
                            <input type="number" v-model="parent.form.tiempo_ping" class="metro-input" maxlength="5">
                        </div>
                    </div>

                    <div class="row mb-2 d-flex flex-align-center">
                        <label class="cell-2">Tiempo Espera Ping (seg.)</label>
                        <div class="cell-10">
                            <input type="number" v-model="parent.form.timeout_ping" class="metro-input" maxlength="5">
                        </div>
                    </div>

                    <div class="row mb-2 d-flex flex-align-center">
                        <label class="cell-2">Enviar Correo</label>
                        <div class="cell-10">
                            <input type="checkbox" data-role="checkbox" v-model="parent.form.enviar_correo" :checked="parent.form.enviar_correo == 1 ? true : false" />
                        </div>
                    </div>

                    <div class="row mb-2 d-flex flex-align-center" v-if="parent.form.enviar_correo == true">
                        <label class="cell-2">Correos</label>
                        <div class="cell-10">
                            <input type="email" v-model="parent.form.correo" class="metro-input" maxlength="255">
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
                titulo:"Servicio",
                linkStore:"servicio.store",
                linkUpdate:"servicio.update",
                linkBack:"servicio.index"
            }
        },
        methods:
        {
            setEventos(valor)
            {
                if(valor == 1)
                {

                }
            }   
        }

    }
</script>
