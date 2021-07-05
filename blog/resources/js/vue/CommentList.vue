<template>
    <div>
           <commentForm :post-id="postId" />
           <comment  v-for="(comment, index) in comments" v-bind:key="index" v-bind:comment="comment" v-on:registered="reloadPosts" />
    </div>
</template>

<script>

import comment from './Comment.vue'
import commentForm from './CommentForm.vue'

export default ({
    props : ['postId'],

    setup() {

    },
    components : {comment, commentForm},

       data() {
        return  {
        comments : [],
        }
    },

    methods: {
        reloadPosts() {
            axios.get('/posts/'+this.postId+'/comments')
                .then(response=> {
                    console.log(response.data)
                    // alert(response.data);
                    this.comments = response.data;
                })
                .catch(error=>{
                    console.log(error)
                })
        }
    },

    created() {
        console.log('created comment-list')
        this.reloadPosts();
    },



})
</script>
