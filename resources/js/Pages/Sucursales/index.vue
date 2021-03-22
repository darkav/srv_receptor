<template>
    <avsis-layout :menus=menus>
        <div data-role="panel"
            data-title-caption="Sucursales"
            data-title-icon="<span class='mif-home'></span>"
            class="w-100 h-100"
        >
            <div class="grid">
                <div class="row w-100">
                    <div class="cell-12 d-flex flex-row-r">
                        <div class="toolbar">
                            <button class="tool-button primary outline" @click="showForm('N')"><span class="mif-file-empty icon"></span></button>
                            <button class="tool-button primary outline"><span class="mif-exit icon"></span></button>
                        </div>
                    </div>
                </div>
                <div class="row w-100">
                    <div class="cell-12">
                        <table class="table striped table-border mt-4"
                            data-role="table"
                            data-table-search-title="Buscar"
                            data-table-rows-count-title="#Registros"
                            data-rows-steps="10,50,100,1000,5000"
                            data-table-info-title = "Mostrando $1 a $2 de $3 registros"
                            data-horizontal-scroll = "true"
                        >
                            <thead>
                                <tr>
                                    <th data-sortable="true" data-sort-dir="asc">Id</th>
                                    <th data-sortable="true" data-sort-dir="asc">Nombre</th>
                                    <th data-sortable="true" data-sort-dir="asc">BD</th>
                                    <th data-sortable="true" data-sort-dir="asc">Creado</th>
                                    <th data-sortable="true" data-sort-dir="asc">Actualizado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(fila,fix) in data"
                                    :key="fix"
                                >
                                    <td>{{fila.id}}</td>
                                    <td>{{fila.nombre}}</td>
                                    <td>{{fila.bd}}</td>
                                    <td>{{fila.created_at}}</td>
                                    <td>{{fila.updated_at}}</td>
                                    <td>
                                        <div class="toolbar">
                                            <button class="tool-button secondary outline"><span class="mif-pencil "></span></button>
                                            <button class="tool-button alert outline"><span class="mif-cross"></span></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="dialog" data-role="dialog" ref="frmsucursal" id="frmSucursal">
            <div class="dialog-title">Mantenimiento Sucursal</div>
            <div class="dialog-content">
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
            <div class="dialog-actions">
                <button class="button primary outline" @click="submit"><span class="mif-floppy-disk"></span></button>
                <button class="button alert outline js-dialog-close"><span class="mif-exit"></span></button>
            </div>
        </div>
    </avsis-layout>
</template>
<script>
    import AvsisLayout from '../../Layouts/AvsisLayout';
    export default {
        props:['data','menus','errors'],
        components:{
            AvsisLayout
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
        methods:
        {
            showForm(accion){
                this.accion=accion;
                Metro.dialog.open("#frmSucursal");
            },
            submit()
            {
                switch(this.accion)
                {
                    case "N":
                        this.$inertia.post('sucursal',this.form,{
                            onSuccess: () => {
                                console.log("funcionando la informacion");
                            },
                            onError: (errors) => {
                                console.log("se cayo esta huevada",errors);
                            }
                        });
                        break;
                    case "E":
                        break;
                }
                this.$refs.frmMntSucursal.reset();
            }
        }

    }
</script>