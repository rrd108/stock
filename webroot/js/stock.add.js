$(function () {

    let productId;

    $('#storage-id').focus();

    $('#__partner-id').blur(function () {
        $('#items').prop('disabled', false);
        if (!partners[$('#partner-id').val()]) {
            // this is a purchase
            $('#sale').prop('checked', false);
        }
    });

    $(document).on('focus', 'input.quantity', function () {

        // display purchase prices
        productId = $(this).parent().parent().prev().prev().find('input[type=hidden]').val();
        let avaragePurchasePrice = products[productId][4];
        let lastPurschasePrice = products[productId][5];
        $(this).parent().parent().next().html(
            number_format(avaragePurchasePrice)
            + ' / '
            + number_format(lastPurschasePrice)
        );

        // display selling price
        // TODO get it from groups_products
        $(this).parent().parent().next().next().html(
            number_format(lastPurschasePrice * (1 + partners[$('#partner-id').val()] / 100))
        );
        $(this).parent().parent().next().next().next().find('input').val(
            number_format(lastPurschasePrice * (1 + partners[$('#partner-id').val()] / 100))
        );

        // vat %
        $(this).parent().parent().next().next().next().next().next().text(
            products[productId][3] + ' %'
        );

    });

    $(document).on('blur', 'input.price', function () {

        let netAmount = str2Num($('input.quantity').val()) * str2Num($(this).val());
        $(this).parent().parent().next().text(
            number_format(netAmount)
        );

        let vatAmount = netAmount * (products[productId][3] / 100);
        $(this).parent().parent().next().next().next().text(
            number_format(vatAmount)
        );

        $(this).parent().parent().next().next().next().next().text(
            number_format(netAmount + vatAmount)
        );

        addNewRow($(this).closest('tbody'));

    });

    let addNewRow = function (tbody) {

        // calculate totals
        $('tfoot tr').children().each(function (i, element) {
            let total = 0;
            if (i == 6 || i == 8 || i == 9) {
                $(element).closest('table').find('tbody tr td:nth-child(' + (i + 1) + ')')
                    .each(function (j, el) {
                        total += str2Num($(el).text())
                    });
                $(element).text(number_format(total));
            }
        });

        // insert new row
        let tr = tbody.children('tr:first');
        let rowCount = tbody.children('tr').length;
        // replase items number
        tr = tr.prop('outerHTML').replace(/items\-0/g, 'items-' + rowCount)
            .replace(/items\[0\]/g, 'items[' + rowCount + ']')
            // delete input values space is needed to keep data-value properties
            .replace(/ value="[!"]*"/, ' value=""')
            // remove text from tds
            .replace(/td class="text-right">[0-9\.,\/ %]*?<\/td/g, 'td class="text-right"></td');
        // insert row
        tbody.append(tr);

        // put focus on new line product datalist
        tbody.find('datalist:last').prev().focus();
    }
});