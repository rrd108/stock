Vue.component('table-row-filter', {
    props: ['search'],

    template: '<input type="text" v-model="filterRow" autocomplete="off" placeholder="Search">',

    data() {
        return {
            products: [],
            searchResultsCount: 0,
        }
    },


    methods: {
        filterRow(val) {
            if (val) {
                this.products.forEach((product) => {
                    if (!product[search]) {
                        product.hidden = true;
                        return;
                    }
                    product.hidden = (product[search].toLowerCase().indexOf(val.toLowerCase()) == -1) ? true : false
                })
            } else {
                this.products.forEach((product) => {
                    product.hidden = false;
                })
            }
            this.searchResultsCount = this.products.filter(product => product.hidden !== true).length;
            return;
        }
    },

    created() {
        fetch('stock.json')
            .then(response => { return response.json() })
            .then(products => {
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

new Vue({
    el: 'table',
    data: {
        products: []
    }
});