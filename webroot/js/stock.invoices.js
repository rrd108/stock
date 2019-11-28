const eventBus = new Vue();     // communicate between components

Vue.filter('toCurrency', function (value) {
    // TODO set it from session
    return new Intl.NumberFormat('hu-HU', {
        style: 'currency',
        currency: 'HUF',
        minimumFractionDigits: 0
    }).format(value);
});

Vue.filter('toLocaleDateString', function (value) {
    return new Date(value).toLocaleDateString('hu-HU');
});

Vue.filter('toNum', function (value, precision) {
    return precision ? value : parseInt(value);
});

Vue.filter('invoiceNumber', function (value) {
    if (value.indexOf('|') != -1) {
        value = value.split('|');
        value = value[1];
        /*value = '<a href="' + value[2] + '">\
            <i class="fi-page-pdf"></i>\
            </a> ' + value[1];*/
    }
    return value;
});

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
        invoices: {
            type: Array,
            required: true
        }
    },

    template: '<tbody>\
        <tr v-for="invoice in invoices" :key="invoice.id" :class="invoice.sale ? \'out\' : \'in\'" v-show="!invoice.hidden">\
            <td>\
                <a :href="\'view/\' + invoice.id">\
                    <i v-if= "invoice.sale" class="fi-arrow-left" ></i>\
                    <i v-if="!invoice.sale" class="fi-arrow-right"></i>\
                </a>\
            </td>\
            <td>{{invoice.number | invoiceNumber}}</td>\
            <td>{{invoice.date | toLocaleDateString}}</td>\
            <td>\
                <a :href="\'../partners/view/\' + invoice.partner.id">\
                    <i class="fi-torsos"> {{invoice.partner.name}}</i>\
                </a>\</td>\
            <td><i class="fi-contrast"> {{invoice.storage.name}}</i></td>\
            <td><i class="fi-book"> {{invoice.invoicetype.name}}</i></td>\
            <td>{{invoice.items.reduce((total, item) => total + item.price * item.quantity, 0) | toCurrency}}</td>\
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
                this.invoices.forEach((invoice) => {
                    if (!invoice[search.field]) {
                        invoice.hidden = true;
                        return;
                    }
                    invoice.hidden = (invoice[search.field].toLowerCase().indexOf(search.val.toLowerCase()) == -1) ? true : false
                })
            } else {
                this.invoices.forEach((invoice) => {
                    invoice.hidden = false;
                })
            }
            this.$parent.searchResultsCount = this.invoices.filter(invoice => invoice.hidden !== true).length;
            return;
        });
    },

});

new Vue({
    el: 'table',

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