jQuery( document ).ready( function( $ ) {
	/******** open main setting dialog functions *************/
    function toggleMainSetting(){
        var main_setting = $('.js-modal-main-settnig');
        if (main_setting.hasClass('open'))
            main_setting.removeClass('open');
        else
            main_setting.addClass('open');
    }
    $('.js-open-main-setting').click(function (){
        toggleMainSetting();
    });
	/******** open photo setting dialog functions *************/
    $('.js-open-photo-setting').click(function () {
        togglePhotoSetting();        

    });

    function togglePhotoSetting (){
        var photo_setting = $('.js-modal-photo-settnig');
        if (photo_setting.hasClass('open'))
            photo_setting.removeClass('open');
        else
            photo_setting.addClass('open');



    }

	/********** upload blog image functions ****************/
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
	
	/*************** max 500 symbols in about field **************/
	$( ".js-max-500-symbol" ).keypress(function(e) {
        if (e.which < 0x20) {
            // e.which < 0x20, then it's not a printable character
            // e.which === 0 - Not a character
            return;     // Do nothing
        }
        if (this.value.length == 500) {
			alert('Max 500 symbols');
			e.preventDefault();
        } else if (this.value.length > 500) {
            // Maximum exceeded
            this.value = this.value.substring(0, max);
        }
    });
	
	/*************** restoran option functions *********************/
	$(".js-select-restoran-option").click(function () {
		var type = 'option';
		var option = $(this);
		
		var id = option.data('id');
		var check = option.data('check');
		
		$.post("/restoran/edit-ajax", { 'type':type, 'data[id]':id, 'data[check]':check} ).done(function( data ) {
			if (data == '0')
				return false;
				
			var parent = option.parent('.c-checklist__item');
			if (parent.hasClass('_active'))
				parent.removeClass('_active');
			else 
				parent.addClass('_active');
        });
	});
	$('.js-input-restoran').each(function(i, obj) {
	});
	/*************** restoran timetable functions *********************/
	$('.js-timetable-value').change(function () {
		var type = 'timetable';
		
		var id = $(this).data('id');
		var type_value = $(this).data('type');
		var value = $(this).val();
		
		$.post("/restoran/edit-ajax", { 'type':type, 'data[id]':id, 'data[type_value]':type_value, 'data[value]':value} ).done(function( data ) {
        });
		
	});
	/************ restoran fields save functions **********/
	function swithHideInput (id, before) {
        var input = $(".form_update_input[data-id='" + id + "']");
        if (!input.hasClass('active')) {
            input.attr("disabled", false);
            input.data('before', input.val());
            $( ".form_update_input[data-id='" + id + "']" ).addClass('active');
            $( ".form_update_ok[data-id='" + id + "']" ).removeClass('hide');
            $( ".form_update_cancel[data-id='" + id + "']" ).removeClass('hide');
            $( ".form_update_pencil[data-id='" + id + "']" ).addClass('hide');
        }
        else {
            if (!before)
                input.val(input.data('before'));
            input.attr("disabled", true);
            $( ".form_update_input[data-id='" + id + "']" ).removeClass('active');
            $( ".form_update_ok[data-id='" + id + "']" ).addClass('hide');
            $( ".form_update_cancel[data-id='" + id + "']" ).addClass('hide');
            $( ".form_update_pencil[data-id='" + id + "']" ).removeClass('hide');
        }
    }
	// click for update field
    $('.form_update_pencil').click(function(){
        var id = $(this).data('id');
        swithHideInput(id, true);
    });
	// click for save field
    $('.form_update_ok').click(function(){
		var id = $(this).data('id');
		var input = $(".form_update_input[data-id='" + id + "']");
		var type = input.data('type');
        var value = input.val();
		
		$.post("/restoran/edit-ajax", { 'type':type, 'data[id]':id, 'data[value]':value} ).done(function( data ) {
        });
        swithHideInput(id, true);
    });
	// click for cancel field
    $('.form_update_cancel').click(function(){
        var id = $(this).data('id');
        swithHideInput(id, false);
    });
	
	/*********** select restaron cat functions **************/
	var count_restorant_cat = $('.js-del-restoran-cat').length;
	$('.js-sel-restoran-cat').click(function(){
		if (count_restorant_cat == 3 || count_restorant_cat > 3){
			$('.js-sel-restoran-cat-group').hide();
			return true;
		}
		
		count_restorant_cat++;
		var cat = '<div class="c-selected__item">';
		cat = cat + '<div class="c-selected__title">' + $(this).html() +'</div>';
		cat = cat + '<input type="hidden" name="cat[]" value="' + $(this).data('id') + '">';
		cat = cat + '<a href="#del-cat" class="c-delete js-del-restoran-cat">';
		cat = cat + '<i class="c-delete__icon icon-52"></i>';
		cat = cat + '</a></div>';
		
		$('.js-list-restoran-cat').append(cat);
		
		if (count_restorant_cat == 3 || count_restorant_cat > 3){
			$('.js-sel-restoran-cat-group').hide();
			return true;
		}
		
	});
	/*********** delete restaron cat functions **************/
	$( ".c-settingspanel " ).on( "click",'.js-del-restoran-cat', function() {
		count_restorant_cat--;
		if (count_restorant_cat < 4){
			$('.js-sel-restoran-cat-group').show();
		}
		
		var parent = $(this).parent();
		parent.remove();
	});
	/********** restoran add cousine funcions **************/
	$('.js-sel-restoran-cousine').click(function(){
		var cousine = '<div class="c-selected__item">';
		cousine = cousine + '<div class="c-selected__title">' + $(this).html() +'</div>';
		cousine = cousine + '<input type="hidden" name="cousine[]" value="' + $(this).html() + '">';
		cousine = cousine + '<a href="#del-cat" class="c-delete js-del-restoran-cousine">';
		cousine = cousine + '<i class="c-delete__icon icon-52"></i>';
		cousine = cousine + '</a></div>';
		
		$('.js-list-restoran-cousine').append(cousine);
	});
	/********* delete cousine functions **************/
	$( ".c-settingspanel " ).on( "click",'.js-del-restoran-cousine', function() {
		var parent = $(this).parent();
		parent.remove();
	});
	/********** edit contact functions **************/
	$( ".c-settingspanel" ).on( "click",'.js-edit-contacs-button', function() {
		var parent = $(this).parent();
		var inputs = parent.find('.js-edit-contacs');
		if ($(this).data('edit') == '0' || $(this).data('edit') == 0){
			$(this).data('edit', '1');
            inputs.addClass('active');
		}
		else {
			$(this).data('edit', '0');
            inputs.removeClass('active');
		}
	});
	/************* send main setting form *******************/
	$('.js-form-res-main-setting-apply').click(function(){
		$('.js-form-res-main-setting').submit();
	});
	/************* add new contact fields *******************/
	var count_contacts = $('.js-edit-contacs-button').length;
	$( ".c-settingspanel" ).on( "click",'.js-add-contacs-button', function() {
		if (count_contacts == 3)
			return true;
		
		count_contacts++;
		var text = '';
		text = text + '<div class="c-settingsform__contacts">';
		text = text + '<div class="c-formcontacts">';
		text = text + '<div class="c-formcontacts__list">';
		text = text + '<div class="c-formcontacts__item">';
		text = text + '<div class="c-formcontacts__label">Telephone:</div>';
		text = text + '<div class="c-formcontacts__text">';
		text = text + '<input type="text" name="phone[]" class="phone_uae form_update_input js-edit-contacs" />';
		text = text + '</div>';
		text = text + '</div>';
		text = text + '<div class="c-formcontacts__item">';
		text = text + '<div class="c-formcontacts__label">Location:</div>';
		text = text + '<div class="c-formcontacts__text">';
		text = text + '<input type="text" name="location[]" class="form_update_input js-edit-contacs" />';
		text = text + '</div>';
		text = text + '</div>';
		text = text + '</div>';
		text = text + '<a href="#" class="c-button c-formcontacts--edit js-edit-contacs-button" data-edit="0"><i class="c-button__icon icon-57"></i></a>';
		text = text + '</div>';
		text = text + '<a href="#" class="c-button c-formcontacts--add js-del-contacs-button" ><i class="c-button__icon icon-17"></i></a>';
		text = text + '</div>';
		
		$('.js-list-contacs-button').append(text);
	});
	
	$( ".c-settingspanel" ).on( "click",'.js-del-contacs-button', function() {
		count_contacts--;
		$(this).parent().remove();
	});
	/************* add new youtube link **************/
	var youtube_count = 2 - $('.c-ytvideos__item').length;
	$( ".c-settingspanel" ).on( "click",'.js-add-res-youtube', function() {
		if (youtube_count == 0){
			alert('Max 2 youtube link');
			return false;
		}
		youtube_count = youtube_count - 1;
		$('.js-youtube_count').html(youtube_count);
		
		var text = '';
		
		text = text + '<div class="c-ytvideos__item">';
		text = text + '<div class="c-ytvideos__link">';
		text = text + '<input type="text" class="form_update_input active" name="youtube[]">';
		text = text + '</div>';
		text = text + '<a href="#del" class="c-delete  js-del-res-youtube">';
		text = text + '<i class="c-delete__icon icon-52"></i>';
		text = text + '</a>';
		text = text + '</div>';
		
		$('.js-list-res-youtube').append(text);
	});
	/********** delete youtibe link ***************/
	$( ".c-settingspanel" ).on( "click",'.js-del-res-youtube', function() {
		youtube_count = youtube_count + 1;
		$('.js-youtube_count').html(youtube_count);
		
		var parent = $(this).parent();
		parent.remove();
	});
	/********** upload main logo functions ****************/
	$(".js-main-photo-res-add").click(function(){
		$('.js-main-photo-res-file').click ();
	});
	$( ".c-settingspanel" ).on( "change",'.js-main-photo-res-file', function() {
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
					$('.js-main-photo-res-img').attr('src', data);
					$('.js-main-photo-res-input').val(data);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
	
	/************* upload photo to galerea functions *******************/
	var count_image_photo_palarea =  15 - $('.js-photo_galerea_item').length;
	$('.js-galerea-photo-res-add').click(function (){
		$('.js-galerea-photo-res-file').click();
	});
	$( ".c-settingspanel" ).on( "change",'.js-galerea-photo-res-file', function() {
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
					var text = '';
					text = text + '<div class="l-grid__col-3_md-3_sm-3_xs-3 js-photo_galerea_item">';
					text = text + '<div class="c-gallery__item">';
					text = text + '<div class="c-gallery__image" style="background:url(' + data + ') no-repeat center; background-size:contain;">';
					text = text + '</div>';
					text = text + '<div class="c-gallery__delete js-galerea-photo-res-delete">';
					text = text + '<a href="#" class="c-delete">';
					text = text + '<i class="c-delete__icon icon-52"></i>';
					text = text + '</a>';
					text = text + '</div>';
					text = text + '<input type="hidden" class="js-galerea-photo-res-input" name="photo_galerea[]" value="' + data + '">';
					text = text + '</div>';
					text = text + '</div>';
					$('.js-galerea-photo-res-list').prepend(text);
					count_image_photo_palarea = count_image_photo_palarea - 1;
					$('.js-photo_galerea_count').html(count_image_photo_palarea);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
	$( ".c-settingspanel" ).on( "click",'.js-galerea-photo-res-delete', function() {
		var parent = $(this).parent().parent();
		parent.remove();
		count_image_photo_palarea = count_image_photo_palarea + 1;
		$('.js-photo_galerea_count').html(count_image_photo_palarea);
	});
	
	/*******  menu-photo ************/
	$('.js-menu-photo-res-add').click(function (){
		$('.js-menu-photo-res-file').click();
	});
	$( ".c-settingspanel" ).on( "change",'.js-menu-photo-res-file', function() {
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
					var text = '';
					text = text + '<div class="l-grid__col-3_md-3_sm-3_xs-3">';
					text = text + '<div class="c-gallery__item">';
					text = text + '<div class="c-gallery__image" style="background:url(' + data + ') no-repeat center; background-size:contain;">';
					text = text + '</div>';
					text = text + '<div class="c-gallery__delete js-menu-photo-res-delete">';
					text = text + '<a href="#" class="c-delete">';
					text = text + '<i class="c-delete__icon icon-52"></i>';
					text = text + '</a>';
					text = text + '</div>';
					text = text + '<input type="hidden" class="js-menu-photo-res-input" name="menu_galerea[]" value="' + data + '">';
					text = text + '</div>';
					text = text + '</div>';
					$('.js-menu-photo-res-list').append(text);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
	$( ".c-settingspanel" ).on( "click",'.js-menu-photo-res-delete', function() {
		var parent = $(this).parent().parent();
		parent.remove();
	});
	
	/*******  meals-photo ************/
	$('.js-meals-photo-res-add').click(function (){
		var title = $('.js-meals-photo-res-title').val();
		var note = $('.js-meals-photo-res-note').val();
		if (title == '' || title == undefined || note == '' || note == undefined) {
			alert('Fill title and description');
			return false;
		}
		
		$('.js-meals-photo-res-file').click();
	});
	$( ".c-settingspanel" ).on( "change",'.js-meals-photo-res-file', function() {
		var title = $('.js-meals-photo-res-title').val();
		var note = $('.js-meals-photo-res-note').val();
		
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
					var text = '<div class=\'restoran_meal_tab_item\'>'
									+'<div class=\'restoran_meal_tab_img_block\'>'
										+'<img  class=\'restoran_meal_tab_img\' src=\''+data+'\' />'
									+'</div>'
									+'<div class=\'restoran_meal_tab_text_block\'>'
										+'<div class=\'restoran_meal_tab_title\'>'+title+'</div>'
										+'<div class=\'restoran_meal_tab_note\'>'+note+'</div>'
									+'</div>'
									+'<input type=\'hidden\' name=\'meals_galerea_img[]\' value=\''+data+'\'>'
									+'<input type=\'hidden\' name=\'meals_galerea_title[]\' value=\''+title+'\'>'
									+'<input type=\'hidden\' name=\'meals_galerea_note[]\' value=\''+note+'\'>'
									+'<div class="c-gallery__delete js-meals-photo-res-delete">'
										+'<a href="#" class="c-delete">'
											+'<i class="c-delete__icon icon-52"></i>'
										+'</a>'
									+'</div>'
							   +'</div>';
					$('.js-meals-photo-res-list').prepend(text);
					$('.js-meals-photo-res-title').val('');
					$('.js-meals-photo-res-note').val('');
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
	$( ".c-settingspanel" ).on( "click",'.js-meals-photo-res-delete', function() {
		var parent = $(this).parent();
		parent.remove();
	});
	
	/*******  guests-photo ************/
	$('.js-guests-photo-res-add').click(function (){
		$('.js-guests-photo-res-file').click();
	});
	
	$( ".c-settingspanel" ).on( "change",'.js-guests-photo-res-file', function() {
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
					var text = '';
					text = text + '<div class="l-grid__col-3_md-3_sm-3_xs-3">';
					text = text + '<div class="c-gallery__item">';
					text = text + '<div class="c-gallery__image" style="background:url(' + data + ') no-repeat center; background-size:contain;">';
					text = text + '</div>';
					text = text + '<div class="c-gallery__delete js-guests-photo-res-delete">';
					text = text + '<a href="#" class="c-delete">';
					text = text + '<i class="c-delete__icon icon-52"></i>';
					text = text + '</a>';
					text = text + '</div>';
					text = text + '<input type="hidden" class="js-guests-photo-res-input" name="guests_galerea[]" value="' + data + '">';
					text = text + '</div>';
					text = text + '</div>';
					$('.js-guests-photo-res-list').append(text);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
	$( ".c-settingspanel" ).on( "click",'.js-guests-photo-res-delete', function() {
		var parent = $(this).parent().parent();
		parent.remove();
	});
	
	/*******  team-photo ************/
	$('.js-team-photo-res-add').click(function (){
		$('.js-team-photo-res-file').click();
	});
	$( ".c-settingspanel" ).on( "change",'.js-team-photo-res-file', function() {
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
					var text = '';
					text = text + '<div class="l-grid__col-3_md-3_sm-3_xs-3">';
					text = text + '<div class="c-gallery__item">';
					text = text + '<div class="c-gallery__image" style="background:url(' + data + ') no-repeat center; background-size:contain;">';
					text = text + '</div>';
					text = text + '<div class="c-gallery__delete js-team-photo-res-delete">';
					text = text + '<a href="#" class="c-delete">';
					text = text + '<i class="c-delete__icon icon-52"></i>';
					text = text + '</a>';
					text = text + '</div>';
					text = text + '<input type="hidden" class="js-team-photo-res-input" name="team_galerea[]" value="' + data + '">';
					text = text + '</div>';
					text = text + '</div>';
					$('.js-team-photo-res-list').append(text);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
	$( ".c-settingspanel" ).on( "click",'.js-team-photo-res-delete', function() {
		var parent = $(this).parent().parent();
		parent.remove();
	});
	$(".js-form-photo-apply").click(function(){
		$(".js-form-photo").submit();
	});

	/***** select restoran tab slider *******/
	$('.js-select-restoran-tab').click(function(){
		var tab = $(this).data('tab-id');
		
		$('.restoran_slide_tab').removeClass('open');
		$('#'+tab).addClass('open');
		
		var slider = $('#'+tab).find('.js-slider');
		slider.slick('slickPrev');
	});
	$('.js-restoran_slide_tab-close').click(function(){
		var tab = 'restoran_slide_tab_main';
		$('.restoran_slide_tab').removeClass('open');
		$('#'+tab).addClass('open');
		
		var slider = $('#'+tab).find('.js-slider');
		slider.slick('slickPrev');
	});
	
	/********* restoran map functions **********/
	function showHideMapRestoran () {
		var dialog = $('.restoran_map_dialog');
		if (dialog.hasClass('open'))
			dialog.removeClass('open');
		else 
			dialog.addClass('open');
	}
//	$('.js-restoran_map_dialog-toggle').click(function(){
//		showHideMapRestoran();
//	});
	
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
	
	/********** edit timetable ****************/
	$('.js-timetable-edit').click(function(){
		$(this).hide();
		$('.js-timetable-delete').show();
		$('.js-timetable-save').show();
		
		$('.js-timetable-show-form').hide();
		$('.js-timetable-edit-form').show();
	});
	
	$('.js-timetable-delete').click(function(){
		$('.js-timetable-edit').show();
		$('.js-timetable-delete').hide();
		$('.js-timetable-save').hide();
		
		$('.js-timetable-edit-form').hide();
		$('.js-timetable-show-form').show();
	});
	
	$('.js-timetable-save').click(function(){
		$('.js-timetable-edit').show();
		$('.js-timetable-delete').hide();
		$('.js-timetable-save').hide();
		
		$('.js-timetable-edit-form').hide();
		$('.js-timetable-show-form').show();
	});
	
	/******* edit restoran option *********/
	$('.js-option-edit').click(function(){
		$('.js-option-edit').hide();
		$('.js-option-delete').show();
		$('.js-option-save').show();
	});
	
	$('.js-option-delete').click(function(){
		$('.js-option-edit').show();
		$('.js-option-delete').hide();
		$('.js-option-save').hide();
	});
	
	$('.js-option-save').click(function(){
		$('.js-option-edit').show();
		$('.js-option-delete').hide();
		$('.js-option-save').hide();
	});
	

	
});
