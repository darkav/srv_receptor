<template>
    <avsis-layout :menus=menus>
        <div data-role="panel"
            data-title-caption="Mantenimiento Sucursales"
            data-title-icon="<span class='mif-home'></span>"
            class="w-100 h-100"
        >
            <div class="card w-50">
                <div class="card-content p-2">
                    <form ref="frmMntSucursal">
                        <div class="row mb-2 d-flex flex-align-center">
                            <label class="cell-2">Nombre</label>
                            <div class="cell-10">
                                <input type="text" class="metro-input" v-model="form.nombre">
                            </div>
                        </div>
                        <div class="row mb-2 d-flex flex-align-center">
                            <label class="cell-2">Base de Datos</label>
                            <div class="cell-10">
                                <input type="text" class="metro-input" v-model="form.bd">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer d-flex flex-row flex-justify-center">
                    <button class="button primary outline m-2" @click="submit"><span class="mif-floppy-disk"></span></button>
                    <button class="button alert outline" @click="close"><span class="mif-exit"></span></button>
                </div>

            </div>
        </div>
    </avsis-layout>
</template>
<script>
    import AvsisLayout from '../../Layouts/AvsisLayout';
    export default {
        props:['sucursal','accion','menus'],
        components:{
            AvsisLayout
        },
        mounted(){
            console.log("cargando desde pagina");
            this.form = this.sucursal ;
        },
        errorCaptured: (err,vm,info) =>
        {
            console.log("error capturado",err,info);
        },
        data(){
            return{
                form:{
                    nombre:"",
                    bd:""
                }
            }
        },
        computed:{
            getData()
            {
                console.log("data refrescando", this.data);
                return this.data;
            }
        },
        methods:
        {
            submit()
            {
                console.log("entrando al submit",this.accion);
                switch(this.accion)
                 {
                        case 'N':
                            var vform = Object.assign({},this.form);
                            this.$inertia.post(route('sucursal.store'),vform, {
                                onSuccess: () => {
                                    this.$refs.frmMntSucursal.reset();
                                }
                            });
                            break;
                        case 'E':
                            var vform = Object.assign({},this.form);
                            console.log("Grabando la informacion de edicion", this.form);
                            this.$inertia.put(route('sucursal.update',vform.id),vform);
                            break;
                 }

                
            },
            close()
            {
                this.$inertia.get(route('sucursal.index'));
            }
        }

    }
</script>
