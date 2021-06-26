<template>
    <div>
        {{ message }}
    </div>
</template>

<script>

export default {
    props:['userId'], 

    data() {
        return {
            id : this.userId,
            message: "", 
        }
    }, 

    mounted() {
        console.log('Component mounted')
    }, 

    created () {
        console.log('Component created')
        console.log(`user.${this.id}`)
        Echo.private(`user.${this.id}`).listen('.user.viewed', (e) => {
            alert('wow!')
            console.log(e.message);
            this.message = e.message;
        });

        Echo.channel(`user.${this.id}`).listen('.user.viewed', (e) => {
            alert('wow!')
            console.log(e.model);
            this.message = e.message;
        });
    } , 
    methods : {
    }, 

    computed : {
    }

}
</script>
