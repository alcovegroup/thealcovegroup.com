$(document).ready(function() {
    $("#maxprice").val(j_price_max);
    $("#minbeds").val(j_beds_min);
    $("#maxbeds").val(j_beds_max);
    $("#minbaths").val(j_baths_min);
    $("#maxbaths").val(j_baths_max);
    console.log('x00: ' + j_price_max);

    // $('.commanator').each(function() {
    //     var x = $(this).val();
    //     $(this).val(addCommas(x));
    //     $(this).on('keyup', function () {
    //         var x = $(this).val();
    //         $(this).val(addCommas(x));
    //     });
    // });

    // $('.js_money').each(function() {
    //     var x = $(this).val();
    //     $(this).val(addMoneySign(x));
    //     $(this).on('keyup', function () {
    //         var x = $(this).val();
    //         $(this).val(addMoneySign(x));
    //     });
    // });

    $("#minprice,#maxprice").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});