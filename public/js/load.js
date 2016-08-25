$(document).ready(function(){

    $(".lazyLoad").waypoint(function(){
        $(this).addClass("show");
    },{offset:'90%'});
});