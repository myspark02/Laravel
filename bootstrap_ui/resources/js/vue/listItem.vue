<template>
    <div class="item">
        <input type="checkbox"
                @change="updateItem()"
                v-model = "item.completed"
        />
        <span :class="[item.completed ? 'completed' : '', 'itemText']">{{ item.name }}</span>
        <button @click="removeItem()" class="trashcan">
            <font-awesome-icon icon="trash"/>
        </button>
    </div>
</template>

<script>
export default {
    props : ['item'],
    methods: {
        async updateItem() {
            let response = await axios.put('api/items/' + this.item.id, {
                'completed' : this.item.completed
            })
            if (response.status == 200) {
                this.$emit('itemchanged');
            }

        },

        async removeItem() {
            let response = await axios.delete('api/items/' + this.item.id);
            if (response.status == 200) {
                this.$emit('itemchanged');
            }
        }
    }
}
</script>

<style scoped>
.completed {
    text-decoration: line-through;
    color: #999999;
}
.itemText {
    width: 100%;
    margin-left : 20px;
}
.item {
    display : flex;
    align-items: center;
}

.trashcan {
    background : #e6e6e6;
    border: none;
    color: #ff0000;
    outline: none;
}
</style>
