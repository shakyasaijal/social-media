<template>
    <div id="comment-root">
        <ul class="list-view">
           <node v-for="(comment,key) in comments" :comment="comment" :blog_id="blog_id" :key="key"></node>
        </ul>
    </div>
</template>
<script>
    import {EventBus} from '../event-bus';
    import axios from 'axios';
    import treeView from './comment-ladder.vue';
    export default {
        props:{
           blog_id:{
               required:true,
               type:Number
           }
        },
        components:{
            'node':treeView
        },
        data() {
            return {
                comments: [],
            }
        },
        created() {
            axios.get('/api/comments/'+this.blog_id).then(res => {
                this.comments = res.data.data;
            }).catch(err => {
                //catch the err
            });
            EventBus.$on('comment-added', playload => {
                this.comments.push(playload)
            });
        },
    }
</script>
<style scoped>
.list-view{
    padding-left: 16px;
    margin: 6px 0;
    list-style-type: none;
}
</style>