
require('./bootstrap');
window.Vue = require('vue');



Vue.prototype.$eventBus = new Vue();

Vue.component('comments', require('./components/Comments.vue'));
Vue.component('add-comment', require('./components/Create.vue'));
Vue.component('like-dislike', require('./components/LikeDislike/LikeDislike.vue'));

Vue.component('message-list',require('./components/chat/message-list.vue'));
Vue.component('message-composer',require('./components/chat/message-composer.vue'));
Vue.component('online-user',require('./components/chat/online-user.vue'));

const app = new Vue({
    el: '#app',
    data(){
        "use strict";
        return{
            onlineUsers:[]
        }
    },
    created(){
        "use strict";
        Echo.join('online')
       .here(users=>{
           this.onlineUsers = users;
        }).joining(user=>{
          this.onlineUsers.push(user);
        }).leaving(user=>{
            this.onlineUsers.filter(function(map){
               return  map !=user;
            });
        });
    }
});
