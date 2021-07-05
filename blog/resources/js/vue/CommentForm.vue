<template>
     <div class="my-10">
                <span> Title :</span> <input type="text" v-model="title" placeholder="title" />
                <span> Content : </span> <textarea v-model="content" id="content"></textarea>
                <button @click="register">등록</button>
    </div>
</template>

<script>

export default ({
    props : ['postId'],

    data() {
        return {title: 'title',
                content: 'content',
        }
    },

    methods: {
        register() {
            axios.post('/posts/'+this.postId+'/comments' ,  {title : this.title, content: this.content})
                .then(response=>{
                    console.log(response.data);
                    this.$emit('registered')
                }).catch(error => {
                    console.log(error);
                });
        },
    },
})
</script>
