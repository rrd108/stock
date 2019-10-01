$(function () {

    let productId;

    $(document).on('focus', 'input.quantity', function () {

        // display purchase prices
        productId = $(this).parent().parent().prev().prev().find('input[type=hidden]').val();
        let avaragePurchasePrice = products[productId][4];
        let lastPurschasePrice = products[productId][5];
        $(this).parent().parent().next().html(
            number_format(avaragePurchasePrice)
            + '<br>'
            + number_format(lastPurschasePrice)
        );

        // display selling price
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

    });

});