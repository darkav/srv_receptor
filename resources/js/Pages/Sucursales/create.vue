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
        props:['menus'],
        components:{
            AvsisLayout
        },
        mounted(){
            console.log("cargando desde pagina");
        },
        errorCaptured: (err,vm,info) =>
        {
            console.log("error capturado",err,info);
        },
        data(){
            return{
                accion:'',
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
                        
                this.$inertia.post(route('sucursal.store'),this.form, {
                    onSuccess: () => {
                        this.$refs.frmMntSucursal.reset();
                    }
                });
                
            },
            close()
            {
                this.$inertia.get(route('sucursal.index'));
            }
        }

    }
</script>
