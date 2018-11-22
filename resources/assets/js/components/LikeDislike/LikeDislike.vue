<template>
    <div id="like-dislike">
        <div class="like">
            <button type="button" @click.prevent="handleLikeDislike(1)" class="btn btn-primary btn-sm">Like &nbsp;
                <span class="badge-default">{{ like }}</span>
            </button>
        </div>
        <div class="dislike">
            <button type="button" @click.prevent="handleLikeDislike(0)" class="btn btn-info btn-sm">Dislike
                &nbsp;
                <span class="badge-default">{{ dislike }}</span></button>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'like_dislike',
        data() {
            return {
                like: 0,
                dislike: 0
            }
        },
        props: {
            blog_id: {
                required: true,
                type: Number
            }
        },
        created() {
            this.getLikeDislike();
        },
        methods: {
            async getLikeDislike() {
                let res = await axios.get('/api/like-dislike/' + this.blog_id);
                this.like = res.data.data.total_likes;
                this.dislike = res.data.data.total_dislikes;
            },
            async handleLikeDislike(param) {
                let res = await axios.post('/api/like-dislike/' + this.blog_id,
                    {
                        param: param,
                    }
                );
                if (res.data.success) {
                    this.getLikeDislike();
                }
            }
        }

    }


</script>

<style scoped>
    #like-dislike {
        display: flex;
        margin-top: 5px;

    }

    .like {
        margin-right: 10px;

    }
</style>