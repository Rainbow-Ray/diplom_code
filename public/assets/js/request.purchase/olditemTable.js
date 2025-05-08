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
    item_id;
    name;
    count;
    ei;
    value;
    price;
    prefId;
    // constructor(prefix, id, name, count, ei, price) {
    //     this.id = id;
    //     this.prefix = prefix;
    //     this.name = name;
    //     this.count = count;
    //     this.ei = ei;
    //     this.price = price;
    //     this.prefId = prefix + id;
    //     if(prefix == types.M || prefix == types.F  ){
    //         this.value = this.prefix + this.id;
    //     }
    //     else{
    //         this.value = this.prefix + this.name;
    //     }
    // }
    constructor(prefix, id) {
        this.id = prefix+id;
    }

    /**
     * 
     */
    printCountEiPrice() {
        if(this.ei=='' || this.ei==undefined || this.ei==null){
            ei = 'null';
        }
        if(this.price != undefined){
            return this.count+'|'+this.ei + '|'+ this.price;
        }
        return this.count+'|'+this.ei;
    }

    formatRow(){
        return 
    }
}

var items = Array();


function appendSearchItem(element) {
    $(".searchItemsTbody").append(
        '<tr><td><input type="radio" name="material" class="hide check" id="' + element['id'] + '">' +
        element['name'] + '</td> </tr>'
    );
}

function appendItem(json){
    var selector = '.itemTbody';
    if(json['price']=='' || json['price']==null){
        selector = '.itemTbody';
    }
    else{
        selector = '.itemPurchasedTbody';
    }
    console.log(selector);
    console.log(json);
    
    $(selector).append(
            `<tr>
            <td>
            <input type='text' name='itemCheck[].Key'
            class='hide check `+ json['frontPrefId'] +`' 
            id='item`+ json['frontPrefId'] +`' 
            value='` + json['frontValue'] + `' readonly>
            <input type='text' name='itemCheck[].Value' 
            class='hide `+ json['frontPrefId'] +`' 
            value='`+ json['itemQuantity']+`'>
            `+ json['name'] + `</td>
            <td> `+ json['count'] + `</td>
            <td> `+ json['eiName']  + `</td>
            </tr>`
    );
}

function addItem() {
    var count = $('#count').val();
    var ei = $('#ei').find(':selected').val();
    var type = $('.itemType:checked').val(); 
    var prefix =prefixes[type];
    var are_adding = false;

    var it = new item();

    if ($('#name').val() == '' || $('#name').val() == undefined) {
        var selected_item = '.searchItemsTbody > .selected';
        var id = $(selected_item).find(".check").attr('id');
        var name = $(selected_item).text();
        it = new item(prefix, id);
        if (id != undefined && !isAdded(prefix+id)) {
            items.push(it);
            are_adding = true;
        }
    }
    else {
        var id = itemID;
        var name = $('#name').val();
        $('#name').val('');
        itemID += 1;
        it = new item(prefix, id);
        items.push(it);
        are_adding = true;
    }

    if (are_adding) {
        var data = JSON.stringify({
            name: name,
            id: id,
            count: count,
            ei: ei,
            type: type,
            price: '',
        });

        var resp = ApiClient.addItem(data);

        resp.then(function (json) {
            updateTable(json);  
        });
    

        // fetch("/api/items", {
        //     method: "POST",
        //     body: JSON.stringify({
        //         name: name,
        //         id: id,
        //         count: count,
        //         ei: ei,
        //         type: type,
        //     })
        // }).then( response => response.json())
        //   .then(data => {

        //       updateTable(data); // Обновляем таблицу через JSON, а не HTML
        //   });
    
        // var add = items[arrLen-1];

        // if(!$('#price').length){
        //     $('.itemTbody').append(add.formatRow());
        // }
        // else{
        //     $('.itemPurchasedTbody').append(add.formatRow()); 
        // }
        $('#itemName').val('');
        $('#price').val('');
    }
    HighlightConcreteElement('.itemTbody :last-child');
    HighlightConcreteElement('.itemPurchasedTbody :last-child');
    bindEditingFunc('.itemPurchasedTbody :last-child')
}



function updateSearchedItems(json){
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
    var resp = ApiClient.fetchItems('material', {cat: cat_id, type: type_id});

    resp.then(function (json) {
        updateSearchedItems(json)        
    });

}

function get_equips(type_id) {
    var resp = ApiClient.fetchItems('equip', {type: type_id});
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

function isAdded(id){
    return items.some(e => e.id === id)
}

function updateTable(data){
    appendItem(data);
}

// function addItem() {

//     var count = $('#count').val();
//     var ei = $('#ei').find(':selected').val();
//     var are_adding = false;

//     var it = new item();

//     var arrLen = 0;

//     if ($('#name').val() == '' || $('#name').val() == undefined) {
//         var selected_item = '.searchItemsTbody > .selected';
//         var id = $(selected_item).find(".check").attr('id');
//         var name = $(selected_item).text();

//         if (id != undefined && !isAdded) {
//             if ($('.itemType:checked').val() == 'material' ) {
//                 var prefix = 'M';
//             }
//             else if ($('.itemType:checked').val() == 'equip') {
//                 var prefix = 'F';
//             }
//             it = new item(prefix, id, name, count, ei, '');
//             arrLen = items.push(it);
//             are_adding = true;
//             console.log(items.some(e => e.id === id));
//             console.log(items);
//         }
//     }
//     else {
//         var prefix = 'I';
//         var id = itemID;
//         var name = $('#name').val()
//         $('#name').val('');

//         itemID += 1;
//         it = new item(prefix, id, name, count, ei, '');
//         arrLen = items.push(it);
//         are_adding = true;
//     }

//     if (are_adding) {
//         var add = items[arrLen-1];

//         if(!$('#price').length){
//             $('.itemTbody').append(add.formatRow());
//         }
//         else{
//             $('.itemPurchasedTbody').append(add.formatRow()); 
//         }
//         $('#itemName').val('');
//         $('#price').val('');
//     }
//     HighlightConcreteElement('.itemTbody :last-child');
//     HighlightConcreteElement('.itemPurchasedTbody :last-child');
//     bindEditingFunc('.itemPurchasedTbody :last-child')
// }

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

function editPurchasedItem(){
    if(!$('.itemPurchasedTbody .selected .tItemCount').length){
        resetEditFields();
        console.log("FUCCCCCCCCCCCCCCCCCCCCCCK");
        return;
    }

    var nameNode = $('.itemPurchasedTbody .selected .tItemName')[0];
    var id = $('.itemPurchasedTbody .selected .tItemName > input.check').val();
    var countNode = $('.itemPurchasedTbody .selected .tItemCount')[0];
    var countEi = $('.itemPurchasedTbody .selected .tItemName input.countEi').val();
    var priceNode = $('.itemPurchasedTbody .selected .tItemPrice')[0];

    var name = nameNode  == undefined ? '' : nameNode.innerText;
    var countN = countNode  == undefined ? '0' : countNode.innerText;
    var count = countN.split(" ")[0];
    var ei = countEi.length > 2  ?  countEi.split(" ")[1] : '';


    var price = priceNode  == undefined ? '0' : priceNode.innerText;

    console.log(name, count, price);

    prepareTextBoxsToEdit(name,count[0], ei, price, id);

}

function prepareTextBoxsToEdit(name,count, ei, price) {
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

function editItem(){
        var prevCount = $('.itemPurchasedTbody .selected .tItemCount')[0].innerText.split('/')[1];
        var count = $('#count').val();
        var price = $('#price').val();
        var ei = $('#ei').find(':selected').val();
        if(ei==null || ei  == undefined || ei==''){
            ei = ' ';
        }

        console.log(count, price, ei);
        console.log(count + ' / ' +prevCount);
        
        $('.itemPurchasedTbody .selected .tItemName .countEi').val(count+' '+ei+' ' + price);
        $('.itemPurchasedTbody .selected .tItemCount')[0].innerText = count + ' / ' +prevCount;
        $('.itemPurchasedTbody .selected .tItemPrice')[0].innerText = price;


        console.log( $('.itemPurchasedTbody .selected .tItemName .countEi').val());
        console.log( $('.itemPurchasedTbody .selected .tItemCount')[0].innerText);
        console.log( $('.itemPurchasedTbody .selected .tItemPrice')[0].innerText);
        console.log("ADSSDDASSDAAD");
        
        resetEditFields();
    
}

function resetEditFields(){
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

function bindEditingFunc(selector){

    $(selector).on('click', function(){
        editPurchasedItem();
    })
}

var itemID = 1;

$(document).ready(function () {
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

    // $('#filter').on('click', function () {
    //     populateSearchItemTable();
    // });

    $('#itemAdd').on('click', function () {
        addItem();
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





    $('.itemPurchasedTbody tr').on('click', function(){
        editPurchasedItem();
    })
});

// function populateSelect(selectId, json){
//     $(selectId).empty();
//     json.forEach(element => {
//         appendOption(selectId, element);
//     });
// }


    // fetch("http://127.0.0.1:8000/api/materials?" +
    //     new URLSearchParams({
    //         cat: cat_id, type: type_id
    //     }).toString()).then(function (response) {
    //         response.json().then(function (json) {
    //             $(".searchItemsTbody").empty();
    //             $("#searchItem").empty();
    //             json.forEach(element => {
    //                 appendOption('#searchItem', element);
    //                 appendItem(element);
    //             });
    //             selectSearchItem();
    //             HighlightElement("searchItemsTbody");
    //             putInTextBox();
    //         });
    //     });


        // fetch("http://127.0.0.1:8000/api/equips?" +
    //     new URLSearchParams({
            
    //     }).toString()).then(function (response) {
    //         response.json().then(function (json) {
    //             $(".searchItemsTbody").empty();
    //             $("#searchItem").empty();
    //             emptySearchTab();
    //             json.forEach(element => {
    //                 appendOption('#searchItem', element);
    //                 appendItem(element);
    //             });
    //             selectSearchItem();
    //             putInTextBox();
    //             HighlightElement("searchItemsTbody");
    //         });
    //     });




// function addItem() {
//     var count = $('#count').val();
//     var ei = $('#ei').find(':selected').val();
//     var are_adding = false;

//     var it = new item();

//     var arrLen = 0;

//     if ($('#name').val() == '' || $('#name').val() == undefined) {
//         var selected_item = '.searchItemsTbody > .selected';
//         var id = $(selected_item).find(".check").attr('id');
//         var name = $(selected_item).text();

//         if (id != undefined) {
//             // if ($('.itemType:checked').val() == 'material' && !$('#itemM' + id).length) {
//             if ($('.itemType:checked').val() == 'material' && !items.some(e => e.id === id)) {
//                 var prefix = 'M';
//                 var selected_name_or_id = prefix + id;

//                 it = new item(prefix, id, name, count, ei, '');
//                 arrLen = items.push(it);

//                 console.log(items);
                
//                 console.log();
                

//                 are_adding = true;
//             }
//             // else if ($('.itemType:checked').val() == 'equip' && !$('#itemF' + id).length) {
//             else if ($('.itemType:checked').val() == 'equip' && !items.includes(id)) {
//                 var prefix = 'F';
//                 var selected_name_or_id = prefix + id;


//                 it = new item(prefix, id, name, count, ei, '');
//                 arrLen = items.push(it);

//                 are_adding = true;
//             }
//         }
//     }
//     else {
//         var prefix = 'I';
//         var id = itemID;
//         var name = $('#name').val()
//         var selected_name_or_id = prefix + name;

//         $('#name').val('');

//         it = new item(prefix, id, name, count, ei, '');
//         arrLen = items.push(it);

//         itemID += 1;
//         are_adding = true;
//     }
//     if (are_adding && !$('#price').length) {
//         // $('.itemTbody').append(
//         //     `<tr>
//         //     <td><input type='text' name='itemCheck[].Key' class='hide check `+ prefix + id + `' id='item` + prefix + id + `' value='` + selected_name_or_id + `' readonly>
//         //     <input type='text' name='itemCheck[].Value' class='hide I`+ prefix + id + `' value='` + count + ` ` + ei + `'>

//         //     `+ name + `</td>
//         //     <td> `+ count + `</td>
//         //     </tr>`
//         // );
//         // $('#itemName').val('');

//         var add = items[arrLen-1];

//         $('.itemTbody').append(
//             `<tr>
//             <td><input type='text' name='itemCheck[].Key' class='hide check `+ add.value + `' id='item` + prefix + id + `' value='` + add.value + `' readonly>
//             <input type='text' name='itemCheck[].Value' class='hide I`+ add.value + `' value='`+ add.printCountEiPrice()+`'>

//             `+ add.name + `</td>
//             <td> `+ add.count + `</td>
//             </tr>`
//         );
//         $('#itemName').val('');
//     }

//     else if(are_adding && $('#price').length){
//         var price = $('#price').val();
//         if(price == undefined || price == null){
//             price = 0;
//         }
//         if(ei==null || ei  == undefined || ei==''){
//             ei = ' ';
//         }

//         $('.itemPurchasedTbody').append(
//             `<tr>
//             <td><input type='text' name='itemCheck[].Key' class='hide check `+ prefix + id + `' id='item` + prefix + id + `' value='` + selected_name_or_id + `' readonly>
//             <input type='text' name='itemCheck[].Value' class='hide `+ prefix + id + `' value='` + count + ` ` + ei +  ` `+ price + `'>

//             `+ name + `</td>
//             <td> `+ count + `</td>
//             <td> `+ price + `</td>
//             </tr>`
//         );
//         $('#itemName').val('');
//         $('#price').val('');
//     }

//     HighlightConcreteElement('.itemTbody :last-child');
//     HighlightConcreteElement('.itemPurchasedTbody :last-child');
//     bindEditingFunc('.itemPurchasedTbody :last-child')
// }
