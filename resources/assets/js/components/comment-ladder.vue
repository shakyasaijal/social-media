<template>
     <div id="root">
            <li>
                <div class="media text-muted pt-3">
                    <img :src="comment.userAvatar" :alt="comment.user.name" class="mr-2 rounded" width="32" height="32">
                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <strong class="d-block text-gray-dark">{{ comment.user.name }} @ {{ comment.created_at }}</strong>
                        {{ comment.comment }}  &nbsp; <a href="" @click.prevent="showReply"> Reply</a>
                        <input @keyup.enter.prevent="saveReply" v-if="comment.reply_box" type="text" v-model="reply"/>
                    </div>

                </div>
                <ul v-if="comment.children && comment.children.length">
                    <node v-for="(comment,key) in comment.children" :blog_id="blog_id" :comment="comment" :key="key"> </node>
                </ul>
            </li>
     </div>
</template>

<script>
    import createReply from './Create.vue';
     export default {
         name:'node',
         props:['comment','blog_id'],
         data(){
             return{
                 reply:''
             }
         },
         methods:{
             showReply(){
                 if(this.comment.reply_box){
                    this.comment.reply_box = false;
                 }else{
                     this.comment.reply_box = true;
                 }
             },
             saveReply(){
                axios.post('/api/comment/store',{
                    parent_id:this.comment.id,
                    blog_id:this.blog_id,
                    comment:this.reply
                }).then(response=>{
                    this.reply = "";
                    this.comment.children.push(response.data.data);
                }).catch(err=>{
                    //
                })
             }
         },

     }
</script>

<style scoped>
    ul{
        list-style-type: none;
    }
</style>