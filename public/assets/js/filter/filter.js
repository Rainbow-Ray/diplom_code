class ApiClient {
    static async fetchItems(apiUrl, filters = {}) {
        const url = `/api/${apiUrl}/filter?${new URLSearchParams({ ...filters })}`;
        const response = await fetch(url);
        return await response.json();
    }
}

function setHeader(text){
    $('.mainHeader h1').text(text);
}


function jsonToHtml(json) {
    var string = json;
    string = string.replaceAll(/\\'|\\"/g, '"');
    string = string.replaceAll(/\\r\\n|\\r|\\n/g, "");
    string = string.replaceAll(/^"/g, "");
    string = string.replaceAll(/"$/g, "");    
    return string;

    

}


function orders(filter, header) {
    var resp = ApiClient.fetchItems('order', { filter: filter });

    resp.then(function (json) {
        $('main .card').remove();

        for (var k in json) {
            card = jsonToHtml(json[k]);
            $('main').append(card);
        }
    });

                    setHeader(header);

}

function receipts(filter, header) {
    var resp = ApiClient.fetchItems('receipt', { filter: filter });

    resp.then(function (json) {
        $('main .card').remove();

        for (var k in json) {
            card = jsonToHtml(json[k]);
            $('main').append(card);
        }
    });
    setHeader(header);

}

function incomes(filter, dateS,dateEn , header) {
    var resp = ApiClient.fetchItems('income', {filter: filter, dateStart: dateS, dateEnd: dateEn });

    resp.then(function (json) {
        $('main .card').remove();

        for (var k in json) {
            card = jsonToHtml(json[k]);
            $('main').append(card);
        }
    });
    setHeader(header);

}

function expense(filter, dateS,dateEn , header) {
    var resp = ApiClient.fetchItems('expense', {filter: filter, dateStart: dateS, dateEnd: dateEn });

    resp.then(function (json) {
        $('main .card').remove();

        for (var k in json) {
            card = jsonToHtml(json[k]);
            $('main').append(card);
        }
    });
    setHeader(header);

}
function matExp(filter, dateS,dateEn , header) {
    var resp = ApiClient.fetchItems('materialExp', {filter: filter, dateStart: dateS, dateEnd: dateEn });

    resp.then(function (json) {
        $('main .card').remove();

        for (var k in json) {
            card = jsonToHtml(json[k]);
            $('main').append(card);
        }
    });
    setHeader(header);

}








