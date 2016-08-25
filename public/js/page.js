function page(){

    $("#insideSelect li").click(function(){
        var index = $("#insideSelect li").index(this),
        	page = $(".page").eq(index);
            
        $(".page").css("display","none");
        $(page).fadeIn(200);
    });

    $("#goTop").click(function(){
        $('html,body').animate({scrollTop:$("#insideSelect").offset().top},650);
    });

}


$(window).load(function(){

    page();

});