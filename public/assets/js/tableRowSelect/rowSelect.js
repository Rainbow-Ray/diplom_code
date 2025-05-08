
export function SelectRow(selectedTr) {
    if (!$(selectedTr).hasClass("selected")) {
        $(".selected").removeClass("selected");
        $(selectedTr).find(".check").prop("checked", true);
        $(selectedTr).addClass("selected");
    }
}

function SelectSeveralRow(selectedTr) {
    if (!$(selectedTr).hasClass("selected")) {

        $(selectedTr).find(".check").prop("checked", true);
        $(selectedTr).addClass("selected");
    }

    else if($(selectedTr).hasClass("selected")){
        
        $(selectedTr).removeClass("selected");
        $(selectedTr).find(".check").prop("checked", false);

    }
    
}

export function HighlightSeveralElement (tbodyClass) {
    $("." + tbodyClass + " tr").on('click', function () {
        SelectSeveralRow(this);
    })
}

export function HighlightElement(tbodyClass) {
    $("." + tbodyClass + " tr").on('click', function () {
        SelectRow(this);
    })
}
export function HighlightConcreteElement(selector) {
    $(selector).on('click', function () {
        SelectRow(this);
    })
}


export default {HighlightSeveralElement, HighlightElement, HighlightConcreteElement, SelectRow}

