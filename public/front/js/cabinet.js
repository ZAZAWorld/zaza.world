jQuery( document ).ready( function( $ ) {
	// logo tooltip functions
    $('.logo_tooltip').qtip({ 
        content: {
            text: $('.logo_tooltip_block')
        },
        style: {
            classes: ' qtip-bootstrap',
            tip: {
               corner: true
           }
        },
        hide: {
            delay: 4000
        },
        corner: 'rightMiddle',
        position: {
            my: 'left center',
            at: 'right center'
        }
    });
	// upload logo functions
    $(".logo_tooltip_block__update").on('click', function(e){
        e.preventDefault();
        $(".logo_tooltip_block__file:hidden").trigger('click');
    });
    $(".logo_tooltip_block__file").change(function(){
        $("#logo_tooltip_block__form").submit();
    });
    $("#logo_tooltip_block__form").submit(function(){
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "/personal-cabinet/send",
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                if (data!='0' && data!='1') {
                    $('.js_logo').data('before', $('.js_logo').css( "background" ));
                    $('.js_logo').css( "background" , "url('"+data+"') no-repeat center center");
					$('.js_logo').css( "background-size" , "cover");
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });

        return false;
    });
	// logo delete function
    $(".logo_tooltip_block__delete").click(function() {
        $.post("/personal-cabinet/send", { name: 'photo', value: $('.js_logo').data('before'), type: 'photo_before' } ).done(function( data ) {
            $('.js_logo').data('before', $('.js_logo').css( "background" ));
            $('.js_logo').css( "background" , "url('"+data+"') no-repeat center center");
            
        });

    });
	
	// input auto size functions
    $('.form_update_input').autoResize();
	
	/*********** edit input fields function ***********/
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
    $('.form_update_pencil').click(function(){
        var id = $(this).data('id');

        swithHideInput(id, true);
    });
    $('.form_update_ok').click(function(){
        var id = $(this).data('id');
        var input = $(".form_update_input[data-id='" + id + "']");

        $.post("/personal-cabinet/send", { name: input.data("id"), value: input.val(), type:  input.data("type") } ).done(function( data ) {

        });

        swithHideInput(id, true);
    });
    $('.form_update_cancel').click(function(){
        var id = $(this).data('id');

        swithHideInput(id, false);
    });
	
	// select interest functions
    $('.p_p_interest_new_block_button_block_hover').click(function () {
        if ($(this).hasClass('unselect')){
            $(this).removeClass('unselect');
            insertParam('add_interest', $(this).data('id'));
        }
        else {
            $(this).addClass('unselect');
            insertParam('add_interest', $(this).data('id'));
        }
    });
	
	// upload img for blog
    $(".p_p_add_blog__img").on('click', function(e){
        e.preventDefault();
        $(".p_p_add_blog__file:hidden").trigger('click');
    });
	
	$('.p_p_add_blog__file').change(function(){
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
	
	// auto size for blog inputs
    $('.p_p_add_blog__input').autoResize();
	
	// call dialog select interest blog
    $('.p_p_add_blog__submit').click(function (e) {
        e.preventDefault();
        $('.blog_add_modal').addClass('open');

    });
	
	// cancel dialog select interest 
    $('.blog_add_modal__cancel').click(function () {
        $('.blog_add_modal').removeClass('open');
    });
	
	// send add send blog add article for users
    $('.blog_add_modal__ok').click(function () {
        $('#modal_interest').val();
        $('.p_p_add_blog__interest').val($('#modal_interest').val());
        $('.blog_add_modal').removeClass('open');

        $('.p_p_add_blog__form').submit();
    });

    $('.p_p_content_button').click(function () {
        var id = $(this).data('id');
        $(this).hide();
        $( ".p_p_content_bottom_name[data-id='" + id + "']" ).removeClass('hide');
        $( ".p_p_content_bottom[data-id='" + id + "']" ).removeClass('hide');

        var height = $( ".p_p_content_bottom_name[data-id='" + id + "']" ).height() - 30;
        if (height < 12)
            height = 6

        $( ".p_p_content_profile[data-id='" + id + "']" ).css("bottom", height+'px');

    });

    function insertParam(key, value) {
        key = escape(key); value = escape(value);

        var kvp = document.location.search.substr(1).split('&');
        if (kvp == '') {
            document.location.search = '?' + key + '=' + value;
        }
        else {

            var i = kvp.length; var x; while (i--) {
                x = kvp[i].split('=');

                if (x[0] == key) {
                    x[1] = value;
                    kvp[i] = x.join('=');
                    break;
                }
            }

            if (i < 0) { kvp[kvp.length] = [key, value].join('='); }

            //this will reload the page, it's likely better to store this until finished
            document.location.search = kvp.join('&');
        }
    }
	
	// select tab in user profile
	$('.p_p_content_tab').hide();
	$('#p_p_content_tab_1').show();

	$('.p_p_button').click(function(){
		$('.p_p_button').removeClass('active');
		$(this).addClass('active');

		var tab = $(this).data('tab');
		$('.p_p_content_tab').hide();
		$('#'+tab).show();
	});

	$('.p_personal__left_sub_tab').hide();
	
	$('.js-personal-tabs').hide();
	$('.p_personal__left_tab__li_open').click(function(){
		var tab = $(this).data('tab');

		if ($(this).hasClass('active')){
			$(this).removeClass('active');

			$('.'+tab).hide('fast');
		}
		else{
			$(this).addClass('active');

			$('.'+tab).show('fast');
		}
	});

});
