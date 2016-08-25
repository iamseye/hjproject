function imgHeight(){

    var w = $("#photoList li").width();

    $("#photoList li").css("height",w);

}


$(window).load(function(){

    imgHeight();

});

$(window).resize(function(){

    imgHeight();

});