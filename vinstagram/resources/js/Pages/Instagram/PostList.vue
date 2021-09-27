<template>

  <div class="grid grid-cols-1 gap-5 p-10 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3">
    <!--Card 1-->
    <post-item v-for="i in posts" :key="i"/>
  </div>

</template>

<script>
import PostItem from '@/Pages/Instagram/PostItem.vue';
export default {
    components: {PostItem},
    data() {
        return {
            posts :[1, 2, 3, 4, 5, 6, 7],
        };
    }

}
</script>
