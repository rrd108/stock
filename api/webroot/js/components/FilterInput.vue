<template>
    <input type="text" v-model="filterRow" :search="search" autocomplete="off" placeholder="Search">
</template>

<script>
module.exports = {
    name: 'FilterInput',

    props: {
        search: {
            type: String,
            required: true,
        }
    },

    data() {
        return {
            filterRow: '',
        }
    },

    watch: {
        filterRow(val) {
            eventBus.$emit('row-filter', { field: this.search, val: val });
        }
    }
}
</script>

<style scoped>
</style>