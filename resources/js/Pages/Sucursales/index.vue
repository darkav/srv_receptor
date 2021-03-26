<template>
    <avsis-layout :menus=menus>
        <div data-role="panel"
            data-title-caption="Sucursales"
            data-title-icon="<span class='mif-home'></span>"
            class="w-100 h-100"
        >
            <div class="scrollbox">
                <div class="grid">
                    <div class="row w-100">
                        <div class="cell-6">
                            <input type="text" class="metro-input"
                                data-role="input"
                                data-search-button="true"
                                data-on-search-button-click="searchData"
                            >
                        </div>

                        <div class="cell-6 d-flex flex-row-r">
                            <div class="toolbar">
                                <button class="tool-button primary outline" @click="$inertia.reload({only: ['data']})"><span class="mif-refresh icon"></span></button>
                                <button class="tool-button primary outline" @click="showForm('N')"><span class="mif-file-empty icon"></span></button>
                                <button class="tool-button primary outline"><span class="mif-exit icon"></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100">
                        <div class="cell-12">
                            <table class="mitabla table subcompact row-hover striped table-border  mt-4"
                            >
                                <thead>
                                    <tr>
                                        <th class="sortable-column sort-asc">Id</th>
                                        <th>Nombre</th>
                                        <th>BD</th>
                                        <th>Creado</th>
                                        <th>Actualizado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <!-- style="height: 150px !important;" -->
                                <tbody>
                                    <tr 
                                        v-for="(fila,fix) in getData"
                                        :key="fix"

                                        
                                    >
                                        <td>{{fila.id}}</td>
                                        <td>{{fila.nombre}}</td>
                                        <td>{{fila.bd}}</td>
                                        <td>{{fila.created_at}}</td>
                                        <td>{{fila.updated_at}}</td>
                                        <td>
                                            <div class="toolbar" style="height: 36px;">
                                                <div class="tool-button secondary outline" @click="editForm(fila)"><span class="mif-pencil "></span></div>
                                                <button class="tool-button alert outline" @click="deleteForm(fila)"><span class="mif-cross"></span></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </avsis-layout>
</template>
<script>
    import AvsisLayout from '../../Layouts/AvsisLayout';
    export default {
        props:['data','menus'],
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
            showForm(accion){
                this.accion=accion;
                this.$inertia.get(route('sucursal.create'));
            },
            editForm(registro){
                this.$inertia.get(route('sucursal.edit',registro.id));
            },
            deleteForm(registro)
            {
                if(!confirm("Estas seguro que desea eliminar este registro")) return;
                this.$inertia.delete(`/sucursal/${registro.id}`);
            }
        }

    }
</script>
