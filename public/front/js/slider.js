jQuery( document ).ready( function( $ ) {
    var slid_count = getSlideCount();

    function getSlideCount() {
        return $('.catalogs__vip:first').children('.ad-vip-block').length;
    }

    var slideOpen = canWorkSliders();

    function canWorkSliders () {
        if ($(window).width() >= '1170' && slid_count < 9)
            return false;

        if ($(window).width() < '1170' && $(window).width() >= '992' && slid_count < 6)
            return false;

        if ($(window).width() < '992' && $(window).width() >= '750'  && slid_count < 4)
            return false;

        if ($(window).width() < '750' && slid_count < 3)
            return false;

        return true;
    }

    function slideVip (direction = "left") {
        if (slideOpen == false)
            return false;

        $.each( $('.catalogs__vip'), function( k, v ){
            if (direction == "left") {
                $(this).children('.copy').removeClass('copy');

                var first_el = $(this).children(".ad-vip-block:first");

                first_el.removeClass('ad-vip-block');
                first_el.addClass('close-to-left');
                first_el.clone(true, true).removeClass('close-to-left').addClass('ad-vip-block').addClass('copy').appendTo($(this));

                if ($(this).children('.close-to-left').length > 1) {
                    var first_hidden = $(this).children('.close-to-left:first');
                    first_hidden.remove();
                }
            } else {
                $(this).children('.copy').remove();

                var last_el = $(this).children(".ad-vip-block:last");
                last_el.clone(true, true).removeClass('ad-vip-block').addClass('close-to-left').prependTo($(this));



                if ($(this).children('.close-to-left').length > 1) {
                    var last_hidden = $(this).children(".close-to-left:last");
                    last_hidden.addClass('ad-vip-block');
                    last_hidden.removeClass('close-to-left');

                    last_el.remove();
                }
            }
        });
    }

    if (slideOpen) {
        setInterval(function() {
            slideVip();
        }, 6000);

        $(".catalogs__vip__before").click(function () {
            slideVip('right');
        });

        $('.catalogs__vip__after').click(function () {
            slideVip();
        });
    }
    else {
        $(".catalogs__vip__before").hide();
        $(".catalogs__vip__after").hide();
    }



});
