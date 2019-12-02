<template>
    <tbody>
        <tr v-for="product in products" :key="product.id" v-show="!product.hidden">
            <td><a :href="'view/' + product.id">{{product.name}}</a></td>
            <td>{{product.code}}</td>
            <td>{{product.size}}</td>
            <td class="text-right">{{product.stock | toNum(0)}}</td>
            <td class="text-right">{{product.avaragePurchasePrice | toCurrency}}</td>
            <td class="text-right">{{product.lastPurchasePrice | toCurrency}}</td>
            <td class="text-right">{{product.stock * product.avaragePurchasePrice | toCurrency}}</td>
            <td class="text-right">{{product.stock * product.lastPurchasePrice | toCurrency}}</td>
        </tr>
    </tbody>
</template>

<script>

module.exports = {
    name: 'FilteredTbody',

    props: {
        products: {
            type: Array,
            required: true
        }
    },

    data() {
        return {
            searchResultsCount: 0,
        }
    },

    // we can not use mixins here RowFilter.js
    created() {
        eventBus.$on('row-filter', (search) => {
            let items, field;
            items = search.field.split('.');
            field = items[1];
            items = items[0];

            if (search) {
                this[items].forEach((item) => {
                    if (!item[field]) {
                        item.hidden = true;
                        return;
                    }
                    item.hidden = (item[field].toLowerCase().indexOf(search.val.toLowerCase()) == -1) ? true : false
                })
            } else {
                this[items].forEach((item) => {
                    item.hidden = false;
                })
            }
            this.$parent.searchResultsCount = this[items].filter(item => item.hidden !== true).length;
            return;
        });
    },

}
</script>

<style scoped>
</style>