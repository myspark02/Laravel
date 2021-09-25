<template>
        <div class="ui cards">
                <github-user-card v-for="(member, index) in members" v-bind:key="index" :username="member.name"/>
        </div>
</template>

 <script>
 import GithubUserCard from './GithubUserCard.vue';
 export default {
    components :{GithubUserCard},
    data() {
        return {
            members:[]
        }
    },
    methods: {
        async getGithubUsers() {
            let response = await axios.get('/github_users');
            console.log(response.data)
            if (response.status == 200) {
                this.members = response.data;
            }

        }
    },
    created() {
        this.getGithubUsers();
    }
 }
</script>
