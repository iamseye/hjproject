function slide(){

    $("#insideSelect li").click(function(){
        var index = $("#insideSelect li").index(this),
            slide = $(".insideText").eq(index);
        $('html,body').animate({scrollTop:$(slide).offset().top},650);
    });

    $("#goTop").click(function(){
        $('html,body').animate({scrollTop:$("#insideSelect").offset().top},650);
    });

}


$(window).load(function(){

    slide();

});