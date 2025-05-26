function countSumm() {
    // var str = '';
    var str = 0;
    var serv = str;
    var num = 0;

    $("#service option:selected").each(function () {
        serv = $(this).attr('cost');
        if (serv == 'undefined' || num == NaN || isNaN(serv)) {
            serv = -1;
        }

        if (serv > -1) {
            str = Number(serv);
        }
    });
    num = Number(str) * Number($("#count").val());
    str = num;

    cost = str;

    setCost(cost);
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

function getIncome(income_id) {

    var resp = ApiClient.fetchItems('getincome', income_id);

    resp.then(function (json) {
        console.log(json);

        $('#incSource').text(json['source_name']);
        $('#incDate').text(json['date']);
        $('#incAmount').text(json['amount']);
    });
}

class ApiClient {
    static async fetchItems(apiUrl, filters) {
        // const url = `/api/${apiUrl}/id?${new URLSearchParams({ ...filters })}`;
        const url = `/api/${apiUrl}/${filters}`;
        const response = await fetch(url);
        return await response.json();
    }
}

$(document).ready(function () {

    $("#service").select2();

    $("#service").on("change", function () {
        countSumm();
    })
        .trigger("change");



    $("#count").change(function () {
        countSumm();
    });

    $("#count").change(function () {
        countSumm();
    });
    $(".divNal").show();

    $("#nal").trigger("click");


    console.log($('#incomeEdit').length);


    if ($('#incomeEdit').length > 0) {
        $(window).on('focus', function () {
            var id = $('#incomeId').val();

            getIncome(id);
        });

        $(window).trigger('focus');


    }
});
