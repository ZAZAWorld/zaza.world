jQuery( document ).ready( function( $ ) {
	/************ update company fields functions ***********/
    function swithHideInput (id, before) {
        var input = $(".form_update_input[data-id='" + id + "']");

        if (!input.hasClass('active')) {
            input.data('before', input.val());
            $( ".form_update_input[data-id='" + id + "']" ).addClass('active');
            $( ".form_update_ok[data-id='" + id + "']" ).removeClass('hide');
            $( ".form_update_cancel[data-id='" + id + "']" ).removeClass('hide');
            $( ".form_update_pencil[data-id='" + id + "']" ).addClass('hide');
        }
        else {
            if (!before)
                input.val(input.data('before'));

            $( ".form_update_input[data-id='" + id + "']" ).removeClass('active');
            $( ".form_update_ok[data-id='" + id + "']" ).addClass('hide');
            $( ".form_update_cancel[data-id='" + id + "']" ).addClass('hide');
            $( ".form_update_pencil[data-id='" + id + "']" ).removeClass('hide');
        }

    }
	// call update company field 
	$( ".body" ).on( "click",'.form_update_pencil', function() {
        var id = $(this).data('id');
        swithHideInput(id, true);
    });
	// call save company field
	$( ".body" ).on( "click",'.form_update_ok', function() {
        var id = $(this).data('id');
        var input = $(".form_update_input[data-id='" + id + "']");
		
        $.post("/company-vip/update", { name: input.data("id"), value: input.val(), type:  input.data("type") } ).done(function( data ) {
			
        });

        swithHideInput(id, true);
    });
	// call cancel company field
	$( ".body" ).on( "click",'.form_update_cancel', function() {
        var id = $(this).data('id');

        swithHideInput(id, false);
    });
	
	/************* upload blog image functions ***************/
	$('.js-form-blog-img').click(function(){
		$('.js-form-blog-file').click();
	});
	$('.js-form-blog-file').change(function(){
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
					$('.js_blog_photo_preview').css('display', 'block');
					$('.js_blog_photo_preview').attr('src', data);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
	});
	
	/**************** get company cat function ***************/
	$( ".body" ).on( "change",'.js-company_type', function() {
		var id = parseInt($(this).val());
		var parent = $(this).parent().parent();
		var cat = parent.find('.js-company_cat');
		var sub_cat = parent.find('.js-company_subcat');
		
		cat.empty();
		sub_cat.empty();
			
		if (!(id > 0) || id == '' || id == undefined)
			return false;
		
		$.post("/company-vip/cat-by-type", { id: id } ).done(function( data ) {
			if (data == '0' || data == undefined || data == 0)
				return false;
				
			data = JSON.parse(data);
			
			cat.append('<option></option>');
			$.each( data, function( key, value ) {
				cat.append( '<option value="' + key + '">' + value + '</option>' );
			});
        });
	});
	/**************** get company sub cat function ***************/
	$( ".body" ).on( "change",'.js-company_cat', function() {
		var id = parseInt($(this).val());
		var parent = $(this).parent().parent();
		var sub_cat = parent.find('.js-company_subcat');
		
		sub_cat.empty();
			
		if (!(id > 0) || id == '' || id == undefined)
			return false;
		
		$.post("/company-vip/subcat-by-cat", { id: id } ).done(function( data ) {
			if (data == '0' || data == undefined || data == 0)
				return false;
			
			data = JSON.parse(data);
			
			sub_cat.append('<option></option>');
			$.each( data, function( key, value ) {
				sub_cat.append( '<option value="' + key + '">' + value + '</option>' );
			});
        });
	});
	/**************** add new company cat function ***************/
	var aksdjdaskladjskla = $('.p_v_c_settings_cat').length;
	$( ".body" ).on( "click",'.js-p_v_c_settings_cat_add', function() {
		if (aksdjdaskladjskla > 3)
			return false;
		
		var text = '';
		text = text + "<div class='p_v_c_settings_cat shadow'>";
		text = text + '<div class="p_v_c_settings_cat_row">';
		text = text + '<span class=\'p_v_c_settings_cat_title\'> Status </span>';
		text = text + '<select class="p_v_c_settings_cat_input js-company_type" required="required" name="type_id[]">'
					+ '<option value="" selected="selected"></option>'
					+ '<option value="2">Service Providers</option>'
					+ '<option value="3">Stores</option>'
					+ '</select>';
		text = text + '</div>';
		text = text + '<div class="p_v_c_settings_cat_row">';
		text = text + '<span class=\'p_v_c_settings_cat_title\'> Category </span>';
		text = text + '<select class="p_v_c_settings_cat_input js-company_cat"  name="cat_id[]"></select>';
		text = text + '</div>';
		text = text + '<div class="p_v_c_settings_cat_row">';
		text = text + '<span class=\'p_v_c_settings_cat_title\'> Subcategory </span>';
		text = text + '<select class="p_v_c_settings_cat_input js-company_subcat"  name="subcat_id[]"></select>';
		text = text + '</div>';
		text = text + '<div class=\'p_v_c_settings_cat_add js-p_v_c_settings_cat_delete\'>-</div>';
		text = text + '</div>';
		
		$('.p_v_c_settings_cats').append(text);
		
		aksdjdaskladjskla = aksdjdaskladjskla+1;
		if (aksdjdaskladjskla >= 3)
			$('.js-p_v_c_settings_cat_add').hide();
	});
	/**************** delete company cat function ***************/
	$( ".body" ).on( "click",'.js-p_v_c_settings_cat_delete', function() { 
		var parent = $(this).parent();
		parent.remove();
		
		aksdjdaskladjskla = aksdjdaskladjskla - 1;
		
		if (aksdjdaskladjskla < 3)
			$('.js-p_v_c_settings_cat_add').show();
	});
	/**************** upload company logo functions ***************/
	$('.js-company_vip_main_photo_call').click(function(){
		$('.js-company_vip_main_photo_file').click();
	});
	$('.js-company_vip_main_photo_file').change(function(){
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
					$('.company_vip_main_photo_squery').html("<img src='"+data+"' class='company_vip_photo_squery_img' />");
					$('.js-company_vip_main_photo_input').val(data);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
	});
	/**************** add new youtibe link ***************/
	var count_youtube_links = 2 - $('.company_vip_youtube_item').length;
	$('.company_vip_youtube_bottom').click(function(){
		if (count_youtube_links == 0){
			alert('Max 2 youtube link');
			return false;
		}
		count_youtube_links = count_youtube_links - 1;
		$('.js-com_youtube_count').html(count_youtube_links);
		
		var text = '<div class=\'company_vip_youtube_item\'>'
				+ '<input type="text" class="form_update_input" placeholder="example: https://youtu.be/nT4ig2z2heg" name="youtube_link[]" data-id=\'youtube_link_'+count_youtube_links+'\' data-type=\'youtube_link\' data-before=\'\'>'
				+ '<span class="form_update_ok hide" data-id=\'youtube_link_'+count_youtube_links+'\'>&#10004;</span>'
				+ '<span class="form_update_cancel hide" data-id=\'youtube_link_'+count_youtube_links+'\'>&#10006;</span>'
				+ '<span class="form_update_pencil " data-id=\'youtube_link_'+count_youtube_links+'\'><img src="/front/img/icons/pencil.png" class="form_update_pencil__image" /></span>'
			'</div>';
		$('.company_vip_youtube_list').append(text);
	});
	
	/**************** add new company photo to slider functions ***************/
	var count_galerea_photo = 15 - $('.company_vip_youtube_item').length;
	$('.js-add-company_vip_photo').click(function(){
		$('.js-file-company_vip_photo').click();
	});
	$( ".body" ).on( "change",'.js-file-company_vip_photo', function() {
		if (count_galerea_photo == 0){
			alert('Max 15 photo');
			return false;
		}
		count_galerea_photo = count_galerea_photo - 1;
		$('.js-com_galerea_photo').html(count_galerea_photo);
		
		
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
					
					var text = '<div class=\'company_vip_photo_item js-company_vip_photo_item\' style=\'width:110px; float: left;\'>'
									+'<div class=\'company_vip_photo_squery\' style=\"background:url(\''+data+'\') no-repeat center center; background-size: contain;\">'
									
									+'</div>'
									+'<div class=\'company_vip_photo_del\'>'
										+'✖'
									+'</div>'
									+'<input type=\'hidden\' name=\'photo[]\' class=\'js-value-company_vip_photo\' value="'+data+'" />'
								+'</div>';
					if ($( ".js-company_vip_photo_item" ).length > 0)
						$( text ).insertAfter( ".js-company_vip_photo_item:last" );
					else 
						$('.company_vip_photo_list').prepend(text);
					
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
	});
	// delete company photo functions
	$( ".body" ).on( "click",'.company_vip_photo_del', function() {
		var parent = $(this).parent();
		parent.remove();
		
		count_galerea_photo = count_galerea_photo + 1;
		$('.js-com_galerea_photo').html(count_galerea_photo);
	});
	/************* call company photo setting dialog **************/
	$('.js-company_photo_setting_open').click(function(){
		var panel = $('.js-company_photo_setting');
		if (panel.hasClass('open'))
			panel.removeClass('open');
		else 
			panel.addClass('open');
	});
	/************* call company main setting dialog **************/
	$('.js-company_vip_main_setting_open').click(function(){
		var panel = $('.js-company_vip_main_setting');
		if (panel.hasClass('open'))
			panel.removeClass('open');
		else 
			panel.addClass('open');
	});
	/************ change company greating message ****************/
	$('.js_is_greeting_call').change(function(){
		var input = $('.js_is_greeting_input');
		var vl =  parseInt(input.val());
		if (vl == '' || vl == undefined || vl == 0 || vl != 1) {
			input.val(1);
		}
		else {
			input.val(0);
		}
	});
	/************ change company callback message ****************/
	$('.js_is_callback_call').change(function(){
		var input = $('.js_is_callback_input');
		var vl =  parseInt(input.val());
		if (vl == '' || vl == undefined || vl == 0 || vl != 1) {
			input.val(1);
		}
		else {
			input.val(0);
		}
	});
	
	/**************** add license photo functions ******************/
	$('.js-license_item-add').click(function(){
		$('.js-license_item-file').click();
	});	
	$( ".body" ).on( "change",'.js-license_item-file', function() {
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
					
					$.post("/company-vip/add-license", { image: data } ).done(function( file_id ) {
						if (file_id == '0' || file_id == undefined || file_id == 0)
							return false;	
						var text = '<div class=\'license_item js-license_item\'>'
										+'<div class=\'license_item_squere license_item_img\' style=\"background:url('+data+') no-repeat center center; background-size: contain\">'
										+'</div>'
										+'<div class=\'license_item_del js-license_item-del\' data-id=\''+ file_id +'\'>✖</div>'
									+'</div>';
						if ($( ".js-license_item" ).length > 0)
							$(text).insertAfter( ".js-license_item:last" );
						else 
							$('.license_list').prepend(text);
					});
					
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
	});
	// delete license photo function
	$( ".body" ).on( "click",'.js-license_item-del', function() {
		var parent = $(this).parent();
		
		var file_id = $(this).data('id');
		$.post("/company-vip/delete-license", { file_id: file_id } ).done(function( data ) {
			if (data == '0' || data == undefined || data == 0)
				return false;	
			
			parent.remove();
		});
	});
	
	/***************** add new member to company team function ***********************/
	$('.js-team_item-add').click(function(){
		var name = $('.js-team_item-name');
		var pos = $('.js-team_item-pos');
		if (name.val() == undefined || pos.val() == undefined || name.val() == '' || pos.val() == ''){
			alert('Enter name and position to add new member');
			return false;
		}
		$('.js-team_item-file').click();
	});
	$( ".body" ).on( "change",'.js-team_item-file', function() {
		var name = $('.js-team_item-name');
		var pos = $('.js-team_item-pos');
		
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
					$.post("/company-vip/add-team", { image: data, name:name.val(), pos:pos.val() } ).done(function( file_id ) {
						if (file_id == '0' || file_id == undefined || file_id == 0)
							return false;	
						
						var text = '<div class=\'team_item js-team_item\'>'
										+'<div class=\'team_round\' style=\"background: url(\'+data+\') no-repeat center; background-size: auto 100%;\">'
										+'</div>'
										+'<div class=\'team_item_name\'>'+name.val()+'</div>'
										+'<div class=\'team_item_pos\'>'+pos.val()+'</div>'
										+'<div class=\'team_item_del js-license_item-del\' data-id=\''+file_id+'\'>✖</div>'
									+'</div>';
						if ($( ".js-team_item" ).length > 0)
							$(text).insertAfter( ".js-team_item:last" );
						else 
							$('.team_list').prepend(text);
						name.empty();
						pos.empty();
					});
					
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
	});
	
	/********************* swith company tabs links **********/
	$('.tab-link').click(function(){
		$('.tab-link').removeClass('current');
		$('.tab-link').removeClass('active');
		
		$(this).addClass('current');
		$(this).addClass('active');
		
		return true;
	});
	
	/******************* view map functions *******************/
	function showHideMapRestoran () {
		var dialog = $('.restoran_map_dialog');
		if (dialog.hasClass('open'))
			dialog.removeClass('open');
		else 
			dialog.addClass('open');
	}
//	$('.js-view_map').click(function(){
//		showHideMapRestoran();
//	});
	
	/************************ company map functions ***********************/
	/*
	var locations = [];
	var location = {
		gps_lat:51.1605227,
		gps_lan: 71.4703558
	};
	locations.push(location);
	Map.initMap(locations);
	*/
	
	/********** show greating block *****************/
	if ($('.js-greeting-block').length > 0){
		$('.js-greeting-block').css('display', 'block');
		$('.js-greeting-block').click(function(){
			$('.js-greeting-block').css('display', 'none');
		});
		
		setTimeout(function(){
			$('.js-greeting-block').css('display', 'none');
		}, 5000);
	}
	
	/******************* view callback functions *******************/
	$('.view_callback').click(function(){
		if ($('.callback_block').hasClass('open'))
			$('.callback_block').removeClass('open');
		else 
			$('.callback_block').addClass('open');
	});
	
	$('.callback_close').click(function(){
		if ($('.callback_block').hasClass('open'))
			$('.callback_block').removeClass('open');
		else 
			$('.callback_block').addClass('open');
	});
	
});
