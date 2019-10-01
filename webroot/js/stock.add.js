$(function () {
    $(document).on('focus', 'input.quantity', function () {
        $(this).parent().parent().next().html(
            number_format(products[$(this).parent().parent().prev().prev().find('input[type=hidden]').val()][4])
            + '<br>'
            + number_format(products[$(this).parent().parent().prev().prev().find('input[type=hidden]').val()][5])
        );
    });
});