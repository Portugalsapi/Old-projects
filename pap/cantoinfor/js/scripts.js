/*!
* Start Bootstrap - Shop Homepage v4.3.0 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

$('input[type="radio"]').click(function(){
        if($(this).attr("value")=="ABC"){
            $(".div1").show('slow') && $(".div2").hide('slow');
        }
        if($(this).attr("value")=="DEF"){
            $(".div2").show('slow') && $(".div1").hide('slow');

        }        
    });
$('input[type="radio"]').trigger('click');