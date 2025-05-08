import {HighlightElement} from "../tableRowSelect/rowSelect.js";

function appendRow(element) {
    var number = element["number"];
    if (element["number"] == undefined) {
        number = "";
    }
    $(".tbodyChecks").append(
        '<tr class="checkRow"> <td class="checkDate"> <input type="radio" name="income" class="check" value="'
        + element['id']
        + '">'
        + element["date"] + ' </td><td class="checkAmount">'
        + element["amount"] + ' руб.</td><td class="checkNumber">'
        + number
        + '</td> </tr>');
}

function GetChecks() {
    fetch("http://127.0.0.1:8000/api/checks").then(function (response) {
        response.json().then(function (json) {
            $(".tbodyChecks").empty();
            json.forEach(element => {
                appendRow(element);
            });
            
            HighlightElement("tbodyChecks");
        });
    });
}

$(document).ready(function () {
    
    $('#nal').on("click", function () {
        $(".divNal").show();
        $(".divKassa").hide();
    })
    $('#kassa').on("click", function () {
        GetChecks();
        $(".divNal").hide();
        $(".divKassa").show();
    })
});