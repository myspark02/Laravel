<template>
     <div class="my-10">
                <span> Title : {{ comment.title }}</span>
                <span> Content :  {{ comment.content }} </span>
                <span> Written  on {{ comment.created_at }} </span>
                <div v-if="canDelete">
                    <button @click="remove"> delete</button>
                </div>
    </div>
</template>

<script>

export default ({
    props : ['comment', 'loginId'],
    setup() {

    },
    computed: {
        canDelete() {
            return this.comment.user_id == this.loginId
        }
    },
    methods : {
        remove() {
            console.log('remove cliked...')
            axios.delete('/posts/comments/delete/'+this.comment.id)
                .then(response => {
                    console.log(response.data)
                    this.$emit('registered')
                    this.$emit('registered')
                }).catch(error => {
                    console.log(error);
                })
        },
    }
})
</script>
