/*
 * All Files are owned by API-Studio. It is forbidden to use,  
 * distrubute or anything else without permission of the 
 * owner. CEO Daniel Pfeil <dp@api-studio.de>
 * Copyright (c) 2015-2017.
 */

$(document).ready(function () {
    $(".listProducts .product").click(function (event) {
        $(this).toggleClass("selected");
        if($(this).find("input").val() == 0){
            $(this).find("input").val(1);
        } else {
            $(this).find("input").val(0);
        }
    });
});