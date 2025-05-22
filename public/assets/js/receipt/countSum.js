function countSumm(applyDisc) {
    // var str = '';
    var str = isNaN($('#costPred').val()) ? 0 : $('#costPred').val();
    var serv = str;
    var num = 0;

    // $("#service option:selected").each(function () {
    //     str += $(this).text().split('//')[1];
    //     if (str == 'undefined' || num == NaN) {
    //         str = '';
    //     }
    //     else {
    //         str = str.trim();
    //         num = Number(str) * Number($("#count").val());
    //         str = num;
    //     }
    // });
    $("#service option:selected").each(function () {
        serv = $(this).text().split('//')[1];
        if (serv == 'undefined' || num == NaN || isNaN(serv)) {
            serv = -1;
        }

        if(serv > -1)
        {
            str = Number(serv);
        }
        console.log(serv);
        
    });
            num = Number(str) * Number($("#count").val());
            str = num;


    if (applyDisc) {
        str = applyDiscount(str);
    }
    doplat = $("#costAdd").val();
    cost = str;
    if (doplat != null || doplat > 0) {
        doplat = doplat == 'undefined' || doplat == NaN ? doplat = 0 : Number(doplat);
        cost = doplat + str;
    }

    setPrice(str);
    setCost(cost);
}

function applyDiscount(str) {
    if (str != '' &&
        $('#discount').val() > 0
    ) {
        var disc = Number($('#discount').val());
        str = Number(str) - (disc / 100 * Number(str));
    }
    return str;
}

function setPrice(str) {
    $('#costPred').val(str);

}
function setCost(str) {
    $('#cost').val(str);
    $('#payNal').val(str);
}

function displayPayment() {
    if ($('#isPaid').is(":checked")) {
        showPayment();
    }
    else {
        hidePayment();
        $('#payNal').val('');

    }
}

function showPayment() {
    $('.divPayment').show();
        $('#payNal').val($('#cost').val());

}

function hidePayment() {
    $('.divPayment').hide();

}

function setDiscount(discount) {
    $('#discount').val(discount);
    $('#disc').text(discount);
}



$(document).ready(function () {
    hidePayment();

    var applyDisc = $("#applyDiscount").is(':checked');

    $("#selectCustomer").select2();
    $("#selectWorker").select2();
    $("#service").select2();

    $("#service").on("change", function () {
        countSumm(applyDisc);
    })
        .trigger("change");

    $("#count").change(function () {
        countSumm(applyDisc);
    });
    $("#costPred").change(function () {
        countSumm(applyDisc);
    });
    $("#costAdd").change(function () {
        countSumm(applyDisc);
    });

    $('#isPaid').on('click', displayPayment);

    $("#selectCustomer").on('change', function () {
        discount = $("#selectCustomer :selected").attr('discount');
        setDiscount(discount);
        countSumm(applyDisc);

    })

    $("#applyDiscount").on('change', function () {
        applyDisc = $("#applyDiscount").is(':checked');
        countSumm(applyDisc);
    })






});
