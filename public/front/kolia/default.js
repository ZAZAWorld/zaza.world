$(document).ready(function() {
    $('.js-slider').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
		autoplay: true,
        nextArrow: '<button type="button" class="slick-next"></button>',
        prevArrow: '<button type="button" class="slick-prev"></button>',
    });
    $('.js-c-ads-top').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        nextArrow: '<button type="button" class="slick-next--red"></button>',
        prevArrow: '<button type="button" class="slick-prev--red"></button>',
        responsive: [
            {
                breakpoint: 990,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 568,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 368,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $('.js-showall').click(function(e){
            $('.js-contacts').toggleClass('open');
            e.preventDefault();
    });
});
(function($){
    $(window).load(function(){
        $(".js-reviews-scroll").mCustomScrollbar({
            theme:"dark-thick"
        });
        $(".js-custom-scroll").mCustomScrollbar({
            scrollButtons:{enable:true},
            theme:"light-thick",
            scrollbarPosition:"outside"
        });
    });
})(jQuery);

  
  	$(document).ready(function(){
	
		$('div.tabs a').click(function(){
			var tab_id = $(this).attr('data-tab');

			$('div.tabs a').removeClass('current');
			$('.tab-content').removeClass('current');

			$(this).addClass('current');
			$("#"+tab_id).addClass('current');
		})
	})
	
	