import HighlightElement from "../tableRowSelect/rowSelect.js";


function addSkill(element){
    var skillId = $('#skill option:selected').val();
    var skillName = $('#skill option:selected').text();
    console.log(skill);
    
    if($('#skill'+skillId).length == 0){
        $(".skills").append(
    "<tr><td  id='skill"+ skillId +"' value='"+ skillId +"'>"+skillName +"</td>"
    + "<td class='hide'> <input type='text' name='skill[]' value='"+ skillId +"' readonly/> </tr>"
    

);

    }
}

function deleteSkill(){
    if($(".selected").length < 1){
    }
    else{
        $(".selected").remove();
    }
}


$(document).ready(function () {
    $("#job").select2();
    $("#skill").select2();
    HighlightElement("skills");

    $(".addSkill").on('click', function(e){
         addSkill(e);
         HighlightElement("skills");

     }
 );

 $('.deleteSkill').on('click', function(){
    deleteSkill();


 });


 });
