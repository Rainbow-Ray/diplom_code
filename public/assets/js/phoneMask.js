$(document).ready(function () {
       var element = document.getElementById('phone');
       var maskOptions = {
           mask: '8(000)000-00-00',
           lazy: false
       } 
       var mask = new IMask(element, maskOptions);
    });
    