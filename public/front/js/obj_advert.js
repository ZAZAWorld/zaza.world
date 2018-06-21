jQuery( document ).ready( function( $ ) {
	/********** advert taimers ************/
	var deadline = 'December 31 2016 23:59:59 GMT+02:00';
	
	var currentUnixTime = Math.floor(Date.now() / 1000);
	//var d = new Date().toISOString();
	console.log(currentUnixTime);
	function getTimeRemaining(clock){
		var endtime = clock.data('date-end');
		
		var t = endtime - Math.floor(Date.now() / 1000);

		var seconds = Math.floor( (t) % 60 );
		var minutes = Math.floor( (t/60) % 60 );
		var hours = Math.floor( (t/(60*60)) % 24 );
		var days = Math.floor( t/(60*60*24) );
		return {
				'total': t,
				'days': days,
				'hours': hours,
				'minutes': minutes,
				'seconds': seconds
			};
	}
	
	function initializeClock(clock){
		
		var timeinterval = setInterval(function(){
			var t = getTimeRemaining(clock);
			
			var days = t.days.toString();
			var hours = t.hours.toString();
			var minutes = t.minutes.toString();
			var seconds = t.seconds.toString();
			
			var html = "<span class='my_timer_block'>";
			if (days.length == 2){
				html = html + "<span class='my_timer_el day'>" + days.charAt(0) +"</span>";
				html = html + "<span class='my_timer_el day'>" + days.charAt(1) +"</span>";
			}
			else {
				html = html + "<span class='my_timer_el day'>0</span>";
				html = html + "<span class='my_timer_el day'>" + days.charAt(0) +"</span>";
			}
			html = html + "</span> : ";
			
			html = html + "<span class='my_timer_block'>";
			if (hours.length == 2){
				html = html + "<span class='my_timer_el hour'>" + hours.charAt(0) +"</span>";
				html = html + "<span class='my_timer_el hour'>" + hours.charAt(1) +"</span>";
			}
			else {
				html = html + "<span class='my_timer_el hour'>0</span>";
				html = html + "<span class='my_timer_el hour'>" + hours.charAt(0) +"</span>";
			}
			html = html + "</span> : ";
			
			html = html + "<span class='my_timer_block'>";
			if (minutes.length == 2){
				html = html + "<span class='my_timer_el minute'>" + minutes.charAt(0) +"</span>";
				html = html + "<span class='my_timer_el minute'>" + minutes.charAt(1) +"</span>";
			}
			else {
				html = html + "<span class='my_timer_el minute'>0</span>";
				html = html + "<span class='my_timer_el minute'>" + minutes.charAt(0) +"</span>";
			}
			html = html + "</span> : ";
			
			html = html + "<span class='my_timer_block'>";
			if (seconds.length == 2){
				html = html + "<span class='my_timer_el second'>" + seconds.charAt(0) +"</span>";
				html = html + "<span class='my_timer_el second'>" + seconds.charAt(1) +"</span>";
			}
			else {
				html = html + "<span class='my_timer_el second'>0</span>";
				html = html + "<span class='my_timer_el second'>" + seconds.charAt(0) +"</span>";
			}
			html = html + "</span>";					
			
			clock.html(html);
			
			if(t.total<=0){
				clock.remove();
				clearInterval(timeinterval);
				
			}
		},1000);
	}
	
	function initializeClock2(clock){
		
		var timeinterval = setInterval(function(){
			var t = getTimeRemaining(clock);
			
			var days = t.days.toString();
			var hours = t.hours.toString();
			var minutes = t.minutes.toString();
			var seconds = t.seconds.toString();
			
			var html = "<span class='my_timer_2_block'>";
			if (days.length == 2){
				html = html + "<span class='my_timer_2_el day'>" + days.charAt(0) +"</span>";
				html = html + "<span class='my_timer_2_el day'>" + days.charAt(1) +"</span>";
			}
			else {
				html = html + "<span class='my_timer_2_el day'>0</span>";
				html = html + "<span class='my_timer_2_el day'>" + days.charAt(0) +"</span>";
			}
			html = html + "<span class='my_timer_2_sign'>days</span>";
			html = html + "</span>";
			html = html + "<span class='jojojasdpf'>:</span>";
			
			html = html + "<span class='my_timer_2_block'>";
			if (hours.length == 2){
				html = html + "<span class='my_timer_2_el hour'>" + hours.charAt(0) +"</span>";
				html = html + "<span class='my_timer_2_el hour'>" + hours.charAt(1) +"</span>";
			}
			else {
				html = html + "<span class='my_timer_2_el hour'>0</span>";
				html = html + "<span class='my_timer_2_el hour'>" + hours.charAt(0) +"</span>";
			}
			html = html + "<span class='my_timer_2_sign'>hours</span>";
			html = html + "</span>";
			html = html + "<span class='jojojasdpf'>:</span>";
			
			html = html + "<span class='my_timer_2_block'>";
			if (minutes.length == 2){
				html = html + "<span class='my_timer_2_el minute'>" + minutes.charAt(0) +"</span>";
				html = html + "<span class='my_timer_2_el minute'>" + minutes.charAt(1) +"</span>";
			}
			else {
				html = html + "<span class='my_timer_2_el minute'>0</span>";
				html = html + "<span class='my_timer_2_el minute'>" + minutes.charAt(0) +"</span>";
			}
			html = html + "<span class='my_timer_2_sign'>min</span>";
			html = html + "</span>";
			html = html + "<span class='jojojasdpf'>:</span>";
			
			html = html + "<span class='my_timer_2_block'>";
			if (seconds.length == 2){
				html = html + "<span class='my_timer_2_el second'>" + seconds.charAt(0) +"</span>";
				html = html + "<span class='my_timer_2_el second'>" + seconds.charAt(1) +"</span>";
			}
			else {
				html = html + "<span class='my_timer_2_el second'>0</span>";
				html = html + "<span class='my_timer_2_el second'>" + seconds.charAt(0) +"</span>";
			}
			html = html + "<span class='my_timer_2_sign'>sec</span>";
			html = html + "</span>";					
			
			clock.html(html);
			
			if(t.total<=0){
				clock.remove();
				clearInterval(timeinterval);
				
			}
		},1000);
	}
	
	/*
	initializeClock('my_timer');
	*/
	$( ".my_timer" ).each(function( index ) {
		//console.log( index + ": " + $( this ).text() );
		initializeClock($( this ));
	});
	
	
	/******* Open advert functions ***********/
	// function for get ajax advert
	function createAdvertDialog (id) {
		$.post("/ad/view", { id: id} ).done(function( data ) {
			if(data == '' || data == '0')
					return false;

			$( ".wrapper" ).after( data);
			
			
			$( ".my_timer_2" ).each(function( index ) {
				//console.log( index + ": " + $( this ).text() );
				initializeClock2($( this ));
			});
			
		});
	}
	// function for open advert dialog
	function openAdvertDialog (advert) {
		var id = advert.data('id');
		if (($(".ad-modal").length > 0)){ // has open ad dialog
			$('.ad-modal').remove();
			createAdvertDialog(id);
		} else { // has note open dialog
			$('.wrapper').addClass('total_blur');
			$('body').addClass('modal_open');
			createAdvertDialog(id);
		}
		
		
	}
	
	
	// function for close advert dialog
	function closeAdvertDialog (advert) {
    window.dynamicLocations = undefined;
		$('.wrapper').removeClass('total_blur');
		$('body').removeClass('modal_open');
			$('.ad-modal').remove();
	}
	// click for open advert
	$(".advert__link").click(function () {
		if ($(this).attr('data-id'))
			openAdvertDialog($(this));

		var img = $(this).find('.advert__image-block');
		if (!img.hasClass('normal_blur'))
			img.addClass('normal_blur');
	});
	// click for close advert
	$( ".body " ).on( "click",'.ad-modal__close', function() {

		closeAdvertDialog($(this).parent().parent());
	});
	// click for open next advert
	$( ".body " ).on( "click",'.ad-modal__before', function() {
		openAdvertDialog($(this));
	});
	// click for open before advert
	$( ".body " ).on( "click",'.ad-modal__after', function() {
		openAdvertDialog($(this));
	});
	// auto open advert if isset get parameter
	var show_id = getUrlParameter('show_id');
	if (show_id > 0 && show_id != undefined) {
		$('.wrapper').addClass('total_blur');
		show_id = parseInt(show_id);
		createAdvertDialog(show_id);
	}
	
	// close advert 
	$( ".body " ).on( "click",'.ad-modal_bg', function() {
		$('.ad-modal__close').click();
	});
	
	/********* click for like advert from advert dialog**********/
	$( ".body " ).on( "click",'.js-likes', function() {
		if(!$('*').is('.m-head-profile'))
			return false;
		
		var img = $(this).find('img');
		if ($(this).hasClass('active')){
			$(this).removeClass('active');
			img.attr('src', '/front/img/icons/ad_like.png');
		}
		else{
			$(this).addClass('active');
			img.attr('src', '/front/img/icons/ad_like_true.png');
		} 
			
			
		var id = $(this).data('id');
		var elem = $('.js-likes-form-catalog[data-id="'+id+'"]');
		var that = $(this);
		
		$.post("/ad/like", { id: id} ).done(function( data ) {
			$('.count_likes_ad').html(data);
			if (that.hasClass('active'))
				elem.addClass('active');
			else 
				elem.removeClass('active');
			
			if(data == '' || data == '0')
				return false;
			
			
		});
	});
	
	/********* click for like advert from advert catalog**********/
	$( ".body " ).on( "click",'.js-likes-form-catalog', function() {
		if(!$('*').is('.m-head-profile'))
			return false
			
		var id = $(this).data('id');
		var elem = $('.js-likes-form-catalog[data-id="'+id+'"]');

		$.post("/ad/like", { id: id} ).done(function( data ) {
			if(data == '' || data == '0')
				return false;

			if (!elem.hasClass('active'))
				elem.addClass('active');
			else 
				elem.removeClass('active');
		});
	});
	
	/********* click for select tab in auto dialog ********/
	$( ".body " ).on( "click",'.js-ad_panel__button', function() {
		$('.js-ad_panel__button').removeClass('active');
		$(this).addClass('active');

		var tab_id = $(this).data('tab-id');

		$('.js-ad_text_block').removeClass('ad_text_block_hide');
		$('.js-ad_text_block').addClass('ad_text_block_hide');
		$('#js-ad_text_block-'+tab_id).removeClass('ad_text_block_hide');
	});

	
	
	
});