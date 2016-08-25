function service(){

    $(".serviceList li").click(function(){
        $(this).parent().children("li").removeClass("this");
        $(this).addClass("this");
        var index = $(this).parent().children("li").index(this),
            parent = $(this).parent().parent(),
        	page = $(parent).children(".serviceContent").children(".serviceText").eq(index);
            
        $(parent).children(".serviceContent").children(".serviceText").css("display","none");
        $(page).fadeIn(200);
    });

    $(".serviceList").each(function(){
        var s = $(this).children("li").size();
        $(this).children("li").css("width",100/s+"%");
    });


}


$(window).load(function(){

    service();

});