jQuery( document ).ready( function( $ ) {
    var currentBar = '.bar-adv';
	var open_bar = false;
	
	if ($('.js-default-company-bar').length > 0)
		currentBar = '.bar-com';
		
    function openBar () {
        if ($('.menu-bar').hasClass( "open" )) {
            $('.menu-bar').removeClass( "open" );
            $('body').removeClass( "modal_open" );
            $(currentBar).removeClass( "open" );
            $('.wrapper').removeClass( "total_blur" );
			open_bar = false;
        }
        else {
            $('.menu-bar').addClass( "open" );
            $('body').addClass( "modal_open" );
            $(currentBar).addClass( "open" );
            $('.wrapper').addClass( "total_blur" );
			if ($('.map-block').hasClass('open')) {
				$('.map-block').removeClass('open');
				$('.js-open-maps').removeClass('open');
				$('.inquiry').removeClass('hide');
				$('.watchs').removeClass('hide');
				$('.adverts').removeClass('hide');
				$('.radio').removeClass('hide');
				$('.js_right_block_bg').remove();
			}
			
			open_bar = true;
        }
    }
	
	var open_menu_bar = true;
	
	
	$('.menu-bar').click(function(){
		openBar();
	});
	
	
	var wrapper_click = true;
	$( ".wrapper" ).click(function(){
		if (open_bar && wrapper_click){
			openBar();
		}
		
		wrapper_click = true;
		return true;
	});
	


    /**** advert bar functions *****/
	function openAdvBarCatalog (id) {
        var el = $( ".bar-adv .bar__li_title [data-id='"+id+"']" );
        if (el.hasClass( "icon-plus" )) {
            el.removeClass( "icon-plus" );
            el.addClass( "icon-minus" );

            $( ".bar-adv .bar__li_open.icon-minus[data-id!='"+id+"']" ).each(function( index ) {
                var id = $(this).data('id');
                openAdvBarCatalog(id);
            });

            $('#adv-cat-'+id+' .bar__sub__ul').show();
        }
        else {
            el.addClass( "icon-plus" );
            el.removeClass( "icon-minus" );
            $('#adv-cat-'+id+' .bar__sub__ul').hide();
        }
    }
	
	$('.bar-adv .bar__li_title').click(function() {
        var id = $(this).data('id');
        openAdvBarCatalog(id);
    });
	
    $('.m-advert-bar__link').click(function () {
        if ($('.wrapper').hasClass( "total_blur" ))
            return true;
			
        currentBar = '.bar-adv';
        openBar();

        var id = $(this).data('id');
        openAdvBarCatalog(id);
		
		wrapper_click = false;
    });
	
	
	

    /****** company bar funcitons *******/
    function openComBarCatalog (id) {
        var el = $( ".bar-com .bar__li_title [data-id='"+id+"']" );
        if (el.hasClass( "icon-plus" )) {
            el.removeClass( "icon-plus" );
            el.addClass( "icon-minus" );

            $( ".bar-com .bar__li_open.icon-minus[data-id!='"+id+"']" ).each(function( index ) {
                var id = $(this).data('id');
                openComBarCatalog(id);
            });

            $('#com-cat-'+id+' .bar__sub__ul').show();
        }
        else {
            el.addClass( "icon-plus" );
            el.removeClass( "icon-minus" );
            $('#com-cat-'+id+' .bar__sub__ul').hide();
        }
    }

    $('.bar-com .bar__li_title').click(function() {
        var id = $(this).data('id');
        openComBarCatalog(id);
    });
	
    $('.js-open-company-bar').click(function () {
        if ($('.wrapper').hasClass( "total_blur" ))
            return true;

        currentBar = '.bar-com';
        openBar();

        var id = $(this).data('id');
        openComBarCatalog(id);
		
		wrapper_click = false;
    });

});
