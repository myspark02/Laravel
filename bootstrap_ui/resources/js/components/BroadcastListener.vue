<template>
        <div>
            <span>{{ message }} </span>
        </div>
</template> 
<script>

export default {
    data () {
        return {
            message:''  
        };
    },  
    created () {
        window.Echo.private('message-channel')
            .listen('Message', (e) => {
                this.message = e.message
                console.log(e.message);
            });
    }
}

</script>
