<template>
     <div class="my-10">
                <span> Title : {{ comment.title }}</span>
                <span> Content :  {{ comment.content }} </span>
                <span> Written  on {{ comment.created_at }} </span>
    </div>
</template>

<script>

export default ({
    props : ['comment'],
    setup() {

    },
})
</script>
