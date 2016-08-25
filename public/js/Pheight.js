function Pheight(){

    var ArrP = new Array;
    $("#focusItem li").each(function(){
        var s = $("#focusItem li").height();
        ArrP.push(s);
    });

    m = Math.max.apply(null, ArrP);

    var w = $(window).width();

    if ( w > 768) {
        $("#focusItem li").css("height",m+100);
    }

}


$(window).load(function(){

    Pheight();

});