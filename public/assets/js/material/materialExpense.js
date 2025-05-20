import selectChanged from "../material/selectType.js";
import { HighlightElement, HighlightConcreteElement } from "../tableRowSelect/rowSelect.js";

class item {
    id;
    name;
    count;
    ei;


    constructor(id, name, count, ei) {
        this.id = id;
        this.name = name;
        this.count = count;
        this.ei = ei;
    }

    getItems(){
        var trs = $('#itemTable').children();
        trs.forEach(element => {
            var id = $(element).find('input').first().val();
            var count = $(element).find('input').last().val();
            var name = $(element).find('td')[1].innerText;
            var ei = $(element).find('td')[2].innerText;

            var i = new item(id, name,  count, ei);
            this.items.push(i);
        });
    }


    toRow() {
        return `
        <tr>
        <td>
            <input type='text' class='item hide' name='items[].Key' id=`+ this.id + ` value=` + this.id + `>
            <input type='text' class='hide' name='items[].Value' value=`+ this.count + `>
            `+ this.name + `
        </td>
        <td>
`+ this.count + `
        </td>
        <td>
        `+ this.ei + `
        </td>
        </tr>
        `;
    }
}

class ItemStore {
    items = Array();

    addItem(item) {
        if (!this.isAdded(item.id)) {
            this.items.push(item);
            return true;
        }
        return false
    }

    isAdded(id) {
        return this.items.some(e => e.id === id)
    }
    ind(idn) {
        return this.items.find(({ id }) => id === idn)
    }

    delete(id) {
        const index = this.items.indexOf(this.ind(id));
        this.items.splice(index, 1);
    }

}


function addItem(itemStore) {

    clearErrors();

    var name = $('#mat :selected')[0].label;
    var id = $('#mat :selected').first().val();
    var count = $('#amount').val();
    var ei = $('#mat :selected').attr('ei');

    var it = new item(id, name, count, ei);

    var isAdded = itemStore.addItem(it);

    if (isAdded) {
        var a = it.toRow();
        console.log(ei);

        $('#itemTable').append(it.toRow());
        HighlightConcreteElement($('#itemTable :last-child'));
    }
    else {
        errorShow('Материал уже добавлен');
    }
}

function deleteItem(itemStore) {
    clearErrors();
    console.log(itemStore);

    var id = $('#itemTable .selected').find('.item').first().val();
    itemStore.delete(id);
    $('#itemTable .selected').remove();

    console.log(itemStore);

}

function errorShow(message) {
    $('#error').removeClass('hide');

    $('#error').text(message);
}
function clearErrors(message) {
    $('#error').text('');
    $('#error').addClass('hide');
}

function setEi(ei) {
    $('#ei').text(ei);
}

function selectMat() {
    var ei = $('#mat :selected').attr('ei');
    setEi(ei);
}

$(document).ready(function () {
    var itemStore = new ItemStore();

    $("#cat").select2();
    $("#type").select2();
    $("#mat").select2();

    $("#cat").on('change', function () {
        selectChanged();
        var cat_id = $("#cat").find(':selected').val();

        get_materials(cat_id)

    });


    $("#type").on('change', function () {
        var cat_id = $("#cat").find(':selected').val();
        var type_id = $("#type").find(':selected').val();

        get_materials(cat_id, type_id)
    });

    $('#addItem').on('click', function () {
        addItem(itemStore);
    });

    $('#deleteItem').on('click', function () {
        deleteItem(itemStore);
    });



    $('#mat').on('change', function () {
        selectMat();
    });
    $('#mat').trigger('change');


    HighlightElement('itemTable');

    selectChanged();
});

class ApiClient {
    static async fetchItems(item_type, filters = {}) {
        const url = `/api/materials?${new URLSearchParams({ item_type, ...filters })}`;
        const response = await fetch(url);
        return await response.json();
    }
}

function get_materials(cat_id) {
    var resp = ApiClient.fetchItems('material', { cat: cat_id, type: null });

    resp.then(function (json) {
        updateMatSelect(json)
    });
}

function updateMatSelect(json) {
    console.log(json);

    $("#mat").empty();
    json.forEach(element => {
        console.log('ass');

        appendOption('#mat', element);
    });
}

function appendOption(select_id, element) {
    $(select_id).append(
        '<option value="' +
        element['id'] +
        '">' +
        element["name"] + ' </option>'
    );
}