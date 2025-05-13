import { HighlightElement } from "../tableRowSelect/rowSelect.js";
import { ItemStore, selectItemType, summ,  addItem, categoryChanged, populateSearchItemTable,
    selectSearchItem, resetEditFields, editItem, editPurchasedItem, deleteItem
 } from "../request.purchase/itemTable.js";


$(document).ready(function () {
    var itemStore = new ItemStore();
    itemStore.getItems();

    $(".select2").select2();

    $('.itemType').on('change', function () {
        selectItemType();
    })

    $("#cat").on('change', function () {
        categoryChanged();
        populateSearchItemTable();
    });

    $("#type").on('change', function () {
        populateSearchItemTable();
    });
    $("#equipCat").on('change', function () {
        populateSearchItemTable();
    });

    $("#searchItem").on('change', function () {
        selectSearchItem();
    });

    $('#itemAdd').on('click', function () {
        addItem(itemStore);
    });

    $('#deleteItem').on('click', function () {
        deleteItem();
        resetEditFields();
    })
    $('#cancelEdit').on('click', function () {
        resetEditFields();
    })
    $('#editSave').on('click', function () {
        editItem();
    })
    HighlightElement("itemTbody");
    HighlightElement("itemPurchasedTbody");
    selectItemType();

    $('.itemPurchasedTbody tr').on('click', function () {
        editPurchasedItem();
    })

    $("#price").on('input', summ);
    $("#count").on('input', summ);

});

