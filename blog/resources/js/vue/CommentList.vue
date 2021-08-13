<template>
    <div >

           <commentForm :login-id="loginId" :post-id="postId" @registered="reloadPosts"/>

           <button v-on:click="reloadPosts">댓글리스트 새로 고침</button>
           <comment  v-for="(comment, index) in comments" v-bind:key="index" v-bind:comment="comment"  :login-id="loginId" @registered="reloadPosts"/>
    </div>
</template>

<script>

import comment from './Comment.vue'
import commentForm from './CommentForm.vue'

export default ({
    props : ['postId', 'loginId'],

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
                    this.comments = [];
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
