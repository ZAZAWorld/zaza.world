jQuery( document ).ready( function( $ ) {
	$('.mess_footer__button').click(function(){
		var parent = $(this).parent().parent();
		parent.remove();
	});
});