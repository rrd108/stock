new Vue({
    el: 'table',

    data() {
        return {
            products: [],
            searchQuery: '',
            searchResultsCount: 0,
        }
    },

    watch: {
        searchQuery(val) {
            if (val) {
                this.products.forEach((product) => {
                    product.hidden = (product.name.toLowerCase().indexOf(val.toLowerCase()) == -1) ? true : false
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
        toInt(value) {
            return parseInt(value);
        }
    }
});