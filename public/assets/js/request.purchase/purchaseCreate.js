import { HighlightElement } from "../tableRowSelect/rowSelect.js";
import { ItemStore, selectItemType, summ,  addItem, categoryChanged, populateSearchItemTable,
    selectSearchItem, resetEditFields, editItem, editPurchasedItem, deleteItem
 } from "../request.purchase/itemTable.js";

 
$(document).ready(function () {

    $('#cancelEdit').on('click', function () {
        resetEditFields();
    })
    $('#editSave').on('click', function () {
        editItem();
    })
    HighlightElement("itemPurchasedTbody");
    selectItemType();

    $('.itemPurchasedTbody tr').on('click', function () {
        editPurchasedItem();
    })

    $("#price").on('input', summ);
    $("#count").on('input', summ);

});

