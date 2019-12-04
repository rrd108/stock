var RowFilter = {
    created() {
        eventBus.$on('row-filter', (search) => {
            let items, field;
            items = search.field.split('.');
            field = items[1];
            items = items[0];

            if (search) {
                this[items].forEach((item) => {
                    if (!item[field]) {
                        item.hidden = true;
                        return;
                    }
                    item.hidden = (item[field].toLowerCase().indexOf(search.val.toLowerCase()) == -1) ? true : false
                })
            } else {
                this[items].forEach((item) => {
                    item.hidden = false;
                })
            }
            this.$parent.searchResultsCount = this[items].filter(item => item.hidden !== true).length;
            return;
        });
    },
}