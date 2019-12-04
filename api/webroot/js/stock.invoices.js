const eventBus = new Vue();     // communicate between components

Vue.filter('toCurrency', function (value) {
    // TODO set it from session
    return new Intl.NumberFormat('hu-HU', {
        style: 'currency',
        currency: 'HUF',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(value);
});

Vue.filter('toLocaleDateString', function (value) {
    return new Date(value).toLocaleDateString('hu-HU');
});


new Vue({
    el: 'table',

    components: {
        'filter-input': httpVueLoader('./js/components/FilterInput.vue'),
        'filtered-tbody': httpVueLoader('./js/components/FilteredInvoiceTbody.vue'),
    },

    data: {
        invoices: [],
        searchResinvoicest: 0,
    },

    created() {
        fetch('./api/invoices.json')
            .then(response => { return response.json() })
            .then(invoices => {
                // vue will not listen to changes of the hidden property i it just added later dynamically
                invoices.forEach((invoice) => {
                    invoice.hidden = false;
                    invoice.partnerName = invoice.partner.name;
                    invoice.storageName = invoice.storage.name;
                    invoice.invoiceType = invoice.invoicetype.name;
                })
                this.invoices = invoices
                this.searchResultsCount = invoices.length
            }
            )
            .catch(err => console.log(err));
    },
});