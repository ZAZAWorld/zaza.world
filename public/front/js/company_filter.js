jQuery( document ).ready( function( $ ) {
	var h = $('.ad_filter').css('height');
	document.getElementById('catalogs').style.marginTop = h;

	
	/***** swith filter ******/
	$('.js-switch-filter').click(function(){
		var filter_block = $('.ad_filter');
		var swither = $('.js-switch-filter');
		var h = $('.ad_filter').css('height');
		if (filter_block.hasClass('open')){
			swither.removeClass('c-postmore__icon_up c-postmore__icon');
			swither.addClass('c-postmore__icon');
			filter_block.removeClass('open');
			document.getElementById('catalogs').style.marginTop = '0';
			if(screen.width<1024){
			document.getElementById('front_filter_switch').style.position = 'fixed';
			document.getElementById('front_filter_switch').style.top = '0';
			}
		}
		else {
			swither.removeClass('c-postmore__icon_up c-postmore__icon');
			swither.addClass('c-postmore__icon_up');
			filter_block.addClass('open');
			document.getElementById('catalogs').style.marginTop = h;
			if(screen.width<1024) {
			document.getElementById('front_filter_switch').style.position = 'absolute';
			document.getElementById('front_filter_switch').style.top = '45px';
				}	
		}
	});
	
	
});