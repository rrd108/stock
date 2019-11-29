<template>
    <tbody>
        <tr v-for="invoice in invoices" :key="invoice.id" :class="invoice.sale ? 'out' : 'in'" v-show="!invoice.hidden">
            <td>
                <a :href="'invoices/view/' + invoice.id">
                    <i v-if= "invoice.sale" class="fi-arrow-left" ></i>
                    <i v-if="!invoice.sale" class="fi-arrow-right"></i>
                </a>
            </td>
            <td v-html="$options.filters.invoiceNumber(invoice.number)"></td>
            <td>{{invoice.date | toLocaleDateString}}</td>
            <td>
                <a :href="'../partners/view/' + invoice.partner.id">
                    <i class="fi-torsos"> {{invoice.partner.name}}</i>
                </a></td>
            <td><i class="fi-contrast"> {{invoice.storage.name}}</i></td>
            <td><i class="fi-book"> {{invoice.invoicetype.name}}</i></td>
            <td class="text-right">{{invoice.items.reduce((total, item) => total + item.price * item.quantity, 0) | toCurrency}}</td>
        </tr>
        </tbody>
</template>

<script>
module.exports = {
    name: 'FilteredTbody',

    props: {
        invoices: {
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

    filters : {
        invoiceNumber(value) {
            if (value.indexOf('|') != -1) {
                value = value.split('|');
                value = '<a href="' + value[2] + '">\
                    <i class="fi-page-pdf"></i>\
                    </a> ' + value[1];
            }
            return value;
        }
    }
}
</script>

<style scoped>
</style>