export default function selectChanged() {
    var cat_id = $("#cat").find(':selected').val();
    get_types(cat_id)
}

function get_types(cat_id) {
    fetch("http://127.0.0.1:8000/api/types/"+cat_id).then(function(response) {
        response.json().then(function(json) {
            $("#type").empty();
            json.forEach(element => {
              appendOption(element);
            });
        });
    });
}

function appendOption(element) {
    $("#type").append(
        '<option value="' +
        element['id'] +
        '">' +
        element["name"] + ' </option>'
    );
}

