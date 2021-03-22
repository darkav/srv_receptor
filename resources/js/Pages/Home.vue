<template>
    <avsis-layout :menus="menus">
        <span>funciona mierda</span>
    </avsis-layout>
</template>
<script>
import AvsisLayout from '../Layouts/AvsisLayout'
export default {
    components:{
        AvsisLayout
    },
    props:{
        menus: Array
    },
    data(){
        return{

        }
    }
}
</script>
