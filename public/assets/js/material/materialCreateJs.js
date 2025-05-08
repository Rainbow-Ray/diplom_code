import selectChanged from "../material/selectType.js";

$(document).ready(function() {
    $("#cat").select2();
    $("#type").select2();
    $("#ei").select2();
    $("#color").select2();
    $("#country").select2();

    $("#cat").on('change', function() {
      selectChanged();
    });
    selectChanged();
});
