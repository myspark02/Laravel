<template>
    <div>
           <comment  v-for="(comment, index) in comments" v-bind:key="index" v-bind:comment="comment" />
    </div>
</template>

<script>

import comment from './Comment.vue'

export default ({
    props : ['comments'],
    setup() {

    },
    components : {comment},
})
</script>
