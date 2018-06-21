jQuery( document ).ready( function( $ ) {
	/*********** select company type functions *************/
    $('.js_com_cat').click (function (){
        var id = $(this).data('id');

        $('.reg_company_type_id').val(id);
		
		$('.js_com_cat').removeClass('active');
		$(this).addClass('active');

        $( ".b_com_cat.open[data-id!='"+id+"']" ).removeClass('open');

        if (!$('#b_com_cat_'+id).hasClass('open'))
            $('#b_com_cat_'+id).addClass('open')
    });
	
	/*********** replace company phone and mobile *******/
	$('.body').on( "click",'.js-registr-company-phone', function() {
		var set_default_val = $(this).data('set-default-val');
		if (set_default_val == '1')
			return true;
		
		$(this).data('set-default-val', '1');
		$(this).val('+9 (71)');
	});
	$('.body').on( "click",'.js-registr-company-mobile', function() {
		var set_default_val = $(this).data('set-default-val');
		if (set_default_val == '1')
			return true;
		
		$(this).data('set-default-val', '1');
		$(this).val('+9 (71)');
	});
	
	/********* copy company registr field ************/
	var max_cousine = $('.js-counsinea').length;
	var max_location = 1;
	 $('.b_req_input_add').click(function () {
		if ($(this).data('type') == 'jaosdfjoasidf'){
			if (max_cousine == 3)
				return true;
			
			max_cousine++;
		}
		
		if ($(this).data('type') == 'location'){
			if (max_location == 3)
				return true;
			
			max_location++;
		}
		
        var parent_row = $(this).parent().parent();
        var input = parent_row.find('.js-input').html();
        parent_row.after('<div class="row"><div class="col-md-90 js-input">' + input + '</div>'+
								'<div class="col-md-5 col-md-offset-5 js-company-field">'+
									'<img src="/front/img/icons/link_minus.png" class="b_req_input_del" data-type="'+$(this).data('type')+'" style="margin-top: 12px; cursor: pointer; width: 17px; height: 17px;"></div></div>');
        var next_row = parent_row.next();
        next_row.find('.b_req_input').val('');
		
		$.mask.definitions['9'] = '';
		$.mask.definitions['n'] = '[0-9]';
		$(".phone_uae").mask("+ (971) nn nnn-nnnn");
    });
	
	$( ".body" ).on( "click",'.b_req_input_del', function() {
		if ($(this).data('type') == 'jaosdfjoasidf'){			
			max_cousine--;
		}
		
		if ($(this).data('type') == 'location'){
			max_location--;
		}
		
		if ($(this).data('type') == 'phone'){
			max_phone--;
		}
		
		if ($(this).data('type') == 'mobile'){
			max_mobile--;
		}
		
		
		
		$(this).parent().parent().remove();
	});
	
	$(document).on("focus", ".phone_uae", function() { 
		//$(this).mask("99:99");
		$.mask.definitions['9'] = '';
		$.mask.definitions['n'] = '[0-9]';
		$(this).mask("+ (971) nn nnn-nnnn");
	});
	
	var max_phone = 1;
	$('.js_aosdfkaposdfk').click(function(){
		if (max_phone == 3)
				return true;
			
			max_phone++;
			
		var parent_row = $(this).parent().parent();
		var input = '<input class="phone_uae b_req_input" type="tel" placeholder="Phone" name="phone[]" />';
        parent_row.after('<div class="row"><div class="col-md-90 js-input">' + input + '</div>'+
								'<div class="col-md-5 col-md-offset-5 js-company-field">'+
									'<img src="/front/img/icons/link_minus.png" class="b_req_input_del" data-type="phone" style="margin-top: 12px; cursor: pointer; width: 17px; height: 17px;"></div></div>');
        var next_row = parent_row.next();
        next_row.find('.b_req_input').val('');
		
		$.mask.definitions['9'] = '';
		$.mask.definitions['n'] = '[0-9]';
		$(".phone_uae").mask("+ (971) nn nnn-nnnn");
	});
	
	var max_mobile = 1;
	$('.asdasdasczxcsa2123123asd').click(function(){
		if (max_mobile == 3)
				return true;
			
			max_mobile++;
			
		var parent_row = $(this).parent().parent();
		var input = '<input class="phone_uae b_req_input " type="tel" placeholder="Mobile" name="mobile[]" />';
        parent_row.after('<div class="row"><div class="col-md-90 js-input">' + input + '</div>'+
								'<div class="col-md-5 col-md-offset-5 js-company-field">'+
									'<img src="/front/img/icons/link_minus.png" class="b_req_input_del" data-type="mobile" style="margin-top: 12px; cursor: pointer; width: 17px; height: 17px;"></div></div>');
        var next_row = parent_row.next();
        next_row.find('.b_req_input').val('');
		
		$.mask.definitions['9'] = '';
		$.mask.definitions['n'] = '[0-9]';
		$(".phone_uae").mask("+ (971) nn nnn-nnnn");
	});
	
	/*********** add company cat to step 1 ***************/
	count_dining_cat = 1;
	count_shop_shop_cat = 1;
	count_shop_service_cat = 0;
	count_service_service_cat = 1;
	count_service_shop_cat = 0;
	var cat; 
	var block;
    $('.link_plus').click(function () {
        cat = $(this).data('cat');
        block = $(this).data('block');
		// �������� ������������� ��������� ��������� ��� ����������
		if (block == 'dinning' && count_dining_cat >= 3){
			alert('Max 3 categories in "Dinning & Outing"');
			return false;
		}
		
		if (block == 'dinning')
			count_dining_cat++;
		
		// �������� ������������� ��������� ��������� ��� ���������
		if (block == 'shop' && cat == 'service' && count_shop_service_cat >= 2){
			alert('Max 2 service provider categories');
			return false;
		}
		else if (block == 'shop' && cat == 'shop' && count_shop_shop_cat >= 2){
			alert('Max 2 shop categories');
			return false;
		}
		if (block == 'shop' && cat == 'service'){
			count_shop_service_cat++;
		}
		else if (block == 'shop' && cat == 'shop'){
			count_shop_shop_cat++;
		}
		
		// ���������� ���������� ������������ ���� ���������
		if ((block == 'shop' && cat == 'service') || (block == 'service' && cat == 'shop')){
			$('.b_com_cat_shop').addClass('active');
			$('.b_com_cat_service').addClass('active');
		}
		
		// �������� ������������� ���������� ��������� ��� ������� 
		if (block == 'service' && cat == 'shop'  && count_service_shop_cat >= 2){
			alert('Max 2 shop categories');
			return false;
		}
		if (block == 'service' && cat == 'service' && count_service_service_cat >= 2){
			alert('Max 2 service provider categories');
			return false;
		}
		
		if (block == 'service' && cat == 'shop')
			count_service_shop_cat = count_service_shop_cat + 1;
		if (block == 'service' && cat == 'service')
			count_service_service_cat++;
		
		
		
        $("." + cat + "_cats:first").clone().appendTo("." + block + "-cat-block");
		
		var added_element = $("." + block + "-cat-block");
		var del_company_link = added_element.find('.del-company-cat:last');
		var val_select_cat = added_element.find('.b_sel_blue:last');
		val_select_cat.val('');
		del_company_link.css('display', 'block');
		del_company_link.data('block', block);
		del_company_link.data('cat', cat);
		
    });
	
	/*************** delete company cat **************/
	$( ".body" ).on( "click",'.del-company-cat', function() {
		var parent = $(this).parent().parent();
		var block = $(this).data('block');
		var cat = $(this).data('cat');
		
		if (block == 'service' && cat == 'shop')
			count_service_shop_cat = count_service_shop_cat - 1;
		if (block == 'service' && cat == 'service')
			count_service_service_cat--;
		
		if (block == 'shop' && cat == 'service'){
			count_shop_service_cat--;
		}
		else if (block == 'shop' && cat == 'shop'){
			count_shop_shop_cat--;
		}
		
		if (block == 'dinning')
			count_dining_cat--;
			
		parent.remove();
	});
	
	/*************** change step regostration company ************/
	var validator = $( ".main_from_req_company" ).validate();
    $('.js-bot_step').click(function () {
        var id = $(this).data('id');

        if (id == '0') {
            $('.req_com_modal').removeClass('open');
            $('.login-modal').addClass('open');
			
			$( ".js-req-com-step" ).removeClass('active');
            $(".js-req-com-step.step_1").addClass('active');
			
			$( ".req_com_modal__body" ).removeClass('active');
			$('#req_com_tab_1').addClass('active');
			
            return true;
        }

        if (id == '2'){
            var validate_city = validator.element( ".registr_company_city" );
            var validate_cat_id = validator.element( ".b_com_cat.open .reg_company_cat_id" );
            if (!validate_city || !validate_cat_id)
                return true;
				
			var company_type_id = $('.reg_company_type_id').val();
			company_type_id = parseInt(company_type_id);
			if (company_type_id == 1) {
				$('.license_block').hide();
				$('.upload_logo__circle ').css('border-radius', '0%');
				$('.js-restoran-field').show();
				$('.js-company-field').hide();
			}
			else {
				$('.license_block').show();
				$('.upload_logo__circle ').css('border-radius', '0%');
				$('.js-restoran-field').hide();
				$('.js-company-field').show();
			}
        }

        if (id == '3'){
            var ar_result = [];
			
            var validate_password = validator.element( ".ValidatePassword" );
            
            if (!validate_password)
                return true;

			var company_type_id = $('.reg_company_type_id').val();
			company_type_id = parseInt(company_type_id);

            $( "#req_com_tab_2 .b_req_input" ).each(function( index, value ) {
                ar_result.push(validator.element( "#req_com_tab_2 .b_req_input:eq("+index+")" ));
				
				
				if (company_type_id != 1) {
					if ($('.license_block__hidden').val() == ''){
						ar_result.push(false);
						$('.license_block__input').css('border', '1px solid red');
					}
					else 
						$('.license_block__input').css('border', '1px solid #15499f');
					
					if ($('.upload_logo__hidden').val() == ''){
						ar_result.push(false);
						$('.upload_logo__circle').css('border', '1px solid red');
					}
					else 
						$('.upload_logo__circle').css('border', '1px solid #15499f');
				}
            });
			
			if ($('.js_check_user_isset_mail').attr('ebuchii_atr') == '1'){
				$('.js_check_user_isset_mail').addClass('error');
				$('.js_check_user_isset_mail').after( "<label id=\"email-error-check-isset\" class=\"error\" for=\"email\" style=\"display: block;\">This email has been registered already, please use other one</label>" )
				console.log('suki sdohnite ');
				
				ar_result.push(false);
			}
			else {
				$('.js_check_user_isset_mail').removeClass('error');
				$('#email-error-check-isset').remove();
			}

			if ($('.password2').attr('ebuchii_atr') == '1'){
				$('.password2').addClass('error');
				$('.password2').after( "<label id=\"email-error-check-isset\" class=\"error\" for=\"email\" style=\"display: block;\">Password doesn't match</label>" )
				console.log('password doesnt match');
				
				ar_result.push(false);
			}
			else {
				$('.password2').removeClass('error');
				$('#email-error-check-isset').remove();
			}
				

            if ( $.inArray( false, ar_result ) > -1 )
                return true;

            ar_result = [];
			
			var company_type_id = $('.reg_company_type_id').val();
			company_type_id = parseInt(company_type_id);
			
			if (company_type_id == 1) {
				$('.js-registr-company-restoran').show();
				$('.js-registr-company-other').hide();
				$('.js_select_req_plan__value').val('0');
			}
			else {
				$('.js-registr-company-restoran').hide();
				$('.js-registr-company-other').show();
				$('.js_select_req_plan__value').val('0');
			}
			
			
			/*
			grecaptcha.render('html_element_captcha', {
			  'sitekey' : '6Ld_Iw0UAAAAANeFYAF6VXy0zI34BovEU8lVnuBX'
			});
			*/
        }


        if (!$(".js-req-com-step[data-id='"+id+"']").hasClass('active')) {
            $( ".js-req-com-step.active[data-id!='"+id+"']" ).removeClass('active');
            $(".js-req-com-step[data-id='"+id+"']").addClass('active');
        }


        $( ".req_com_modal__body.active[data-id!='"+id+"']" ).removeClass('active');

        if (!$('#req_com_tab_'+id).hasClass('active'))
            $('#req_com_tab_'+id).addClass('active');
    });
	
	/************* get company subcat functions *************/
	$( ".req_com_modal" ).on( "change",'.js_reg_com_cat', function() {
        var parent = $(this).parent().parent();
        var cat = $(this);
        var subcat = parent.find( ".reg_company_subcat_id" );
        if (cat.val() == ''){
			subcat.empty();
			subcat.addClass('hide');
			return false;
		}
		
        $.post("/company/get/subcat", { cat_id: cat.val() } ).done(function( data ) {
            data = JSON.parse(data);
            if (jQuery.isEmptyObject(data)){
                subcat.empty();
				subcat.addClass('hide');
				return false;
			}
			
			Array.prototype.sort.call( data, function( a, b ) {
				return a[2] > b[2] ? 1 : a[2] < b[2] ? -1 : 0;
			});
			console.log( JSON.stringify( data ) );


			
            subcat.attr('name', 'subcat_id['+cat.val()+'][]');
            subcat.empty();

			$.each( data, function( key, value ) {
				subcat.append( '<option value="' + key + '">' + value + '</option>' );
			});

            subcat.removeClass('hide');
        });
    });
	
	/************* add company license block function *************/
	$( ".req_com_modal" ).on( "click",'.js_add_license', function() {
		/*
        var parent = $(this).closest('.license_block__input');
        var form = parent.find('reg_upload_form');

        var parent_html = "<div class='license_block__input'>" + parent.html() + "</div>";
        parent.after(parent_html);

        var inserted = parent.next();

        var child_image = inserted.find('.js_req_upload_image').attr('src', '');
		*/
		$('.js_req_upload_file').click();
    });
	
	/********** upload company license file function ***************/
	$( ".req_com_modal" ).on( "change",'.js_req_upload_file', function() {
        var file = $(this);
        var form_close = file.closest( ".license_block__input" );
        var formData = new FormData();
        formData.append( 'image', $(this)[0].files[0] );
        $.ajax({
            url: "/company/image",
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                if (data!='0' && data!='1') {
                    form_close.find('.js_req_upload_image').attr('src', data);
                    form_close.find('.license_block__hidden').val(data);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
	
	/********** upload company logo file function ****************/
	$( ".body" ).on( "change",'.upload_logo__file', function() {
        var file = $(this);
        var form_close = file.parent( ".upload_logo" );
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
                    var circle = form_close.find('.upload_logo__circle');
                    var img = "<img class='upload_logo__image js_upload_logo_image' src='"+data+"' />";
                    circle.empty();
                    if (!circle.hasClass('with_image'))
                        circle.addClass('with_image');
                    circle.html(img);
                    form_close.find('.upload_logo__hidden').val(data);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
	
	/************** select company plan function **************/
	$('.js_select_req_plan').click(function(){
        if ($(this).hasClass('active'))
            return true;
		/*
        if ($(this).hasClass('plan_prem__button'))
            $('.js_select_req_plan__value').val(1);
        else
            $('.js_select_req_plan__value').val(0);
		*/
		
        $('.js_select_req_plan').removeClass('active');
        $(this).addClass('active');
    });
	
	/********* send company registr from function ***********/
	var count_submit_req_submit = 0;
    $('.js_req_com_complite').click (function () {
       
		
		validator.element( ".js-check-regist-company-agree" );
		if (!$(".js-check-regist-company-agree").is(':checked')){
			console.log('note checked');
			return true;
		}
		
		count_submit_req_submit = count_submit_req_submit + 1;
        if (count_submit_req_submit > 1)
            return true;
		
		
        $('.b_com_cat:not(.open)').remove();
		
		if ($('.reg_company_type_id').val() == 1 || $('.reg_company_type_id').val() == '1')
			$('.js_select_req_plan__value').val(0);

        $('.main_from_req_company').submit();
    });
	
	/********** add restoran branch function *****************/
	var max_branch = 0;
	$('.js-restoran-branch-add').click(function(){
		if (max_branch == 3)
			return true;
		max_branch++;
		
		var parent = $(this).parent();
		var new_branch = $('.js-restoran-sample-branch').html();
		parent.after('<div class="row">'+
							'<div class="col-md-90 "style="margin-top: 15px; border-top: 1px solid #d41f26;">'+
								'<input class="b_req_input normalValidate " id="txtPlaces" required="required" type="text" placeholder="Location" name="location[]" >'+
                            '</div>' + 
							'<div class="col-md-90 "style="margin-bottom: 15px; border-bottom: 1px solid #d41f26;">'+
                                '<input class="phone_uae b_req_input" type="tel" placeholder="Phone" name="phone[]" />'+
                            '</div>'+
							'<div class="col-md-5 col-md-offset-5 js-company-field">'+
								'<img src="/front/img/icons/link_minus.png" class="js_aosdfkaposdfklink_minus" style=\'margin-top: 12px; cursor: pointer; width: 17px; height: 17px;\'/>' +
                            '</div>'+
						'</div>');
	});
	
	$( ".body" ).on( "click",'.js_aosdfkaposdfklink_minus', function() {
		$(this).parent().parent().remove();
		max_branch--;
	});
	
	
	/******** check user mail ************/
	$( ".body" ).on( "change",'.js_check_user_isset_mail', function() {
		console.log('js_check_user_isset_mail val - ' + $(this).val());
		var email = $(this).val();
		var el = $(this);
		$.post("/email", { email: email } ).done(function( data ) {
            data = JSON.parse(data);
			if (data == 0 || data == '0'){
				if (!el.hasClass('error')){
					el.addClass('error');
					el.after( "<label id=\"email-error-check-isset\" class=\"error\" for=\"email\" style=\"display: block;\">This email has been registered already, please use other one</label>" )
					el.attr('ebuchii_atr', '1');
				}
					
			}
			else {
				el.removeClass('error');
				$('#email-error-check-isset').remove();
				el.removeAttr('ebuchii_atr');
			}
				
				
			console.log('return data - ' + data);
        });
	});
	
	/************* check password match ************/

	$( ".body" ).on( "change",'.password2', function() {
		console.log('validate password - ' + $(this).val());

		var pass1 = $('.password1').val();
		console.log('validate password - ' + pass1);
    	var pass2 = $(this).val();

		
		var ell = $(this);
		
			if (pass1 != pass2){
				if (!ell.hasClass('error')){
					ell.addClass('error');
					ell.after( "<label id=\"email-error-check-isset\" class=\"error\" for=\"email\" style=\"display: block;\">Password doesn't match</label>" )
					ell.attr('ebuchii_atr', '1');
				}
				console.log('return data - ' + 1);
			}
			else {
				ell.removeClass('error');
				$('#email-error-check-isset').remove();
				ell.removeAttr('ebuchii_atr');
			}
        
	});

	/************* check user 222 mail ************/

	
	$( ".body" ).on( "change",'.js_check_user_isset_mail_2222', function() {
		console.log('js_check_user_isset_mail_2222 val - ' + $(this).val());
		var email = $(this).val();
		var el = $(this);
		$.post("/email", { email: email } ).done(function( data ) {
            data = JSON.parse(data);
			
			if (data == 0 || data == '0'){
				if (!el.hasClass('error')){
					el.addClass('error');
					el.after( "<label id=\"email-error-check-isset\" class=\"error\" for=\"email\" style=\"display: block;\">This email has been registered already, please use other one</label>" )
					
				}
			}
			else {
				el.removeClass('error');
				$('#email-error-check-isset').remove();
			}
				
				
			console.log('return data - ' + data);
        });
	});
	
//	$( ".body" ).on( "click",'.js_check_user_isset_mail_2222', function() {
//		console.log('js_check_user_isset_mail_2222 val - ' + $(this).val());
//		var email = $(this).val();
//		var el = $(this);
//		$.post("/email", { email: email } ).done(function( data ) {
//	        data = JSON.parse(data);
//			console.log('js_check_user_isset_mail_2222 data ' + data);
//			if (data == 0 || data == '0'){
//				if (!el.hasClass('error')){
//					el.addClass('error');
//					el.after( "<label id=\"email-error-check-isset\" class=\"error\" for=\"email\" style=\"display: block;\">This email has been registered already, please use other one</label>" )
//					
//				}
//			}
//			else {
//				el.removeClass('error');
//				$('#email-error-check-isset').remove();
//			}
//				
//				
//			console.log('return data - ' + data);
//	    });
//	});
	
	$('.js_check_user_isset_mail_2222').blur(function(){
		console.log('js_check_user_isset_mail_2222 val - ' + $(this).val());
		var email = $(this).val();
		var el = $(this);
		$.post("/email", { email: email } ).done(function( data ) {
            data = JSON.parse(data);
			console.log('js_check_user_isset_mail_2222 data ' + data);
			if (data == 0 || data == '0'){
                window.sessionStorage.setItem('error_registration.email', 1);
				if (!el.hasClass('error')){
					el.addClass('error');
					el.after( "<label id=\"email-error-check-isset\" class=\"error\" for=\"email\" style=\"display: block;\">This email has been registered already, please use other one</label>" )
					
				}
			}
			else {
                window.sessionStorage.setItem('error_registration.email', 0);
				el.removeClass('error');
				$('#email-error-check-isset').remove();
			}
				
				
			console.log('return data - ' + data);
        });
	});

});

