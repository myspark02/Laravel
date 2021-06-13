<template>
    <div>
        <button
            class="bg-blue-500 active:bg-blue-700 text-white font-black text-lg rounded-full px-4"
            @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>

export default {
    props:['userId', 'follows'], 

    data() {
        return {
            status : this.follows,
        }
    }, 
    mounted() {
        console.log('Component mounted')
    }, 
    methods : {
        followUser() {
            // alert('clicked');
            axios.post('/follow/'+this.userId)
                .then(response=>{
                    this.status = !this.status;
                    console.log(response.data);
                })
                .catch(error => {
                    alert(error);
                    if (error.response.status == 401) {
                        window.location = '/login';
                    }
                    // alert(error);
                } );
        }
    }, 

    computed : {
        buttonText() {
            return (this.status) ? 'Unfollow' : 'follow';
        }
    }

}
</script>
