$( document ).ready(function() {
    
    $('.js-about-control').on('click', function(evt) {
        
        evt.preventDefault();
       
        var unitIn = $(this).data('slider-in'),
            unitOut = $(this).data('slider-out');

        $('#' + unitOut).fadeOut('normal', function() {
            $('#' + unitIn).fadeIn();
        });
    })

    'use strict';
    if ($(this).scrollTop() > 1){
        $('header').addClass("sticky");
    }
    else if($('header').hasClass('home')){
        $('header').removeClass("sticky");
    }

    $('#horizontal-list li').on('click', function () {

        var id = $(this).attr('data-index');
        $(".video-slide").not('#video-slide' + id).animate({
            top: "600px"
        }, 500);
        $('#video-slide' + id).animate({
            top: 0
        }, 500);
        $('#horizontal-list li').removeClass("active");
        $(this).addClass("active");
        $('#youtube-player').html('');
        $('#youtube-player').hide();
        $("#thumb_container").animate({
            top: "562px"
        }, 200);
        $("#thumb_container ul#horizontal-list li").animate({
            width: "76px",
            height: "76px"
        }, 200);
        $("#thumb_container ul#horizontal-list li img").animate({
            width: "72px",
            height: "72px"
        }, 200);
    });

});

function show_video(id) {

    $("#thumb_container").animate({
        top: "622px"
    }, 200);
    $("#thumb_container ul#horizontal-list li").animate({
        width: "56px",
        height: "56px"
    }, 200);
    $("#thumb_container ul#horizontal-list li img").animate({
        width: "52px",
        height: "52px"
    }, 200);
    $('#youtube-player').html('<iframe width="100%" height="600" src="https://www.youtube.com/embed/' + id + '?autoplay=1" frameborder="0"></iframe> <div class="close_btn" onclick="close_video();">X</div>');
    $('#youtube-player').show();
}

function close_video() {
    $('#youtube-player').html('');
    $('#youtube-player').hide();
    $("#thumb_container").animate({
        top: "562px"
    }, 200);
    $("#thumb_container ul#horizontal-list li").animate({
        width: "76px",
        height: "76px"
    }, 200);
    $("#thumb_container ul#horizontal-list li img").animate({
        width: "72px",
        height: "72px"
    }, 200);

}