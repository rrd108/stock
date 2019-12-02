$(document).foundation();

const StockTexts = {
    'hu': {
        'sale': 'Eladás',
        'purchase': 'Beszerzés'
    }
};

function number_format(number, decimals, dec_point, thousands_sep) {        //jQueryvel is használjuk
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? " " : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

function str2Num(str, options) {
    //string to number: str2Num(50,000.5 {dec_point: '.', thousands_sep : ','});
    if (!str) {
        return 0;
    }

    options = options ? options : {
        dec_point: ',',  //decimals' separator
        thousands_sep: ' ',  //thousands separator - this is not a space! (CakePHP number::format)
    };
    var num = str.split(options.thousands_sep).join('').split(options.dec_point).join('.').replace(/\s/, '');
    return parseFloat(num);
}