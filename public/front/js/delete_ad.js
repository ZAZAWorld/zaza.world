jQuery( document ).ready( function( $ ) {
	$('.js_advert_delete_link').click(function(){
		/*
		var advert = $(this).closest();
		var el = $(this);
		var advert_id = $(this).data('id');
		console.log('advert_id ' + advert_id);
		$.post("/ad/delete", { advert_id: advert_id} ).done(function( data ) {
			console.log('data ' + data);
			if (data == '1' || data == 1)
				$(".advert[data-id='" + advert_id +"']").parent().remove();
		});
		*/
		var advert_id = $(this).data('id');
		$('.delete_ad_block_button_ok').data('id', advert_id);
		if (!$('.delete_ad_block').hasClass('active'))
			$('.delete_ad_block').addClass('active');
	});
	
	$('.delete_ad_block_button_ok').click(function(){
		var advert_id = $(this).data('id');
		$.post("/ad/delete", { advert_id: advert_id} ).done(function( data ) {
			if (data == '1' || data == 1)
				$(".advert[data-id='" + advert_id +"']").parent().remove();
			$('.delete_ad_block').removeClass('active');
		});
	});
	
	$('.delete_ad_block_button_no').click(function(){
		$('.delete_ad_block').removeClass('active');
	});
});