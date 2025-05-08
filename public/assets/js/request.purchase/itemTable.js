import { HighlightElement, HighlightConcreteElement, SelectRow } from "../tableRowSelect/rowSelect.js";

const types = {
    M: 'M',
    F: 'F',
    I: 'I',
};
const prefixes = {
    material: 'M',
    equip: 'F',
    other: 'I',
};

class ApiClient {
    static async fetchItems(item_type, filters = {}) {
        const url = `/api/items?${new URLSearchParams({ item_type, ...filters })}`;
        const response = await fetch(url);
        return await response.json();
    }

    static async addItem(itemData) {
        const response = await fetch("/api/items", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: itemData,
        });

        return await response.json();
    }
}


class item {
    id;
    prefix;
    constructor(prefix, id) {
        this.id = prefix + id;
    }
}

class ItemStore{
    items = Array();
    itemID = 1;

    getItems(){
        var prefixId = $('.check');
        if(prefixId.length){
            prefixId.forEach(itemPrId => {
                var prefix = itemPrId[0];
                var id = itemPrId.substr(1);
                var i = new item(prefix, id);
                this.items.push(i);
            });
        }

    }

    isAdded(id) {
        return this.items.some(e => e.id === id)
    }
    
}


function appendSearchItem(element) {
    $(".searchItemsTbody").append(
        '<tr><td><input type="radio" name="material" class="hide check" id="' + element['id'] + '">' +
        element['name'] + '</td> </tr>'
    );
}

function appendItem(json) {
    var selector = '.itemTbody';
    if (!$('.itemPurchasedTbody').length) {
        selector = '.itemTbody';
    }
    else {
        selector = '.itemPurchasedTbody';
    }
    console.log(selector);
    console.log(json);

    $(selector).append(
        `<tr>
            <td>
            <input type='text' name='itemCheck[].Key'
            class='hide check `+ json['frontPrefId'] + `' 
            id='item`+ json['frontPrefId'] + `' 
            value='` + json['frontValue'] + `' readonly>
            <input type='text' name='itemCheck[].Value' 
            class='hide `+ json['frontPrefId'] + `' 
            value='`+ json['itemQuantity'] + `'>
            `+ json['name'] + `</td>
            <td> `+ json['count'] + `</td>
            <td> `+ json['eiName'] + `</td>
            </tr>`
    );
}

function addError(field, error){
    $('#'+field).after("<span class='error'>"+ error +"<span>");
}
function removeErrors(){
    $('.error').remove();
}

function addItem(itemStore) {

    removeErrors();

    var count = $('#count').val();
    var ei = $('#ei').find(':selected').val();
    var type = $('.itemType:checked').val();
    var prefix = prefixes[type];
    var isPurchased = false;
    if($('#price').length){
        var price = $('#price').val();
        isPurchased = true;
    }

    var are_adding = false;

    var it = new item();

    if ($('#name').val() == '' || $('#name').val() == undefined) {
        var selected_item = '.searchItemsTbody > .selected';
        var id = $(selected_item).find(".check").attr('id');
        var name = $(selected_item).text();
        it = new item(prefix, id);
        if (id != undefined && !itemStore.isAdded(prefix + id)) {
            are_adding = true;
        }
    }
    else {
        var id = itemID;
        var name = $('#name').val();
        $('#name').val('');
        itemStore.itemID += 1;
        it = new item(prefix, id);
        itemStore.items.push(it);
        are_adding = true;
    }

    if (are_adding) {
        if(isPurchased){
            var data = JSON.stringify({
                name: name,
                id: id,
                count: count,
                ei: ei,
                type: type,
                price: price,
                isPurch: true,

            });
        }
        else{
            var data = JSON.stringify({
                name: name,
                id: id,
                count: count,
                ei: ei,
                type: type,
                isPurch: false,

            });
        }

        var resp = ApiClient.addItem(data);

            resp.then(function (json) {

                if(json['hasErrors']){
                    console.log(json['errors']);
                    Object.keys(json['errors']).forEach(k=>{
                        addError(k, json['errors'][k])
                    })    
                }
                else{
                    updateTable(json);
                    itemStore.items.push(it);
                    $('#itemName').val('');
                    $('#price').val('');
                }        
            });
    }
    HighlightConcreteElement('.itemTbody :last-child');
    HighlightConcreteElement('.itemPurchasedTbody :last-child');
    bindEditingFunc('.itemPurchasedTbody :last-child')
}



function updateSearchedItems(json) {
    $(".searchItemsTbody").empty();
    $("#searchItem").empty();
    emptySearchTab();
    json.forEach(element => {
        appendOption('#searchItem', element);
        appendSearchItem(element);
    });
    selectSearchItem();
    putInTextBox();
    HighlightElement("searchItemsTbody");
}

function get_materials(cat_id, type_id) {
    var resp = ApiClient.fetchItems('material', { cat: cat_id, type: type_id });

    resp.then(function (json) {
        updateSearchedItems(json)
    });
}

function get_equips(type_id) {
    var resp = ApiClient.fetchItems('equip', { type: type_id });
    resp.then(function (json) {
        updateSearchedItems(json);
    });
}

function putInTextBox() {
    $('.searchItemsTbody tr').on('click', function (e) {
        textInTextBox(e.currentTarget.innerText);
    })
}

function textInTextBox(text) {
    $('#itemName').val(text);
}

function appendOption(select_id, element) {
    $(select_id).append(
        '<option value="' +
        element['id'] +
        '">' +
        element["name"] + ' </option>'
    );
}

function categoryChanged() {
    var cat_id = $("#cat").find(':selected').val();
    if (cat_id == null) {
        get_types("")
    }
    else {
        get_types(cat_id)
    }
}

function selectSearchItem() {
    var item_id = $("#searchItem").find(':selected').val();
    if (item_id != undefined) {
        var selected_tr_item = $('.searchItemsTbody').find('#' + item_id).parent().parent();
        SelectRow(selected_tr_item);
        textInTextBox($('.searchItemsTbody').find('#' + item_id).parent()[0].innerText);
    }
}

function get_types(cat_id) {
    fetch("http://127.0.0.1:8000/api/types/" + cat_id).then(function (response) {
        response.json().then(function (json) {
            populateSelectWithDefault("#type", json);
        }
        );
    });
}

function populateSelectWithDefault(selectId, json) {
    $(selectId).empty();
    var all = { id: "", name: 'Все' };
    appendOption(selectId, all);
    json.forEach(element => {
        appendOption(selectId, element);
    });
}

function populateSearchItemTable() {
    if ($('.itemType:checked').val() == 'material') {
        var cat_id = $("#cat").find(':selected').val();
        var type_id = $("#type").find(':selected').val();
        get_materials(cat_id, type_id);
    }
    else {
        var type_id = $("#equipCat").find(':selected').val();
        get_equips(type_id);
    }
}


function updateTable(data) {
    appendItem(data);
}

function deleteItem() {
    $('.itemTbody > .selected').remove();
    $('.itemPurchasedTbody > .selected').remove();
    $('#itemName').val('');
}

function showFilterBox() {
    $('.filterBox').show();
    $('.filterResult').show();
    $('#itemName').show();
}

function hideFilterBox() {
    $('.filterBox').hide();
    $('.filterResult').hide();
    $('#itemName').hide();

}

function selectItemType() {
    $('.searchItemsTbody').empty();
    if ($('.itemType:checked').val() == 'material') {
        showFilterBox();
        $('.addEquip').hide();
        $('.addMaterial').show();
        $('.addNamedItem').hide();
        populateSearchItemTable();
    }
    else if ($('.itemType:checked').val() == 'equip') {
        showFilterBox();
        $('.addEquip').show();
        $('.addMaterial').hide();
        $('.addNamedItem').hide();
        populateSearchItemTable();
    }
    else {
        hideFilterBox();
        $('.filterBox').hide();
        $('.addNamedItem').show();
    }
}

function emptySearchTab() {
    $('#searchItem').empty();
}

function editPurchasedItem() {
    if (!$('.itemPurchasedTbody .selected .tItemCount').length) {
        resetEditFields();
        return;
    }

    var nameNode = $('.itemPurchasedTbody .selected .tItemName')[0];
    var id = $('.itemPurchasedTbody .selected .tItemName > input.check').val();
    var countNode = $('.itemPurchasedTbody .selected .tItemCount')[0];
    var countEi = $('.itemPurchasedTbody .selected .tItemName input.countEi').val();
    var priceNode = $('.itemPurchasedTbody .selected .tItemPrice')[0];

    var name = nameNode == undefined ? '' : nameNode.innerText;
    var countN = countNode == undefined ? '0' : countNode.innerText;
    var count = countN.split(" ")[0];
    var ei = countEi.length > 2 ? countEi.split(" ")[1] : '';

    var price = priceNode == undefined ? '0' : priceNode.innerText;

    prepareTextBoxsToEdit(name, count[0], ei, price, id);
}

function prepareTextBoxsToEdit(name, count, ei, price) {
    $('.editHeader').removeClass('hide');
    $('#cancelEdit').removeClass('hide');
    $('#editSave').removeClass('hide');
    $('#itemAdd').addClass('hide');

    $('#itemName').val(name);
    $('#count').val(count);
    $('#ei').val(ei);
    $('#ei').trigger('change')

    $('#price').val(price);
    $('#itemName').addClass('edit');
    hideFilterBox();
    $('#itemName').show();
}

function editItem() {
    var prevCount = $('.itemPurchasedTbody .selected .tItemCount')[0].innerText.split('/')[1];
    var count = $('#count').val();
    var price = $('#price').val();
    var ei = $('#ei').find(':selected').val();
    if (ei == null || ei == undefined || ei == '') {
        ei = 'null';
    }

    $('.itemPurchasedTbody .selected .tItemName .countEi').val(count + '|' + ei + '|' + price);
    $('.itemPurchasedTbody .selected .tItemCount')[0].innerText = count + ' / ' + prevCount;
    $('.itemPurchasedTbody .selected .tItemPrice')[0].innerText = price;


    console.log($('.itemPurchasedTbody .selected .tItemName .countEi').val());
    console.log($('.itemPurchasedTbody .selected .tItemCount')[0].innerText);
    console.log($('.itemPurchasedTbody .selected .tItemPrice')[0].innerText);
    console.log("ADSSDDASSDAAD");

    resetEditFields();

}

function resetEditFields() {
    $('.editHeader').addClass('hide');
    $('#cancelEdit').addClass('hide');
    $('#editSave').addClass('hide');
    $('#itemAdd').removeClass('hide');

    $('#itemName').val('');
    $('#count').val(0);
    $('#ei option[value=""]').prop('selected', true);
    $('#price').val('1');
    $('#itemName').removeClass('edit');
    showFilterBox();
}

function bindEditingFunc(selector) {
    $(selector).on('click', function () {
        editPurchasedItem();
    })
}

function summ() {

    var a = Number($('#count').val()) *  Number($('#price').val());
    if(isNaN(a)){
        a=0;
    }
    $('.summ')[0].innerText = a;    
}

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

