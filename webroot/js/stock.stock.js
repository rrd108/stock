const eventBus = new Vue();     // communicate between components

Vue.component('filter-input', {
    props: {
        search: {
            type: String,
            required: true,
        }
    },

    template: '<input type="text" v-model="filterRow" :search="search" autocomplete="off" placeholder="Search">',

    data() {
        return {
            filterRow: '',
        }
    },

    watch: {
        filterRow(val) {
            eventBus.$emit('row-filter', { field: this.search, val: val });
        }
    },

});

Vue.component('filtered-tbody', {
    props: {
        products: {
            type: Array,
            required: true
        }
    },

    template: '<tbody>\
            <tr v-for="product in products" :key="product.id" v-show="!product.hidden">\
                <td><a :href="\'view/\' + product.id">{{product.name}}</a></td>\
                <td>{{product.code}}</td>\
                <td>{{product.size}}</td>\
                <td class="text-right">{{product.stock | toNum(0)}}</td>\
                <td class="text-right">{{product.avaragePurchasePrice | toCurrency}}</td>\
                <td class="text-right">{{product.lastPurchasePrice | toCurrency}}</td>\
                <td class="text-right">{{product.stock * product.avaragePurchasePrice | toCurrency}}</td>\
                <td class="text-right">{{product.stock * product.lastPurchasePrice | toCurrency}}</td>\
            </tr>\
        </tbody>',

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

    filters: {
        toCurrency(value) {
            // TODO set it from session
            return new Intl.NumberFormat('hu-HU', {
                style: 'currency',
                currency: 'HUF',
                minimumFractionDigits: 0
            }).format(value);
        },
        toNum(value, precision) {
            return precision ? value : parseInt(value);
        }
    }
});

new Vue({
    el: 'table',

    data: {
        products: [],
        searchResultsCount: 0,
    },

    created() {
        fetch('stock.json')
            .then(response => { return response.json() })
            .then(products => {
                // vue will not listen to changes of the hidden property i it just added later dynamically
                products.forEach((product) => {
                    product.hidden = false;
                })
                this.products = products
                this.searchResultsCount = products.length
            }
            )
            .catch(err => console.log(err));
    },

    filters: {
        toCurrency(value) {
            // TODO set it from session
            return new Intl.NumberFormat('hu-HU', {
                style: 'currency',
                currency: 'HUF',
                minimumFractionDigits: 0
            }).format(value);
        },
        toNum(value, precision) {
            return precision ? value : parseInt(value);
        }
    }
});