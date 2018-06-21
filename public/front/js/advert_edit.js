jQuery( document ).ready(function( $ ) {
	/************ call dialog advert edit *************/
    $( ".body " ).on( "click",'.js-call-dialog-edit-ad', function() {
        var id = $(this).data('id');
        $.post("/ad/update-dialog", { advert_id: id, is_personal_cabinet: 1} ).done(function( data ) {
            if(data == '' || data == '0')
                return false;
            $('.wrapper').addClass( "total_blur" );
            $('body').addClass( "modal_open" );

            $( ".add_ad_modal" ).html( data);
            $('.add_ad_modal').addClass('open');
        });
    });

    $( ".body " ).on( "click",'.raise_in_top', function() {
        var id = $(this).data('id');
        $.post("/ad/update-dialog", { advert_id: id, is_personal_cabinet: 1} ).done(function( data ) {
            if(data == '' || data == '0')
                return false;

            $('.wrapper').addClass( "total_blur" );
            $('body').addClass( "modal_open" );

            $( ".add_ad_modal" ).html( data);
            $('.save_edit_step').toggle();
            $('.first_edit_step').toggle();
            $('.add_ad_modal').addClass('open');

            /* $('.add_ad_modal').remove();
             $( ".body" ).hide();
             $( ".body" ).append( data);
             $('.js-edit_ad_step').click();
             $( ".body" ).show();*/

        });
    });

    $( ".body " ).on( "click",'.js-edit_ad_step', function() {
        var step = $(this).attr('data-step');

        $('.save_edit_step').toggle();
        $('.first_edit_step').toggle();
    });
    /************ close dialog advert edit *******************/
	$( ".body " ).on( "click",'.ad_dialog_edit__close', function() {
		$('.ad_dialog_edit').remove();
	});
	$( ".body " ).on( "click",'.ad_dialog_edit__cancel', function() {
		$('.ad_dialog_edit').remove();
	});
	/*************** function for upload dialog blog update photo **************/
	$( ".body " ).on( "click",'.ad_dialog_edit_photo__square-add', function() {
		$('.ad_dialog_edit_photo__file').click();
	});
	var total_advert_photo_count = 21 - $('.ad_dialog_edit_photo__square').length;
	$( ".body " ).on( "change",'.ad_dialog_edit_photo__file', function() {
		if (total_advert_photo_count == 0){
			alert('Max 20 youtube link');
			return false;
		}
		total_advert_photo_count = total_advert_photo_count - 1;
		
		var file = $(this);
        var formData = new FormData();
        formData.append( 'image', $(this)[0].files[0] );
        $.ajax({
            url: "/company/image",
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                if (data!='0' && data!='1') {
					var text = '<div class="ad_dialog_edit_photo__square">'
									+'<img src="'+data+'" class="ad_dialog_edit_photo__image">'
									+'<input type="hidden" name="ar_img[]" value="'+data+'">'
									+'<span class="ad_dialog_edit_photo__del_link">x</span>'
								+'</div>';
					$('.ad_dialog_edit_photo__list').append(text);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
	});
	/************* function for delete photo in dialog ************/
	$( ".body " ).on( "click",'.ad_dialog_edit_photo__del_link', function() {
		var parent = $(this).parent();
		parent.remove();
	});
	/************ getModel by Brand **********/
	$( ".body " ).on( "click",'#auto_brand_id', function() {
		var id = $(this).val();

		if (id > 0) {
			$.post("/ad/car-model", { id: id} ).done(function( data ) {
				data = JSON.parse(data);
				$('#auto_model_id').empty();
				$('#auto_model_id').append('<option>Model</option>');

				$.each(data, function( index, value){
					$('#auto_model_id').append('<option value="'+index+'">'+value+'</option>');
				});
			});
		}
	});
	/********* upload resume *****************/
	$( ".body" ).on( "change",'.edit_ad_resume_file', function() {
        var file = $(this);
        //var form_close = file.closest( ".upload_logo" );
        var formData = new FormData();
        formData.append( 'image', $(this)[0].files[0] );
        //var formData = new FormData(form_close[0]);
        $.ajax({
            url: "/company/image",
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                if (data!='0' && data!='1') {
                    $('.edit_ad_resume_value').val(data);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});