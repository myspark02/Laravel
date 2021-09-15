<template>
    <div class="ui card">
        <div class="image">
            <img width="200" :src="user.avatar_url">
        </div>
        <div class="content">
            <a :href="`https://github.com/${username}`" class="header">{{ user . name }}</a>
            <div class="meta">
                <span class="date">{{ user . created_at }}</span>
            </div>
            <div class="description">
                {{ user . bio }}
            </div>
        </div>
        <div class="extra content">
            <a :href="`https://github.com/${username}?tab=followers`">
                <i class="user icon"></i>
                {{ user . followers }}Friends
            </a>
        </div>
    </div>
</template>

<script>
export default {
    props: ['username'],

    data() {
        return {
            user: {}
        }
    },

    created() {
        axios.get(`https://api.github.com/users/${this.username}`)
            .then(response => {
                console.log(response.data);
                this.user = response.data;
            })
    }
}
</script>
