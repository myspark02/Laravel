<template>
    <div class="addItem">
        <input type="text"  v-model="item.name" />
        <font-awesome-icon icon="plus-square"
        :class="[item.name ? 'active' : 'inactive', 'plus']"
        @click="addItem()" />
    </div>
</template>

<script>
export default {
    data () {
        return {
            item : {
                name: ""
            }
        }
    },
    methods: {
        async addItem() {
            if (this.item.name == '') {
                return;
            }
            let response = await axios.post('api/items', {
                name : this.item.name
            });

            if(response.status == 201) {
                this.item.name = "";
                this.$emit('reloadlist');
            }

        }
    }
}
</script>

<style scoped>
.addItem {
    display : flex;
    justify-content: center;
    align-items: center;
}

input {
    background: #f7f7f7;
    border : 0px;
    outline : none;
    padding: 5px;
    margin-right : 10px;
    width: 100%;
}

.plus {
    font-size : 20px;
}

.active {
    color : #00CE25;
}

.inactive {
    color : #999999;
}
</style>
