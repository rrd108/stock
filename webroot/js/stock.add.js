$(function () {
    $(document).on('focus', 'input.quantity', function () {
        $(this).parent().parent().next().html(
            products[$(this).parent().parent().prev().find('input[type=hidden]').val()][4]
            + '<br>'
            + products[$(this).parent().parent().prev().find('input[type=hidden]').val()][5]
        );
    });
});