jQuery( document ).ready( function( $ ) {

	/************ swith company tabs functions **************/
	$('.js-tab-simple-company').hide();
	$('.js-tab-simple-company-1').show();
	
	$('.js-open-tab-simple-company').click(function(){
		$('.js-open-tab-simple-company').removeClass('active');
		$(this).addClass('active');
		
		var tab = $(this).data('tab');
		$('.js-tab-simple-company').hide();
		$('.'+tab).show();
	});
});