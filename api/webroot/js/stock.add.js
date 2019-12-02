$(function () {

    let productId;

    $('#storage-id').focus();

    $('.group').hide();

    $('#__partner-id').blur(function () {
        $('#items').prop('disabled', false);
        if (!partners[$('#partner-id').val()]) {
            $('#sale').prop('checked', false).change();
        }
    });

    $('#sale').change(function () {
        // hide or show stock, purchase price, selling price and selling prices for different groups
        if (this.checked) {
            $('table thead tr').removeClass('in').addClass('out');
            $(this).parent().parent().parent().addClass('out').removeClass('in');
            $(this).parent().find('span').text(StockTexts.hu.sale);
            $('td:nth-child(2), th:nth-child(2)').show();
            $('td:nth-child(4), th:nth-child(4)').show();
            $('td:nth-child(5), th:nth-child(5)').show();
            $('.group').hide();
        } else {
            $('table thead tr').removeClass('out').addClass('in');
            $(this).parent().parent().parent().addClass('in').removeClass('out');
            $(this).parent().find('span').text(StockTexts.hu.purchase);
            $('td:nth-child(2), th:nth-child(2)').hide();
            $('td:nth-child(4), th:nth-child(4)').hide();
            $('td:nth-child(5), th:nth-child(5)').hide();
            $('.group').show();
        }
    });

    $('form').submit(function () {
        if (isEmptyLastRow()) {
            $('table tbody tr:last').remove();
        }
    });

    let isEmptyLastRow = function () {
        return !$('table tbody tr:last').find('input[type=hidden]').val();
    }

    $(document).on('focus', 'input.quantity', function () {

        // display purchase prices
        productId = $(this).parent().parent().prev().prev().find('input[type=hidden]').val();
        let avaragePurchasePrice = products[productId][4];
        let lastPurschasePrice = products[productId][5];
        // we ca not have html here because of the way we remove last empty line
        // TODO have 2 spans here for the prices
        $(this).parent().parent().next().html(
            number_format(avaragePurchasePrice)
            + ' / '
            + number_format(lastPurschasePrice)
        );

        // display selling price
        // TODO get it from groups_products if it dirrefrent fom the default and have 2 spans here
        $(this).parent().parent().next().next().html(
            number_format(lastPurschasePrice * (1 + partners[$('#partner-id').val()] / 100))
        );

        if (!$(this).parent().parent().next().next().next().find('input').val() > 0) {
            $(this).parent().parent().next().next().next().find('input').val(
                number_format(lastPurschasePrice * (1 + partners[$('#partner-id').val()] / 100))
            );
        }

        // vat %
        $(this).parent().parent().next().next().next().next().next().text(
            products[productId][3] + ' %'
        );

    });

    $(document).on('blur', 'input.net.price', function () {

        let netPrice = str2Num($(this).val());
        let netAmount = str2Num($(this).closest('tr').find('input.quantity').val()) * netPrice;
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

        $(this).parent().parent().parent().find('.group input.price').each(function () {
            // TODO read last price from DB
            $(this).val(
                number_format(netPrice * ($(this).data('percentage') / 100 + 1))
            );
        });
    });

    $('#addNewRow').click(function () {
        let tbody = $(this).parents('table').find('tbody');

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
        if (!isEmptyLastRow()) {
            let tr = tbody.children('tr:first');
            let rowCount = tbody.children('tr').length;
            // replace items number
            tr = tr.prop('outerHTML').replace(/items\-0/g, 'items-' + rowCount)
                .replace(/items\[0\]/g, 'items[' + rowCount + ']')
                // delete input values space is needed to keep data-value properties
                .replace(/ value="[!"]*"/, ' value=""')
                // remove text from tds
                .replace(/td class="text-right">[0-9\.,\/ %]*?<\/td/g, 'td class="text-right"></td');
            // insert row
            tbody.append(tr);
        } else {
            $('table tbody tr:last').remove();
        }

        // put focus on new line product datalist
        tbody.find('datalist:last').prev().focus();
    });
});