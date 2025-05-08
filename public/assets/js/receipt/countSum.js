function countSumm() {
    var str = '';
    var num = 0;
    $("#service option:selected").each(function () {
        str += $(this).text().split('//')[1];
        if (str == 'undefined' || num == NaN) {
            str = '';
        }
        else {
            str = str.trim();
            num = Number(str) * Number($("#count").val());
            str = num;
        }
    });
    $('#costPred').val(str);
}

function displayPayment(){
    if($('#isPaid').is(":checked")){
        showPayment();
    }
    else{
        hidePayment();
    }
}

function showPayment(){
    $('.divPayment').show();
}

function hidePayment(){
    $('.divPayment').hide();

}

$(document).ready(function () {
    hidePayment();

    $("#selectCustomer").select2();
    $("#selectWorker").select2();
    $("#service").select2();

    $("#service").on("change", countSumm)
        .trigger("change");

    $("#count").change(countSumm);

    $('#isPaid').on('click', displayPayment)
});
