<template>
    <div class="if-pull-right">
        <span class="fa fa-circle green" v-if="checkUser()"> </span>
        <span class="fa fa-circle red" v-else></span>
    </div>
</template>
<script>
    export default {
        name:'online-user',
        props:['onlineusers','friend'],
        methods:{
            checkUser(){
                return _.find(this.onlineusers,{id:this.friend});
            }
        }
    }
</script>
<style>
    .green{
        color:green;
    }
    .red{
        color:red;
    }
</style>