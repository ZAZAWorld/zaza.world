jQuery( document ).ready( function( $ ) {
	
	$('.js-open-inquiry').click(function(){
		if ($('.inquiry_block').hasClass('active')){
			$('.inquiry_block').removeClass('active');
			$('.js_right_block_bg').remove();
		}
		else {
			$('.inquiry_block').addClass('active');
			$('.body').append('<div style="width: 100%;  position: fixed; height: 100%; z-index: 990; top: 0;" class="js_right_block_bg"></div><span class="close-inquiry-mobile"></span>');
		}
		
		if ($('.js-right-buttons.open:not(".js-open-inquiry")'))
			$('.js-right-buttons.open:not(".js-open-inquiry")').click();
		
		if ($(this).hasClass('open'))
			$(this).removeClass('open');
		else 
			$(this).addClass('open');
	});

    $( ".body" ).on( "click",'.close-inquiry-mobile', function() {
        if ($('.inquiry_block').hasClass('active'))
            $('.close-inquiry-mobile').remove();
            $('.js-open-inquiry').click();
    });

	$( ".body" ).on( "click",'.js_right_block_bg', function() {
		if ($('.inquiry_block').hasClass('active'))
			$('.js-open-inquiry').click();
		
		if ($('.last_ad_block').hasClass('active'))
			$('.js-open-las-ad').click();
		
		if ($('.radio_block').hasClass('active'))
			$('.js_open_radio').click();
		
		if ($('.js-open-maps').hasClass('open'))
			$('.js-open-maps').click();
		
		if ($('.js-open-main-chat').hasClass('open'))
			$('.js-open-main-chat').click();
	});
	
	
	
	$('.inquiry_item__button_icon_img').click(function(){
		var parent = $(this).parent().parent().parent();
		var toggle = parent.find('.inquiry_item__toggle');
		if (toggle.hasClass('open')){
			toggle.removeClass('open');
			$(this).removeClass('open');
		}
		else {
			toggle.addClass('open');
			$(this).addClass('open');
		}
	});
	
	$('#inquery_cat_id').hide();
	$('#inquery_type_id').change(function(){
		var val = parseInt($(this).val());
		if (val == 9999){
			$('#inquery_cat_id').hide();
		}
		else {
			$('#inquery_cat_id').show();
			$.post("/company/get/cat", { id: val} ).done(function( data ) {
				data = JSON.parse(data);
				$('#inquery_cat_id').empty();
				$('#inquery_cat_id').append('<option></option>');
				
				var i = 0;
				$.each(data, function( index, value){
					$('#inquery_cat_id').append('<option value="'+index+'">'+value+'</option>');
				});
			});
		}
	});
	
	/*************** max 500 symbols in about **************/
	$( ".inquiry__input" ).keypress(function(e) {
        if (e.which < 0x20) {
            // e.which < 0x20, then it's not a printable character
            // e.which === 0 - Not a character
            return;     // Do nothing
        }
        if (this.value.length == 120) {
			alert('Max 120 symbols');
			e.preventDefault();
        } else if (this.value.length > 120) {
            // Maximum exceeded
            this.value = this.value.substring(0, max);
        }
    });
});