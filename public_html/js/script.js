$(document).ready(function(){
    // $("nav").on("click","a", function (event) {
    //     event.preventDefault();
    //     var id  = $(this).attr('href'),
    //         top = $(id).offset().top;
    //     $('body,html').animate({scrollTop: top}, 800);
    // });


    $("#menu").on("click", function (event) {
        event.preventDefault();
        $("nav").toggle(400);

    })


});

