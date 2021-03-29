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
                        <label class="cell-2">Cod. Categoria</label>
                        <div class="cell-10">
                            <input type="text" v-model="parent.form.categoria" class="metro-input" 
                                :data-prepend="parent.form.categoria_id"
                            >
                        </div>
                    </div>
                    <div data-role="panel" class="w-100"
                        data-title-caption="Tablas"
                        data-custom-buttons="customBotones"
                    >

                    </div>
                    
        </template>
    </pantalla>

</template>
<script>
export default {
    props:["registro","tablas","accion","menus"],
    data(){
        return{
            titulo: "Tablas x Categoría",
            customBotones:[
                {
                    html: "<span class='mif-rocket'></span>",
                    cls: "sys-button",
                    onclick: "alert('chupalo')"
                },
                {
                    html: "<span class='mif-cog'></span>",
                    cls: "warning",
                    onclick: "alert('chupalo con furia')"
                },
            ]
        }
    }
}
</script>