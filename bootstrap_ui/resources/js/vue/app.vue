<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id = "title">Todo List</h2>
            <add-item-form v-on:reloadlist="getList()"/>
        </div>
        <list-view :items="items"
            v-on:reloadlist="getList()" />
    </div>
</template>

<script>
import addItemForm from "./addItemForm.vue"
import ListView from './listView.vue'

export default {

    components: {addItemForm, ListView},
    data() {
        return {
            items : [],
        }
    },
    methods : {
        async getList() {
            let response = await axios.get('api/items');
            if (response.status == 200) {
                this.items = response.data;
            }
        }
    },

    created() {
        this.getList();
    }
}
</script>

<style scoped>
    .todoListContainer  {
        width:350px;
        margin:auto;

    }

    .heading {
        background : #e6e6e6;
        padding: 10px;
    }

    #title {
        text-align:  center;
    }
</style>
