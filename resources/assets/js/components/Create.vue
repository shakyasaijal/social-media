<template>
    <div class="media text-muted pt-3">
        <input type="text" placeholder="Write something here..." @keyup.enter="addComment" v-model="comment.text" class="form-control"/>
    </div>
</template>
<script>
    import {EventBus} from '../event-bus.js';
    import axios from 'axios';
    export default {
        props: {
            blog_id: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                comment: {
                    text: ''
                }
            }
        },
        methods: {
            addComment() {
                if (this.comment.text) {
                    axios.post('/api/comment/store', {
                        comment: this.comment.text,
                        blog_id: this.blog_id
                    }).then(response => {
                        EventBus.$emit('comment-added', response.data.data);
                    }).catch(error => {
                        console.log(error);
                    });
                    this.comment = {
                        text: ''
                    }
                }
            }
        }
    }
</script>