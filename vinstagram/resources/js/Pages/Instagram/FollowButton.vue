<template>
    <button @click="followUser" v-text="btnText"
        class="px-2 mx-4 font-semibold text-blue-700 bg-transparent border border-blue-500 rounded hover:bg-blue-500 hover:text-white hover:border-transparent">
    </button>
</template>

<script>
// import { Inertia } from '@inertiajs/inertia'

export default {
    props : ['user', 'viewed_user'],
    data() {
        return {
            form: this.$inertia.form({

            }), 
            btnText : '',
            contain : false,
        }
    }, 
    methods : {
        followUser() {
            // alert(this.user)
            this.form.post('/follow/'+this.viewed_user.id, {
                preserveScroll: true, 
                only:['user', 'viewed_user'],
                onSuccess : () =>  this.changeBtnText(), 
            })
        }, 

        initBtnText() {
            for (let i = 0; i < this.user.following.length; i++) {
                if (this.user.following[i].id == this.viewed_user.profile.id) {
                    this.contain = true;
                    break;
                }
            }
            this.btnText =  this.contain ? '팔로우 취소' : '팔로우 하기';
        },  

        changeBtnText() {
            this.contain = !this.contain
            this.btnText =  this.contain ? '팔로우 취소' : '팔로우 하기';
        }
    }, 

    created() {
        this.initBtnText();
    }


    
}
</script>
