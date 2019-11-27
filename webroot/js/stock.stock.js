new Vue({
    el: 'table',

    data() {
        return {
            products: [],
            filterByName: '',
            filterByCode : '',
            searchResultsCount: 0,
        }
    },

    watch: {
        filterByName(val) {
            this.filterOut(val, 'name');
        },
        filterByCode(val) {
            this.filterOut(val, 'code');
        },
    },

    methods: {
        filterOut(val, field) {
            if (val) {
                this.products.forEach((product) => {
                    if (!product[field]) {
                        product.hidden = true;
                        return;
                    }
                    product.hidden = (product[field].toLowerCase().indexOf(val.toLowerCase()) == -1) ? true : false
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