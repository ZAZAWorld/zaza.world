jQuery( document ).ready( function( $ ) {
    /******* open and close login modal *****/
    $( "body" ).on( "click",'.js-login', function() {
        if ($('.login-modal').hasClass('open')) {
            $('.login-modal').removeClass('open');
            $('.wrapper').removeClass( "total_blur" );
            $('body').removeClass( "modal_open" );
        }
        else {
            $('.login-modal').addClass('open');
            $('.wrapper').addClass( "total_blur" );
			$('body').addClass( "modal_open" );
        }
    });

    $('.login-modal__close').click(function(){
        $('.login-modal').removeClass('open');
        $('.wrapper').removeClass( "total_blur" );
		$('body').removeClass( "modal_open" );
    });

    /******** open and close registration company modal *****/
    $('.b_req_company').click (function (){
        $('.login-modal').removeClass('open');
        $('.req_com_modal').addClass('open');
    });

    $('.req_com_modal__close').click(function(){
        $('.req_com_modal').removeClass('open');
        $('.wrapper').removeClass( "total_blur" );
		$('body').removeClass( "modal_open" );
		
		$( ".js-req-com-step" ).removeClass('active');
		$(".js-req-com-step.step_1").addClass('active');
		
		$( ".req_com_modal__body" ).removeClass('active');
		$('#req_com_tab_1').addClass('active');
		
		location.reload();
    });
	
    /****** open and close forget password modal ****/
    $('.b_req_forgot').click (function (){
        $('.login-modal').removeClass('open');
        $('.f_pass_modal').addClass('open');
    });

    $('.f_pass_modal__close').click(function(){
        $('.f_pass_modal').removeClass('open');
        $('.wrapper').removeClass( "total_blur" );
		$('body').removeClass( "modal_open" );
    });
	
	/************** send login form ************/
    $('.b_req_login').click(function () {
        $('.b_req_login_form').submit();
    });
	
	/*************** open and close registr person functions ****************/
	$('.js-open-reg_simple_user_form').click(function(){
		$('.login-modal').removeClass('open');

		var dialog = $('.reg_simple_user');
		if (dialog.hasClass('open')){
			dialog.removeClass('open');
            $('.wrapper').removeClass( "total_blur" );
			$('body').removeClass( "modal_open" );
		}
		else {
			if (!$('.wrapper').hasClass("total_blur"))
				$('.wrapper').addClass( "total_blur" );
				$('body').addClass( "modal_open" );
			dialog.addClass('open');
		}
	});
	
	$('.reg_simple_user__close').click(function(){
        $('.reg_simple_user ').removeClass('open');
        $('.wrapper').removeClass( "total_blur" );
		$('body').removeClass( "modal_open" );
		
		$( ".js-req-com-step" ).removeClass('active');
		$(".js-req-com-step.step_1").addClass('active');
		
		
		location.reload();
    });
	
	/************ check forget password check ************/
	$('.js-forget_password_submit').click(function(){
		var email = $.trim($('.js-forget_password_email').val());
		
		if (email  === '') {
			alert('Text-field is empty.');
			return false;
		}

		if (grecaptcha.getResponse() == ""){
			alert("You can't proceed!");
			return false;
		} 
		
		$('#js-forget_password_form').submit();
	});
    window.sessionStorage.setItem('error_registration.phone', 0);
    window.sessionStorage.setItem('error_registration.email', 0);
    $('.js_check_user_isset_phone_2222').blur(function(){
        console.debug($(this).val().length);
        if($(this).val().length > 9) {
            console.log('js_check_user_isset_phone_2222 val - ' + $(this).val());
            var phone = $(this).val();
            var el = $(this);
            $.post("/checkPhone", {phone: phone}).done(function (data) {
                data = JSON.parse(data);
                console.log('js_check_user_isset_phone_2222 data ' + data);
                if (data == 0 || data == '0') {
                    window.sessionStorage.setItem('error_registration.phone', 1);
                    if (!el.hasClass('error')) {
                        el.addClass('error');
                        el.after("<label id=\"phone-error-check-isset\" class=\"error\" for=\"phone\" style=\"display: block;\">This phone has been registered already, please use other one</label>")
                    }
                }
                else {
                    window.sessionStorage.setItem('error_registration.phone', 0);
                    el.removeClass('error');
                    $('#phone-error-check-isset').remove();
                }


                console.log('return data - ' + data);
            });
        }
    });
    /************ Register personal account *************/
    $(document).on('submit', '#reg_simple_user_form', function(){
        var activation_code = $('#activation_code').prop('value');
        if(window.sessionStorage.getItem('error_registration.phone') == 0 &&
            window.sessionStorage.getItem('error_registration.email') == 0) {
            if (activation_code.length <= 0) {
                $('#activation_code_row').show();
                $('.b_com_next').attr('value', 'Activate account');
                var _data = $(this).serialize();
                var _url = $(this).attr('action');
                $.ajax({
                    url: _url,
                    type: 'POST',
                    data: _data,
                    async: true,
                    dataType: 'json',
                    success: function (data) {
                        window.sessionStorage.setItem('confirm_code', data.confirm_active);
                        window.sessionStorage.setItem('user_id', data.id);
                    }
                });
            }
            else {
                $('#activation_code-error').remove();
                if (window.sessionStorage.getItem('confirm_code') == activation_code) {
                    var user_id = window.sessionStorage.getItem('user_id');
                    window.sessionStorage.removeItem('confirm_code');
                    window.sessionStorage.removeItem('user_id');
                    $('#activation_code').after('Code is being checked...');
                    $.ajax({
                        url: '/registration_real',
                        type: 'POST',
                        data: 'user_id='+user_id,
                        async: true,
                        dataType: 'json',
                        success: function (data) {
                            if('result' in data) {
                                window.location = '/activate-account/?user_id=' + data.result.user_id +
                                    '&pass=' + data.result.confirm_code;
                            }
                        }
                    });
                }
                else {
                    $('#activation_code').after('<label id="activation_code-error" class="error" for="activation_code">Code isn`t right</label>');
                }
            }
        }
        else{
            if(window.sessionStorage.getItem('error_registration.phone') == 1){
                $('.js_check_user_isset_phone_2222').addClass('error');
                $('.js_check_user_isset_phone_2222').after("<label id=\"phone-error-check-isset\" class=\"error\" for=\"phone\" style=\"display: block;\">This phone has been registered already, please use other one</label>")
            }
            if(window.sessionStorage.getItem('error_registration.email') == 1){
                //email-error-check-isset
                $('.js_check_user_isset_mail_2222').addClass('error');
                $('.js_check_user_isset_mail_2222').after("<label id=\"email-error-check-isset\" class=\"error\" for=\"email\" style=\"display: block;\">This email has been registered already, please use other one</label>")
            }
        }
        return false;
    });
});
