<template>
    <div data-role="navview" class="pagina">
        <div class="navview-pane">
            <button class="pull-button">
                <span class="default-icon-menu"></span>
            </button>
            <div class="suggest-box">
                <input type="text" data-role="input" data-clear-button="false" data-search-button="true">
                <button class="holder">
                    <span class="mif-search"></span>
                </button>
            </div>
            <ul class="navview-menu">
                <li class="item-header"><b>SRV</b>Receptor</li>
                <li class="item-separator"></li>
                <template v-for="(menu,mix) in menus" :key="mix">
                    <li class="item-header" >{{menu.modulo}}</li>
                    <template v-for="(programa,pix) in menu.programas" :key="pix">
                        <li>
                            <a :href="programa.link">
                                <span class="icon"><span :class="programa.icono"></span></span>
                                <span class="caption">{{programa.programa}}</span>
                            </a>
                        </li>
                    </template>
                    <li class="item-separator"></li>
                </template>
            </ul>
        </div>
        <div class="navview-content d-flex flex-align-center flex-justify-center h-100">
            <slot/>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        menus: Array
    },
    mounted(){
        
    },
    data(){
        return{

        }
    }
}
</script>
<style>
    .pagina{
        height: 100vh;
    }
</style>