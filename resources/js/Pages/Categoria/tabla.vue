<template>
    <pantalla
        ref="pantalla"
        :menus="menus"
        :registro="getRegistro"
        :accion="accion"
        :linkUpdate="linkUpdate"
        :linkStore="linkStore"
        :linkBack="linkBack"
        :titulo="titulo"
        :linkStoreShow="false"
    >
        <template v-slot:default="parent">
                    <div class="row mb-2 d-flex flex-align-center">
                        <label class="cell-2">Categoria</label>
                        <div class="cell-10">
                            <input type="text" v-model="parent.form.categoria" class="metro-input" 
                                data-role="input" :data-prepend="parent.form.categoria_id"
                            >
                        </div>
                    </div>
                    <div data-role="panel" class="w-100"
                        data-title-caption="Tablas"
                        :data-custom-buttons="getBotones"
                    >
                        <div class="card">
                            <div class="card-content p-2">
                                <div class="row">
                                    <div class="cell-12">
                                        <input type="text" placeholder="Tabla" data-role="input" v-model="v_tabla" class="metro-input">
                                    </div>
                                    <div class="cell-12">
                                        <input type="text" placeholder="Key" data-role="input" v-model="v_key" class="metro-input">
                                    </div>

                                    <div class="cell-12">
                                        <input type="text" placeholder="Campos Excluidos" data-role="input" v-model="v_except" class="metro-input">
                                    </div>


                                    <div class="cell-12 d-flex flex-justify-center">
                                        <div class="button outline primary" @click="addTabla">
                                            <span>Guardar</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="cell-12">
                                        <table class="table table-border row-border" :key="tbcount">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tabla</th>
                                                    <th>Key</th>
                                                    <th>Excluidos</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(fil,fix) in parent.form.tabla" :key="fix">
                                                    <td>{{fil.id}}</td>
                                                    <td>{{fil.tabla}}</td>
                                                    <td>{{fil.idkey}}</td>
                                                    <td>{{fil.excepto}}</td>
                                                    <td class="d-flex flex-justify-center"><span class="mif-cross fg-red" @click="delTabla(fil)"></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
        </template>
    </pantalla>

</template>
<script>
import Pantalla from '../../controles/pantalla'
export default {
    props:["registro","accion","menus"],
    components:{
        'pantalla' : Pantalla
    },
    mounted(){
        var my = this;
        window.cleanInput = function()
        {
            my.cleanInput();
        };

        window.w_refresh = function()
        {
            my.refresh();
        }
    },
    data(){
        return{
            titulo: "Tablas x Categoría",
            v_tabla: "",
            v_key:"",
            v_except:"",
            tbcount:0,
            linkBack:"categoria.index",
            customBotones:[
                {
                    html: "<span class='mif-refresh'></span>",
                    cls: "warning",
                    onclick: "w_refresh()"
                },
                {
                    html: "<span class='mif-add'></span>",
                    cls: "primary",
                    onclick: "cleanInput"
                },

            ]
        }
    },
    computed:{
        getBotones()
        {
            return JSON.stringify(this.customBotones);
        },
        getRegistro()
        {
            console.log("en el registro ok", this.registro);
            return this.registro;
        }
    },
    methods:{
        cleanInput()
        {
            this.v_tabla="";
            this.v_key="";

        },
        refresh()
        {
            this.$inertia.reload({only: ['registro']});
            this.$refs.pantalla.setForm(this.registro);
            this.tbcount++;
        },
        addTabla()
        {
            var dtabla = {};
            dtabla.categoria_id = this.$refs.pantalla.form.categoria_id;
            dtabla.tabla = this.v_tabla;
            dtabla.idkey = this.v_key;
            dtabla.excepto = this.v_except;
            console.log("antes de enviar la dtabla", dtabla);
            this.$inertia.post(route("categoriatabla.store"),dtabla,{
                onSuccess: () => {
                    this.cleanInput();
                    this.refresh();
                }
            });
            // debe de guardar la informacion o refrescar

        },
        delTabla(fila)
        {
            if(!confirm("Estas seguro que desea eliminar este registro")) return;
            console.log("eliminando registro", fila);
            this.$inertia.delete(route("categoriatabla.destroy",fila.id),{
                onSuccess: () => {
                        this.refresh();
                }
            });
            
        }
    }
}
</script>