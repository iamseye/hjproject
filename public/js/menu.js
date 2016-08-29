function menu(){
    for (var i = 0; i < $("#mainMenu li").size(); i++ )
    {
        var $this = $("#mainMenu a").eq(i);
        $this.children("li").css("background-image","url('/images/menu_0"+i+"_c.png')");
        $this.children("li.this").css("background-image","url('/images/menu_0"+i+"_h.png')");
        $this.children("li").css("background-size","cover");

        preload = new Image();
        preload.src = "/images/menu_0"+i+"_h.png";
    }

    $("#mainMenu a").hover(function(){
        var s = $("#mainMenu a").index(this),
            $this = $(this);

        $this.children("li").css("background-image","url('/images/menu_0"+s+"_h.png')");
    },function(){
        var s = $("#mainMenu a").index(this),
            $this = $(this);

        $this.children("li").css("background-image","url('/images/menu_0"+s+"_c.png')");
        $this.children("li.this").css("background-image","url('/images/menu_0"+s+"_h.png')");
    });
}

$(document).ready(function(){

   menu();

});