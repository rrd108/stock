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

    created() {
        eventBus.$on('row-filter', (search) => {
            if (search) {
                this.products.forEach((product) => {
                    if (!product[search.field]) {
                        product.hidden = true;
                        return;
                    }
                    product.hidden = (product[search.field].toLowerCase().indexOf(search.val.toLowerCase()) == -1) ? true : false
                })
            } else {
                this.products.forEach((product) => {
                    product.hidden = false;
                })
            }
            this.$parent.searchResultsCount = this.products.filter(product => product.hidden !== true).length;
            return;
        });
    },
}
</script>

<style scoped>
</style>