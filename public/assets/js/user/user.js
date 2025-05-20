import {HighlightElement} from "../tableRowSelect/rowSelect.js";


function addRole(element){
    var roleId = $('#role option:selected').val();
    var roleName = $('#role option:selected').text();
    
    if($('#role'+roleId).length == 0){
        $(".roles").append(
    "<tr><td  id='role"+ roleId +"' value='"+ roleId +"'>"+roleName +"</td>"
    + "<td class='hide'> <input type='text' name='role[]' value='"+ roleId +"' readonly/> </tr>"

);

    }
}

function deleteRole(){
    if($(".selected").length < 1){
    }
    else{
        $(".selected").remove();
    }
}


$(document).ready(function () {
            $('#worker').select2();
            $('#role').select2();
    HighlightElement("roles");

    $(".addRole").on('click', function(e){
         addRole(e);
         HighlightElement("roles");

     }
 );

 $('.deleteRole').on('click', function(){
    deleteRole();


 });


 });
