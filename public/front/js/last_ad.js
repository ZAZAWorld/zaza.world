jQuery( document ).ready( function( $ ) {
	
	$('.js-open-las-ad').click(function(){
		if ($('.last_ad_block').hasClass('active')){
			$('.last_ad_block').removeClass('active');
			$('.js_right_block_bg').remove();
		}
		else {
			$('.body').append('<div style="width: 100%;  position: absolute; height: 4000px; z-index: 990; top: 0;" class="js_right_block_bg"></div>');
			$('.last_ad_block').addClass('active');
		}
		
		if ($('.js-right-buttons.open:not(".js-open-las-ad")'))
			$('.js-right-buttons.open:not(".js-open-las-ad")').click();
			
		if ($(this).hasClass('open'))
			$(this).removeClass('open');
		else 
			$(this).addClass('open');
	});
	
	$('.last_ad_item__button_icon_img').click(function(){
		var parent = $(this).parent().parent().parent();
		var toggle = parent.find('.last_ad_item__toggle');
		if (toggle.hasClass('open')){
			toggle.removeClass('open');
			$(this).removeClass('open');
		}
		else {
			toggle.addClass('open');
			$(this).addClass('open');
		}
	});
});