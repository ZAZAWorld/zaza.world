/************ DOCUMENT_ROOT **************/
var DOCUMENT_ROOT = 'http://' + document.location.hostname;
/************ check empty object function **************/
function isEmptyObject(obj) {
	for(var prop in obj) {
		if(obj.hasOwnProperty(prop))
			return false;
	}

	return true;
}
/************* get GET param from current link *************/
function getUrlParameter(sParam) {
	var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');
		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : sParameterName[1];
		}
	}
}


/********* translate advert *********/
 console.log($('#select-lang').data('lang'));
 function getTrans (name) {
	if ($('#select-lang').data('lang') !== 'en' ){
		console.log($('#select-lang').data('lang'));
		var res = null;
		$.ajax({
			url: "/trans/"+name,
			type: 'POST',
			data: { name: name},
			async: false,
			success: function (data) {
				console.log(data);
				res = data;
			},
			cache: false,
			contentType: false,
			processData: false
		});
		if (res === null)
			return name;
		else
			return res;
	}
	else
		return name;
}

jQuery( document ).ready( function( $ ) {
	console.log($('#select-lang').data('lang'));
    console.log($('#select-city-onbar').data('cityonbar'));

	$( ".body" ).on( "click",'.js_call_modal_banner', function() {
		if ($('.modal_banner').hasClass('open'))
			$('.modal_banner').removeClass('open');
		else 
			$('.modal_banner').addClass('open');
	});

	$( ".body" ).on( "click",'.js_call_modal_terms', function() {
		$(".modal_terms").load('terms.blade.php');

		if ($('.modal_terms').hasClass('open'))
			$('.modal_terms').removeClass('open');
		else 
			$('.modal_terms').addClass('open');
	});
	
	$( ".body" ).on( "click",'.js_call_modal_privacy', function() {
		$(".modal_privacy").load('privacy.blade.php');

		if ($('.modal_privacy').hasClass('open'))
			$('.modal_privacy').removeClass('open');
		else 
			$('.modal_privacy').addClass('open');
	});
	
	$( ".body" ).on( "click",'.js_call_modal_about', function() {
		$(".modal_about").load('about.blade.php');

		if ($('.modal_about').hasClass('open'))
			$('.modal_about').removeClass('open');
		else 
			$('.modal_about').addClass('open');
	});

    $(function() {
        $('.slides_close_images').lazy();
    });

    //alert(getTrans('Dubai'));
	/********* scroll bar on comment *********/
    $('.ad_comments__lists').simplebar({ autoHide: true });
	
	/************* click to change current language **********/
	$('.select-lang').change(function(){
		window.location.href = "/"+$(this).val();
	});

    $('.select-city-onbar').change(function(){
        window.location.href = "/change-city/"+$(this).val();
    });
	
	$( "body" ).on( "click",'.js_call_to_top', function() {
		if ($('.to_top_block').hasClass('active')){
			$('.to_top_block').removeClass('active');
			$('.wrapper').removeClass( "total_blur");
            $('body').removeClass( "modal_open");
		}
		else {
			$('.to_top_block').addClass('active');
			$('.wrapper').addClass( "total_blur");
            $('body').addClass( "modal_open");
		}
	});
	
	$('.js_call_to_top_change').change(function(){
		$('.js_call_to_top_change_val').html($(this).val());
	});
	
	$( ".body " ).on( "click",'.c-postshare__delete', function() {
		$('#confirmDelete').show();
	});

	$( ".body " ).on( "click",'.mess_confirm__close', function() {
		$('#confirmDelete').hide();
	});

	/********* click for like company**********/
	$( ".body " ).on( "click",'.js-like-company-set', function() {
		if(!$('*').is('.m-head-profile'))
			return false;
			
		var id = $(this).data('id');
		var elem = $(this);
		var chiled_title = elem.find('.company-follow__name');
		if (elem.hasClass('active')) {
			$.post("/company/dislike", { id: id} ).done(function( data ) {
				if(data == '' || data == '0')
					return false;
				
				if (elem.hasClass('active'))
					elem.removeClass('active');

				chiled_title.html('follow');
				$('.js-total-company-like').html(data);
			});
		}
		else {
			$.post("/company/like", { id: id} ).done(function( data ) {
				if(data == '' || data == '0')
					return false;

				if (!elem.hasClass('active'))
					elem.addClass('active');
					
				chiled_title.html('unfollow');
				$('.js-total-company-like').html(data);
			});
		}
		console.log('id ' + id);
		console.log('elem ' + elem.attr('class'));
		console.log('id ' + chiled_title.attr('class'));
	});
	
	/****** chat functions *********/
	$('.js-open-main-chat').on('click',function(){

		$(this).find('.adverts__count').remove();

		if ($('.js-right-buttons.open:not(".js-open-main-chat")'))
			$('.js-right-buttons.open:not(".js-open-main-chat")').click();
			
		if ($(this).hasClass('open')){
			$(this).removeClass('open');
			$(".main-chat-container").hide();
			$('.js_right_block_bg').remove();
		}
		else {
			openChat();
			$(this).addClass('open');
			$('.body').append('<div style="width: 100%;  position: fixed; height: 100%; z-index: 990; top: 0;" class="js_right_block_bg"></div>');
		}

	});

	$(document).on('click','.js-open-chat',function(){
		openChat($(this).data('user-id'));
	});

	$(document).on('click','.ad_prop_owner__stat_chat',function(){
		openChat($(this).data('owner-id'));
	});

	function openChat(data){
		$(".main-chat-container").show();
		$.get('/message',{chatWith:data}).done(function(res){
			if(res) {
				$('.chat-container').html(res);

				if(window.chatSingleTone){
					window.chatSingleTone.open();
				}else{
					window.chatSingleTone = Chat;
					window.chatSingleTone.init();
				}
			}
		});
	}

	function checkNewMessages() {
		$.get("/message/check").done(function (result) {
            var chatBtn = $(".js-open-main-chat");
            if(chatBtn){
            	chatBtn.find(" .adverts__count").remove();
				if (result > 0){
					chatBtn.append('<span class="adverts__count">'+result+'</span>');
				}else{
                    if (result == 0){
                        chatBtn.find(" .adverts__count").remove();
                    }else{
                        if (!isEmptyObject(result)){
                            result = 0;
                            chatBtn.find(" .adverts__count").remove();
                        }
                    }
				}
            }
			setTimeout(function () { checkNewMessages() },30000);
        });
    }

	checkNewMessages();
	
	/********* validate functions ************/
	$(".validate-form").attr('novalidate', 'novalidate');

	$('.validate-form').each(function() {  // attach to all form elements on page
        $(this).validate({       // initialize plugin on each form
            // global options for plugin
        });
    });
	
	/************ image slider functions **********/

	$("#content-slider").lightSlider({
		loop:true,
		keyPress:true
	});
	
	$('#image-gallery').lightSlider({
		gallery:true,
		item:1,
		thumbItem:4,
		slideMargin: 0,
		speed:500,
		pause:7000,
		auto:true,
		loop:true,
		vertical:true,
		verticalHeight:485,
		vThumbWidth:135,
		onSliderLoad: function() {
			$('#image-gallery').removeClass('cS-hidden');
		}
	});
	
	$('.rest-menu-slider').lightSlider({
		gallery:true,
		item:1,
		thumbItem:1,
		slideMargin: 0,
		speed:500,
		pause:7000,
		auto:true,
		loop:true,
		vertical:true,
		pager: false,
		verticalHeight:400,
		controls: false,
		onSliderLoad: function() {
			$('#image-gallery').removeClass('cS-hidden');
		}
	});

    var widthScreen = screen.width;
    if (widthScreen >= '420') {
        $('.image-gallery_bx').bxSlider({
            useCSS: false,
            auto: true,
            pause: 10000,
            mode: 'vertical',
            slideMargin: 0,
            controls:true,
            touchEnabled: false,
            video: true,
            responsive: true,
            pagerType: 'full',
            pagerCustom: '#bx-pager'
        });
    } else {
        if (widthScreen <= '414') {
            $('.image-gallery_bx').bxSlider({
                useCSS: false,
                auto: true,
                pause: 10000,
                slideMargin: 0,
                controls:true,
                video: true,
                touchEnabled: false,
                responsive: true,
                pagerType: 'full',
                pagerCustom: '#bx-pager-mobile'
            });
        } else {
            if (widthScreen < '320') {
                $('.image-gallery_bx').bxSlider({
                    useCSS: false,
                    auto: true,
                    pause: 10000,
                    slideMargin: 0,
                    touchEnabled: false,
                    controls:true,
                    video: true,
                    responsive: true,
                    pagerType: 'full',
                    pagerCustom: '#bx-pager-mobile'
                });
            }
        }
    }
	
	$('.slides_ads').bxSlider({
        useCSS: false,
		auto: true,
		pause: 3000,
		controls:true,
		pager: 'short'
	});

    $('.closed_slides_ads').each(function() {
        var _this = $(this).bxSlider({
            useCSS: false,
            slideWidth: 238,
            responsive: true,
            auto: false,
            pause: 1650,
            speed: 1000,
            infiniteLoop: false,
            controls: false,
            pager: false
        });
        _this.mouseenter(function() {
            _this.startAuto();
        }).mouseleave(function() {
            _this.stopAuto();
        	_this.goToSlide(0);
            _this.goToSlide(0);
            _this.goToSlide(0);
            _this.goToSlide(0);
        });
    });

	$('.rest-slider').bxSlider({
		auto: true,
		pause: 3000,
		controls:true,
		pager: 'short'
	});

	$('.bxslider').bxSlider({
		useCSS: false,
		pager:false,
		auto: true,
		pause: 7000,
		controls:false,
		randomStart:true,
		video: true
	});

	$('.bxslider_ad').bxSlider({
		useCSS: true,
		pager:false,
		auto: true,
		pause: 5000,
		controls:true,
		minSlides: 2,
		maxSlides: 12,
		slideWidth: 238,
		responsive: true,
		touchEnabled: true,
		autoHover:true,
		moveSlides: 1
	});
	
	$('.bxslider_restoran_list').bxSlider({
		useCSS: false,
		pager:false,
		auto: true,
		pause: 2500,
		controls:true,
		minSlides: 2,
		maxSlides: 15,
		
		slideWidth: 238,
		responsive: true,
		touchEnabled: true,
		autoHover:true,
		moveSlides: 1
	});
	$('.idiot_price_format').priceFormat({
		prefix: '',
		clearPrefix: true
	});
});

/********* validate rules ***********/
$.validator.addClassRules({
	'normalValidate': {
		required: true
	},
	'digitValidate': {
		digits:true,
		required: true
	},
	'digitValidateS':{
		required: true
	},
	'emailValidate': {
		email:true,
		required: true
	},
	'emailValidateS':{
		email:true
    },
	'dateValidate': {
		required: true
	},
	'rePasswordValidate': {
		equalTo: "#password",
		required: true
	},
	'max40sumbolsValidate': {
		required: true,
		maxlength: 40
	},
	'min6symbolValidate':{
		required: true,
		minlength: 6	
	}
	
});