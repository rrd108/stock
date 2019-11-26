new Vue({
    el: '.p',
    data: {
        products: []
    },

    created() {
        fetch('stock.json')
            .then(response => { return response.json() })
            .then(products => this.products = products)
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