jQuery( document ).ready( function( $ ) {
	/************ js_add_ad_color_value **********/
	$( ".body " ).on( "click",'.js_add_ad_color_option', function() {
		$('.js_add_ad_color_option').removeClass('open');
		$(this).addClass('open');
		var id = $(this).data('id');
		
		$('.js_add_ad_color_value').val(id);
	});
	
	/************ getModel by Brand **********/
	$( ".body " ).on( "click",'.js-auto-brand', function() {
		var id = $(this).val();
		var img = $('option:selected', this).data('img');
		$('.js-auto-img').attr('src', img);

		if (id > 0) {
			$.post("/ad/car-model", { id: id} ).done(function( data ) {
				data = JSON.parse(data);
				$('.js-auto-model').empty();
				$('.js-auto-model').append('<option>Model</option>');

				$.each(data, function( index, value){
					$('.js-auto-model').append('<option value="'+value.id+'">'+value.name+'</option>');
				});
			});
		}
	});
	
	
	/************ change to be disscuss **************/
	$( ".body" ).on( "change",'.js_joijijads45878897', function() {
		console.log('hueta ');
		if ($(this).prop('checked')){
			$(".js-add-ad-price-value22222222").prop('disabled', true);
			$(".js-add-ad-price-value22222222").addClass('sad2312asd1231');
			$(".js-add-ad-price-value22222222").removeClass('error');
			$(".js-add-ad-price-value22222222").val(0);
		}
		else {
			$(".js-add-ad-price-value22222222").prop('disabled', false);
			$(".js-add-ad-price-value22222222").removeClass('sad2312asd1231');
		}
			
	});

	/************ get advert cat by parent function**********/
    function getSubCat (child_class, id) {
        $.post("/ad/sub-cat", { id: id} ).done(function( data ) {
			
            data =  $.parseJSON(data);
			/*
			function sortResults(prop, asc) {
				data = data.sort(function(a, b) {
					if (asc) {
						return (a[prop] > b[prop]) ? 1 : ((a[prop] < b[prop]) ? -1 : 0);
					} else {
						return (b[prop] > a[prop]) ? 1 : ((b[prop] < a[prop]) ? -1 : 0);
					}
				});
				showResults();
			}
			/*
			data = data.sort(function (a, b) {
				return a.value.localeCompare( b.value );
			});
			*/
            $('.'+child_class).empty();
            $('.'+child_class).append('<option></option>');
		
			var i = 0;
            $.each(data, function( index, value){
				if (index == '904' || index == '908' || index == 904 || index == 908 || value.name== 'All' || value.name=='all'){
				
				}
				else {
					$('.'+child_class).append('<option value="'+value.id+'">'+getTrans(value.name)+'</option>');
					i = 1;
				}
            });
			
			

			if (i == 1)
				$('.'+child_class).show('slow');
			else
				$('.'+child_class).hide('slow');

        });
    }
	/*************** hide advert cats ****************/
	$('.js_add_ad_select_cat_2').hide();
	$('.js_add_ad_select_cat_3').hide();
	$('.js_add_ad_select_cat_4').hide();
	/************* click to get cat by type ***************/
    $('.add_ad_type__item').click(function(){
        var id = $(this).data('id');
        $('.js_add_ad_select_cat_1').val(id);
		
        if ($(this).hasClass('active'))
            return true;

        $('.add_ad_type__item').removeClass('active');
        $(this).addClass('active');

        getSubCat('js_add_ad_select_cat_2', id);
		
		$('.js_add_ad_select_cat_3').hide();
		$('.js_add_ad_select_cat_4').hide();

        $('.js_add_ad_select_cat_3').empty();
        $('.js_add_ad_select_cat_4').empty();
    });
	/************* click to get subcat by cat ***************/
    $('.js_add_ad_select_cat_2').change(function(){
        var id = $(this).val();
        id = parseInt(id);
        if (!(id > 0))
            return true;
        getSubCat('js_add_ad_select_cat_3', id);
		
		$('.js_add_ad_select_cat_4').hide();
        $('.js_add_ad_select_cat_4').empty();
    });
	/************* click to get subcat2 by subcat ***************/
    $('.js_add_ad_select_cat_3').change(function(){
        var id = $(this).val();
        id = parseInt(id);
        if (!(id > 0))
            return true;
			
        getSubCat('js_add_ad_select_cat_4', id);
    });
	
    /******** click for show add ad dialog *****/
    $('.js-add-advert').click (function (){
        $('.wrapper').addClass( "total_blur" );
		$('body').addClass( "modal_open" );
        $('.add_ad_modal').addClass('open');
		
		console.log('click to add advert');
    });
	/******** click for close add ad dialog *****/
    $(document).on('click','.add_ad_modal__close',function(){
        $('.add_ad_modal').removeClass('open');
        $('.wrapper').removeClass( "total_blur" );
        $('body').removeClass( "modal_open" );
		location.reload();
    });
	
	/************ swith add ad steps functions *****************/
    var validator = $( "#form_send_ad" ).validate({
		errorPlacement: function(error,element) {
			return true;
		}
	});
	
    $(document).on( "click",'.add_ad_modal .js-add_ad_step', function() {
        var step = $(this).data('step');
        var before_step = $(this).data('before-step');

        if (step == '0'){
            $(".add_ad_modal__close").trigger('click');

        }
        else if(step == '1') {
            $('.js-add-ad-step').removeClass('active');
            $( "#add_ad_tab_2" ).removeClass('active');

            $( ".js-add-ad-step[data-id='1']" ).addClass('active');
            $( "#add_ad_tab_1" ).addClass('active');

        }
        else if(step == '2') {
            if (before_step == '1'){
				
                var cat_1 = parseInt($('.js_add_ad_select_cat_1').val());
                var cat_2 = parseInt($('.js_add_ad_select_cat_2').val());
                var cat_3 = parseInt($('.js_add_ad_select_cat_3').val());
                var cat_4 = parseInt($('.js_add_ad_select_cat_4').val());
                var city_id = parseInt($('.js_add_ad_select_city_id').val());
				
				var ar_result = [];
				
				

				$( "#add_ad_tab_1 .add_ad_field" ).each(function( index, value ) {
					$( this ).rules( "add", {
						required: true
					});
					ar_result.push(validator.element( "#add_ad_tab_1 .add_ad_field:eq("+index+")" ));
				});

				if ( $.inArray(false, ar_result) > -1 )
					return true;
				ar_result = [];
				
                $.post("/ad/generate-body", { cat_1:cat_1, cat_2:cat_2, cat_3:cat_3, cat_4:cat_4, city_id:city_id} ).done(function( data ) {
                    $('#add_ad_tab_2').html(data);

                    $('.js-add-ad-step').removeClass('active');
                    $( "#add_ad_tab_1" ).removeClass('active');

                    $( ".js-add-ad-step[data-id='2']" ).addClass('active');
                    $( "#add_ad_tab_2" ).addClass('active');
					
					$('.new_price_format').priceFormat({
						prefix: '',
						clearPrefix: true,
						centsSeparator: '.'
					});
					/*
					$("#add_ad_tab_2 input:radio:first").attr('checked', true);
					$("#add_ad_tab_2 input:checked:first").attr('checked', true);
					*/
					
					$( '#add_ad_tab_2 input[type="radio"]' ).each(function( index, value ) {
						console.log($(this).attr('class'));
						//$("#add_ad_tab_2 input:radio:eq("+index+"):first").attr('checked', true);
						//$("#add_ad_tab_2 input:radio:eq("+index+")").attr('checked', true);
						//$(this).attr('checked', true);
						//ar_result.push(validator.element( "#add_ad_tab_2 .add_ad_field:eq("+index+")" ));
					});
					
					$( '#add_ad_tab_2 input[type="checked"]' ).each(function( index, value ) {
						console.log($(this).attr('class'));
						$("#add_ad_tab_2 input:checked:eq("+index+"):first").attr('checked', true);
						//$("#add_ad_tab_2 input:radio:eq("+index+")").attr('checked', true);
						//$(this).attr('checked', true);
						//ar_result.push(validator.element( "#add_ad_tab_2 .add_ad_field:eq("+index+")" ));
					});
                });
            }
            else {
                $('.js-add-ad-step').removeClass('active');
				$( "#add_ad_tab_1" ).removeClass('active');

				$( ".js-add-ad-step[data-id='2']" ).addClass('active');
				$( "#add_ad_tab_2" ).addClass('active');
            }

			return false;
        }
        else if(step == '3') {
			var cat_1 = parseInt($('.js_add_ad_select_cat_1').val());
			var cat_2 = parseInt($('.js_add_ad_select_cat_2').val());
			
            var ar_result = [];
			
			var par_price = $( "#add_ad_tab_2 .js-add-ad-price-value22222222" ).parent();
			if (cat_1 == 1 || (cat_1 == 2 && (cat_2 == 17 || cat_2 == 20) ) || cat_1 == 5 || cat_1 == 7 || cat_1 == 8){
				console.log('validate price 1');
				console.log('$(".js-add-ad-price-free").length ' + $(".js-add-ad-price-free").length);
				console.log("$('.js-add-ad-price-free').prop('checked') " + $('.js-add-ad-price-free').prop('checked'));
				if ($(".js-add-ad-price-free").length == 0 || !$('.js-add-ad-price-free').prop('checked') || $('.js-add-ad-price-free').prop('checked') == undefined){
					console.log('validate price 2');
					
					
					if ($( "#add_ad_tab_2 .js-add-ad-price-value22222222" ).val() == undefined 
							|| $( "#add_ad_tab_2 .js-add-ad-price-value22222222" ).val() == '0' 
							|| $( "#add_ad_tab_2 .js-add-ad-price-value22222222" ).val() == 0){
						par_price.css('border', '1px solid red');
						ar_result.push(false);
					}
					else {
						ar_result.push(true);
						par_price.css('border', '1px solid #565a5d');
					}
				}else {
					ar_result.push(true);
					par_price.css('border', '1px solid #565a5d');
				}
			}else {
				ar_result.push(true);
				par_price.css('border', '1px solid #565a5d');
			}
			
            $( "#add_ad_tab_2 .add_ad_field[name!='youtube_href']:not(.sad2312asd1231)" ).each(function( index, value ) {
                $( this ).rules( "add", {
                    required: true
                });
                ar_result.push(validator.element( "#add_ad_tab_2 .add_ad_field:eq("+index+")" ));
            });
			
			

            if ( $.inArray(false, ar_result) > -1 )
                return true;
            ar_result = [];

            $('.js-add-ad-step').removeClass('active');
            $( "#add_ad_tab_2" ).removeClass('active');

            $( ".js-add-ad-step[data-id='3']" ).addClass('active');
            $( "#add_ad_tab_3" ).addClass('active');
			
			
			$('.js-add-ad-price-value3333').val($('.js-add-ad-price-value22222222').val());
			$('.js-add-ad-price-value4444').val($('.js-add-ad-price-value22222222').val());

			setTimeout(function(){
                $('.add_ad_vip_block__submit').attr('type', 'submit');

			}, 2000);
        }

    });
	/*
	$( ".add_ad_modal__body" ).on("change", '.js_add_ad_select_city_id', function(){
		$('.js_add_ad_select_city_id').css('border-color', 'black');
	});
	
	$( ".add_ad_modal__body" ).on("change", '.js_add_ad_select_cat_1', function(){
		$('.js_add_ad_select_cat_1').css('border-color', 'black');
	});
	
	$( ".add_ad_modal__body" ).on("change", '.js_add_ad_select_cat_2', function(){
		$('.js_add_ad_select_cat_2').css('border-color', 'black');
	});
	
	$( ".add_ad_modal__body" ).on("change", '.js_add_ad_select_cat_3', function(){
		$('.js_add_ad_select_cat_3').css('border-color', 'black');
	});
	
	$( ".add_ad_modal__body" ).on("change", '.js_add_ad_select_cat_4', function(){
		$('.js_add_ad_select_cat_4').css('border-color', 'black');
	});
	*/
	
	/************ click to submit functions ******************/
   // var counter_submit_add = 1;
	
	var ar_result = [];
	
    $('#form_send_ad').submit(function(){
		if(!$('.js-check_terms').hasClass('active')){
			$('.js-check_terms').css('color', 'red');
			return false;
		} 
		/*
        if (counter_submit_add > 1)
            return false;
		*/
		console.log('add_ad_vip_block__2 before clicked');
		var ar_result = [];
		if (!$('#add_ad_vip_block__2').hasClass('add_ad_vip_block__item_grey')){
			console.log('add_ad_vip_block__2 clicked');
			$( "#add_ad_tab_3 .new_price_format" ).each(function( index, value ) {
				$( this ).rules( "add", {
					required: true,
					digits:true,
					min: 1
				});
				ar_result.push(validator.element( "#add_ad_tab_3 .new_price_format:eq("+index+")" ));
			});
			
		}
		ar_result = [];
		console.log(ar_result);
		
		if ( ar_result.length > 0 && $.inArray(false, ar_result) > -1){
			return false;
		}
		
		var def_sum = parseInt($('.js-default-user-balans').val());
		var total_sum = parseInt($('.js-total-vip-sum').data('total-cost'));
			
		if (total_sum > def_sum)
			return false;
		//return true;

        //counter_submit_add = counter_submit_add + 1;
        return true;
    });
	
	/*********** change to js-check_terms **********/
	$( document ).on("click", '.add_ad_modal__body .js-check_terms', function(){
		if ($(this).hasClass('active')){
			$('.add_ad_vip_block__submit').addClass('close');
			$(this).removeClass('active');
			$(this).removeClass('icon-33');
			$(this).addClass('icon-32');
			$(this).css('color', 'red');
		}
		else {
			$('.add_ad_vip_block__submit').removeClass('close');
			$(this).addClass('active');
			$(this).addClass('icon-33');
			$(this).removeClass('icon-32');
			
			$(this).css('color', 'inherit');
		}
	});
	
	

    /*************** upload image for advert ***************/
	var total_advert_photo_count = 20;
	/*
	$( ".add_ad_modal__body" ).on("click", '.add_ad_feilds__upload_file', function(){
		if (total_advert_photo_count == 0){
			alert('Max 20 photo');
			event.preventDefault();
			return false;
		}
	});
	*/
	
    $(document).on( "change",'.add_ad_modal__body .add_ad_feilds__upload_file,.ad_dialog_edit .add_ad_feilds__upload_file'
        , function() {

		if (total_advert_photo_count < 1){
			alert('Max 20 youtube link');
			return false;
		}
		
			
		
        var file = $(this);
        //var form_close = file.closest( ".upload_logo" );
        var formData = new FormData();
        formData.append( 'image', $(this)[0].files[0] );
        //var formData = new FormData(form_close[0]);
        $.ajax({
            url: "/company/image",
            type: 'POST',
            data: formData,
            async: true,
            success: function (data) {
				console.log(data);
                if (data!='0' && data!='1') {
                    var img = '';
                    img = img + '<div class="add_ad_feilds__left" style="position: relative;">' 
									+ "<div class='add_ad_feilds__upload js-add_ad_feilds__upload' style='cursor: pointer' data-img='" + data + "'>" 
										+ '<img src="'+data+'" style="max-width: 100%; max-height: 100%;">' 
										+ '<input type="hidden" name="ad_img[]" value="'+data+'">'
									+ '</div>' 
									+ '<i class="js-del-ad-add-photo delete" style="position: absolute; bottom: -9px; color: red; right: 0; cursor: pointer;"></i>'
									+ '<span class="js-to-main-add-photo" style="position: absolute; top: 10px; color: #fff; right: 2px; cursor: pointer; font-size: 12px; background: green; padding: 2px 3px; display: none;" data-img="'+data+'">main photo</span>'
								+ '</div>';
                    $( ".add_ad_feilds__left:last" ).before( img );
					
					total_advert_photo_count = total_advert_photo_count - 1;
					setUploadCounterImages();
					
					if (total_advert_photo_count <= 20 && total_advert_photo_count > 0){
						$('.js-add-ad-upload_1').css('display', 'none');
						$('.js-add-ad-upload_other').css('display', 'block');
					}
					
					if (total_advert_photo_count == 0) {
						$('.js-add-ad-upload_1').css('display', 'none');
						$('.js-add-ad-upload_other').css('display', 'none');
					}
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
	$(document).on( "click",'.add_ad_modal__body .js-del-ad-add-photo', function() {
		var parent = $(this).parent();
		parent.remove();
		
		total_advert_photo_count = total_advert_photo_count + 1;
		
		if (total_advert_photo_count == 20){
			$('.js-add-ad-upload_1').css('display', 'block');
			$('.js-add-ad-upload_other').css('display', 'none');
		}
		else if (total_advert_photo_count > 0) {
			$('.js-add-ad-upload_1').css('display', 'none');
			$('.js-add-ad-upload_other').css('display', 'block');
		}
		
		setUploadCounterImages();
		
	});
	
	console.log(total_advert_photo_count);
	function setUploadCounterImages () {
		console.log(total_advert_photo_count);
		$('.js-add-ad-upload_counter').html(total_advert_photo_count + ' left');
	}
	
	$(document).on( "click",'.add_ad_modal__body .js-add_ad_feilds__upload', function() {
		
		$('.js-add_ad_feilds__upload').css('border', '1px solid #15499f');
		$(this).css('border', '2px solid green');
		
		$('.js-to-main-add-photo').css('display', 'none');
		var parent_el = $(this).parent();
		var main_photo = parent_el.find('.js-to-main-add-photo');
		main_photo.css('display', 'block');
		
		console.log($(this).data('img'));
		$('#ad_main_photo').val($(this).data('img'));
		console.log($('#ad_main_photo').val());
	});
	
	/*********** click to set vip ad **************/
    $(document).on('click','.js-check_vip',function () {
		if (parseInt($('.js_add_ad_select_cat_1').val()) == 9) // found and lost
			return false;
		
		var parent = $(this).parent().parent();
		var val_selector = parent.data('val_selector');
			
		
		if ((parseInt($('.js_add_ad_select_cat_1').val()) == 8) 
				&& (val_selector == 'js_add_advert_is_green' 
					|| val_selector == 'js_add_advert_is_sale' 
					|| val_selector == 'js_add_advert_is_hot_or_urgent')) // Events and  Exebitions
			return false;
			
		if ((parseInt($('.js_add_ad_select_cat_1').val()) == 3 &&  parseInt($('.js_add_ad_select_cat_2').val()) == 33) 
				&& (val_selector == 'js_add_advert_is_sale' 
					|| val_selector == 'js_add_advert_is_hot_or_urgent')) // jobs cv
			return false;
       
		if (val_selector == 'js_add_advert_is_hot_or_urgent'){
			if (!$('.js-add_ad_hot_deal_click').hasClass('active'))
				$('.js-add_ad_hot_deal_click').click();
			
			if (!$('.js-add_ad_hot_deal_click').hasClass('active') && !$('.js-add_ad_urgent_click').hasClass('active'))
				('.js-add_ad_urgent_click').click();
		}
		
		console.log('val_selector ' + val_selector);
        if (parent.hasClass('add_ad_vip_block__item_grey')) {
            parent.removeClass('add_ad_vip_block__item_grey');
            $(this).removeClass('icon-32');
            $(this).addClass('icon-33');
			
			$('.' + val_selector).val(1);
        }
        else{
            parent.addClass('add_ad_vip_block__item_grey');
            $(this).removeClass('icon-33');
            $(this).addClass('icon-32');
			
			$('.' + val_selector).val(0);
        }

        calcTotalSumVIPAd();
		
    });
	
	/************ set sum for vip adverts ********************/
    $(document).on('change','.js-vip_view-input',function () {
        var text = 'AED ';
        var value = parseInt($(this).val());
        if (value > 0)
            text = text + (value * 0.25);
        else
            text = text + '0';

        $('#add_ad_vip_block__4').data('sum', (value * 0.25));

        $('.js-vip_view-value').html(text);

        calcTotalSumVIPAd();
    });
	
	/******************* calculate all sum to ad **************/
    function calcTotalSumVIPAd () {
		var def_sum = parseInt($('.js-default-user-balans').val());
		
        var sum = 0;
        var sum_1 = 0;
        var sum_2 = 0;
        var sum_3 = 0;
        var sum_4 = 0;

        if (!$('#add_ad_vip_block__1').hasClass('add_ad_vip_block__item_grey'))
            sum_1 = parseInt($('#add_ad_vip_block__1').data('sum'));
        if (!$('#add_ad_vip_block__2').hasClass('add_ad_vip_block__item_grey'))
            sum_2 = parseInt($('#add_ad_vip_block__2').data('sum'));
        if (!$('#add_ad_vip_block__3').hasClass('add_ad_vip_block__item_grey'))
            sum_3 = parseInt($('#add_ad_vip_block__3').data('sum'));
        if (!$('#add_ad_vip_block__4').hasClass('add_ad_vip_block__item_grey'))
            sum_4 = parseInt($('#add_ad_vip_block__4').data('sum'));

        sum = sum_1 + sum_2 + sum_3 + sum_4;
		
		$('.js-total-vip-sum').data('total-cost', sum);

        if (sum > 0)
            $('.js-total-vip-sum').html('AED ' + sum);
        else
            $('.js-total-vip-sum').html('FREE');
		
		if (sum > def_sum){
			$('.js-default-user-balans-info').css('display', 'block');
		}
		else {
			$('.js-default-user-balans-info').css('display', 'none');
		}
			
    }
	
	
	
	/********* upload resume *****************/
	$(document).on( "change",'.add_ad_modal__body .add_ad_resume_file', function() {
		console.log('hi from hell');
		
        var file = $(this);
        //var form_close = file.closest( ".upload_logo" );
        var formData = new FormData();
        formData.append( 'image', $(this)[0].files[0] );
        //var formData = new FormData(form_close[0]);
        $.ajax({
            url: "/company/file",
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
				console.log(data);
				/* 
					var img = '';
                    img = img + '<div class="add_ad_feilds__left" style="position: relative;">' 
									+ "<div class='add_ad_feilds__upload js-add_ad_feilds__upload' style='cursor: pointer' data-img='" + data + "'>" 
										+ '<img src="'+data+'" style="max-width: 100%; max-height: 100%;">' 
										+ '<input type="hidden" name="ad_img[]" value="'+data+'">'
									+ '</div>' 
									+ '<i class="js-del-ad-add-photo delete" style="position: absolute; bottom: -9px; color: red; right: 0; cursor: pointer;"></i>'
									+ '<span class="js-to-main-add-photo" style="position: absolute; top: 10px; color: #fff; right: 2px; cursor: pointer; font-size: 12px; background: green; padding: 2px 3px; display: none;" data-img="'+data+'">main photo</span>'
								+ '</div>';
                    $( ".add_ad_feilds__left:last" ).before( img );
				*/
                if (data!='0' && data!='1') {
					$('.js_okqweoqiajsdh_129389').remove();
					
					var img = '';
                    img = img + '<div class="add_ad_feilds__left js_okqweoqiajsdh_129389" style="position: relative;" >' 
									+ "<div class='add_ad_feilds__upload ' style='cursor: pointer' data-img='" + data + "'>" 
										+ '<a href='+data+'><img src="/front/file_resume.png" style="max-width: 100%; max-height: 100%;"></a>' 
									+ '</div>' 
									+ '<i class="js-del-ad-add-photo delete" style="position: absolute; bottom: -9px; color: red; right: 0; cursor: pointer;"></i>'
								+ '</div>';
                    $( ".add_ad_feilds__left:last" ).before( img );
					
                    //$('.add_ad_resume_value').val(data);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
	
	//$('textarea[name="note"]').attr('placeholder', 'Enter your ad description');
	//$('.add_ad_field[name="title"]').attr('placeholder', 'Short title of your ad(max 40 symbols)');
	
	$(document).on( "click",'.add_ad_modal__body .js-add-ad-area', function() {
		var city = $('.js_add_ad_select_city_id option:selected').text();
		$(this).val(city + ', ');
	});
	
	/************** set urgent and hot deal***************/
	$(document).on( "click",'.add_ad_modal__body .js-add_ad_hot_deal_click', function() {
		if (parseInt($('.js_add_ad_select_cat_1').val()) == 9) // Found and lost
			return false;
		
		if (parseInt($('.js_add_ad_select_cat_1').val()) == 8) // Events and  Exebitions
			return false;
			
		if (parseInt($('.js_add_ad_select_cat_1').val()) == 3) //Jobs
			return false;
		
		if (parseInt($('.js_add_ad_select_cat_2').val()) == 94) //Partnership
			return false;
			
			
		if ($(this).hasClass('icon-32')){
			$(this).removeClass('icon-32');
			$(this).addClass('icon-33');
			
			$(this).addClass('active');
			
			if ($('.js-add_ad_urgent_click').hasClass('active'))
				$('.js-add_ad_urgent_click').click();
			
			$('.js_add_advert_is_hot').val(1);
			
			if ($('#add_ad_vip_block__3').hasClass('add_ad_vip_block__item_grey'))
				$('#add_ad_vip_block__3').removeClass('add_ad_vip_block__item_grey');
		}
		else {
			$(this).removeClass('icon-33');
			$(this).addClass('icon-32');
			
			$(this).removeClass('active');
			
			$('.js_add_advert_is_hot').val(0);
			
			if (!$('#add_ad_vip_block__3').hasClass('add_ad_vip_block__item_grey') && ($('.js_add_advert_is_urgent').val() == 0 || $('.js_add_advert_is_urgent').val() == '0'))
				$('#add_ad_vip_block__3').addClass('add_ad_vip_block__item_grey');
		}
		
		if ($('.js-add_ad_hot_deal_click').hasClass('active') || $('.js-add_ad_urgent_click').hasClass('active'))
			$('#add_ad_vip_block__3').data('sum', 0);
		else 
			$('#add_ad_vip_block__3').data('sum', 0);
		
		calcTotalSumVIPAd();
	});
	
	$(document).on( "click",'.add_ad_modal__body .js-add_ad_urgent_click', function() {
		if (parseInt($('.js_add_ad_select_cat_1').val()) == 9) // Found and lost
			return false;
		
		if (parseInt($('.js_add_ad_select_cat_1').val()) == 8) // Events and  Exebitions
			return false;
		
		
		if (parseInt($('.js_add_ad_select_cat_1').val()) == 4) // Services
			return false;
		
		if (parseInt($('.js_add_ad_select_cat_2').val()) == 97 ||  parseInt($('.js_add_ad_select_cat_2').val()) == 96) // Business  Distirbutorship || Franchising
			return false;
		
		if (parseInt($('.js_add_ad_select_cat_2').val()) == 22) // Auto repairs
			return false;
			
		if ((parseInt($('.js_add_ad_select_cat_1').val()) == 3 &&  parseInt($('.js_add_ad_select_cat_2').val()) == 33)) // jobs cv
			return false;
			
		if ($(this).hasClass('icon-32')){
			$(this).removeClass('icon-32');
			$(this).addClass('icon-33');
			
			$(this).addClass('active');
			
			if ($('.js-add_ad_hot_deal_click').hasClass('active'))
				$('.js-add_ad_hot_deal_click').click();
			
			$('.js_add_advert_is_urgent').val(1);
			
			if ($('#add_ad_vip_block__3').hasClass('add_ad_vip_block__item_grey'))
				$('#add_ad_vip_block__3').removeClass('add_ad_vip_block__item_grey');
		}
		else {
			$(this).removeClass('icon-33');
			$(this).addClass('icon-32');
			
			$(this).removeClass('active');
			
			$('.js_add_advert_is_urgent').val(0);
			
			if (!$('#add_ad_vip_block__3').hasClass('add_ad_vip_block__item_grey') && ($('.js_add_advert_is_hot').val() == 0 || $('.js_add_advert_is_hot').val() == '0'))
				$('#add_ad_vip_block__3').addClass('add_ad_vip_block__item_grey');
		}
		
		if ($('.js-add_ad_hot_deal_click').hasClass('active') || $('.js-add_ad_urgent_click').hasClass('active'))
			$('#add_ad_vip_block__3').data('sum', 0);
		else 
			$('#add_ad_vip_block__3').data('sum', 0);
		
		calcTotalSumVIPAd();
	});
	
	$(document).on( "click",'.add_ad_modal__body .js-add-ad-price-free', function() {
		if ($(this).prop('checked')){
			$(".js-add-ad-price-value").prop('disabled', true);
			$(".js-add-ad-price-value").val('0');
			
		}
		else {
			$(".js-add-ad-price-value").prop('disabled', false);
		}
	});
	
	
});
