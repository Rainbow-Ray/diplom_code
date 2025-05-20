import {  selectItemType

 } from "../request.purchase/itemTable.js";
 import { HighlightElement } from "../tableRowSelect/rowSelect.js";

$(document).ready(function () {
    HighlightElement("itemTbody");
    selectItemType();
});

