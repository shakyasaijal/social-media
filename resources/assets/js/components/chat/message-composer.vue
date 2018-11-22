<script>
    var user_id = $('meta[name="user_id"]').attr('content');
    var friend_id = $('meta[name="friend_id"]').attr('content');
    export default {
        name:'message-composer',
        data(){
            return{
                message:'',
                typing:false,
                typingMessage:''
            }
        },
        created(){
          var this_ = this;
            //'chat.'+ friend_id +'.'+ user_id
          Echo.join('online').listenForWhisper('typing',(e)=>{
              this_.typing = e.typing;
              this_.typingMessage = e.text;
              
          });
        },
        methods:{
            sentMessage(){
                if(this.message){
                    //call axios post methods
                    //push data to the message array
                    var data = {
                        user_id:user_id,
                        friend_id:friend_id,
                        message:this.message
                    };
                    

                }
            },
            isTyping:_.debounce(
              function(){
                  var this_ = this;
                  var channel = Echo.join('online');
                  channel.whisper('typing',{
                      typing:true,
                      text:this_.message
                  });
              },200)
        }
    }
</script>
<template>
    <div class="type_msg">
        <div class="input_msg_write">
            <span v-if="typing">Typing...</span>
            <input type="text" class="write_msg" @keydown="isTyping" v-model="message" placeholder="Type a message" @keyup.enter.prevent="sentMessage" />
            <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true" @click.prevent="sentMessage"></i></button>
        </div>
    </div>
</template>