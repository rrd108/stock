Vue.component('table-row-filter', {
    props: {
        search: {
            type: String,
            required: true,
        },
        products: {
            type: Array,
            required: true,
        }
    },

    template: '<input type="text" v-model="filterRow" :search="search" autocomplete="off" placeholder="Search">',

    data() {
        return {
            filterRow: '',
            searchResultsCount: 0,
        }
    },

    watch: {
        filterRow(val) {
            if (val) {
                this.products.forEach((product) => {
                    if (!product[this.search]) {
                        product.hidden = true;
                        return;
                    }
                    product.hidden = (product[this.search].toLowerCase().indexOf(val.toLowerCase()) == -1) ? true : false
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

});

new Vue({
    el: 'table',

    data: {
        products: []
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