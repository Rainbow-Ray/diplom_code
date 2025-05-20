import { ItemStore, selectItemType, summ,  addItem, categoryChanged, populateSearchItemTable,
    selectSearchItem, resetEditFields, editItem, editPurchasedItem, deleteItem
 } from "../request.purchase/itemTable.js";
 import { HighlightElement } from "../tableRowSelect/rowSelect.js";


$(document).ready(function () {

    HighlightElement("itemTbody");
    selectItemType();



});
