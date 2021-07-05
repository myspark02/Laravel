<template>
     <div class="my-10" >
         <div v-if="displayForm">
                <span> Title :</span> <input type="text" v-model="title" placeholder="title" />
                <span> Content : </span> <textarea v-model="content" id="content"></textarea>
                <button @click="register">등록</button>
         </div>
    </div>
</template>

<script>

export default ({
    props : ['postId', 'loginId'],

    data() {
        return {title: 'title',
                content: 'content',
        }
    },
    computed : {
        displayForm() {
            return this.loginId!=-1;
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
