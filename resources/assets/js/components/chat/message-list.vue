<script>
    var friend_id = $('meta[name="friend_id"]').attr('content');
    var user_id =  $('meta[name="user_id"]').attr('content');
    export default {
        name:'message-list',
        data(){
            return{
                messages:[],
                friend:{},
                user:{},
                typing:''
            }
        },
        created(){
             var this_ = this;
             this_.fetchAuthenticateUserDetails();
             this_.fetchFriendDetails();
             this_.$eventBus.$on('message',function(playload){
                this_.messages.push(playload);
             });

             if(friend_id !='undefined'){
                 axios.get('/api/fetch-messages/'+friend_id).then(response=>{
                     this_.messages = response.data.messages;
                 }).catch(error=>{
                     console.log(error);
                 });
                 Echo.private('chat.'+ friend_id +'.'+ user_id)
                     .listen('BroadcastMessages',(e)=>{
                       this_.messages.push(e.message);
               });
             }
        },
        methods:{
            fetchFriendDetails(){
                axios.get(`/api/selected-friend/${friend_id}`).then(response=>{
                    this.friend = response.data.friend;
                }).catch(error=>{
                    //handle error
                })
            },
            fetchAuthenticateUserDetails(){
              axios.get('/api/user-details').then(response=>{
                this.user = response.data.user;
              }).catch(error=>{
                  //handle error
              })
            }
        }
    }
</script>


<template>
    <div class="msg_history" v-if="messages.length>0">
        <p> {{ typing }} </p>

        <div v-for="(message,key) in messages" :key="key">
            <div class="incoming_msg" v-if="message.friend_id != friend.id">
                <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="received_msg">
                    <div class="received_withd_msg">
                        <p>{{ message.message }}</p>
                        <span class="time_date"> {{ message.created_at }} </span></div>
                </div>
            </div>
            <div class="outgoing_msg" v-else>
                <div class="outgoing_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="sent_msg">

                    <p>{{ message.message }}</p>
                    <span class="time_date"> {{ message.created_at }}</span> </div>
            </div>

        </div>

    </div>
</template>

<style scoped>
    .outgoing_msg_img{
        display: inline-block;
        width: 6%;
        float: right;
        margin-left:5px;
    }
</style>