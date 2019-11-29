const eventBus = new Vue();     // communicate between components

Vue.filter('toCurrency', function(value) {
    // TODO set it from session
    return new Intl.NumberFormat('hu-HU', {
        style: 'currency',
        currency: 'HUF',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(value);
});

Vue.filter('toNum', function (value, precision) {
    return precision ? value : parseInt(value);
});

new Vue({
    el: 'table',

    components: {
        'filter-input': httpVueLoader('../js/components/FilterInput.vue'),
        'filtered-tbody': httpVueLoader('../js/components/FilteredProductTbody.vue')
    },

    data: {
        products: [],
        searchResultsCount: 0,
    },

    created() {
        fetch('../api/products/stock.json')
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

});