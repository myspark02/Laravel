<template>

  <div class="grid grid-cols-1 gap-5 p-10 justify-items-center sm:grid-cols-1">
    <!--Card 1-->
    <home-post-item v-for="post in posts_data" :key="post" :post="post" />
  </div>

</template>

<script>
import HomePostItem from '@/Pages/Instagram/HomePostItem.vue';
export default {
    props : ['posts'],
    components: {HomePostItem},
    data() {
        return {
            posts_data: this.posts.data,
        };
    },
    methods: {
        scroll: function () {
            const self = this;
            window.onscroll = function(ev) {
                if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight) {
                    const posts_links = self.posts.links;
                    const next = posts_links[posts_links.length - 1];
                    if (next.url) {
                        self.$inertia.visit(next.url, {
                        preserveScroll: true,
                        preserveState: true,
                        });
                        self.posts_data.push(...self.posts.data);
                    }
                }
            };
        }
    },
    mounted () {
        this.scroll();
    },
}
</script>
