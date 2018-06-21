Date.prototype.getUnixTime = function() { return this.getTime()/1000|0 };
if(!Date.now) Date.now = function() { return new Date(); }
Date.time = function() { return Date.now().getUnixTime(); }

$(document).ready(function(){
    $('.spoiler-body').hide();
    $('.spoiler-title').click(function(){
        $(this).toggleClass('opened').toggleClass('closed').next().slideToggle();
        if($(this).hasClass('opened')) {
            $(this).html('Close more search options <img src="/images/arrow-up-icon.png" />');
        }
        else {
            $(this).html('Show more search options <img src="/images/arrow-down-icon.png" />');
        }
    });
});

jQuery( document ).ready( function( $ ) {
	var h = $('.ad_filter').css('height');
	document.getElementById('catalogs').style.marginTop = h;
	
	/***** swith filter ******/
	$('.js-switch-filter').click(function(){
		var filter_block = $('.ad_filter');
		var swither = $('.js-switch-filter');
		var h = $('.ad_filter').css('height');
		
		if (filter_block.hasClass('open')){
			swither.removeClass('c-postmore__icon_up c-postmore__icon');
			swither.addClass('c-postmore__icon');
			filter_block.removeClass('open');
			document.getElementById('catalogs').style.marginTop = '0';
			if(screen.width<1024){
			document.getElementById('front_filter_switch').style.position = 'fixed';
			document.getElementById('front_filter_switch').style.top = '0';
			}
		}
		else {
			swither.removeClass('c-postmore__icon_up c-postmore__icon');
			swither.addClass('c-postmore__icon_up');
			filter_block.addClass('open');
			document.getElementById('catalogs').style.marginTop = h;
			if(screen.width<1024) {
			document.getElementById('front_filter_switch').style.position = 'absolute';
			document.getElementById('front_filter_switch').style.top = '45px';
				}	
		}
	});
	
	/*** scroll for mobile ***/
//	$(window).scroll(function () {
//		 if(window.width<1024){
//			 if ($(this).scrollTop() > 41) {
//				document.getElementById('front_filter_switch').style.position = 'fixed!important';
//				document.getElementById('front_filter_switch').style.top = '0!important';
//				}
//			else {
//				document.getElementById('front_filter_switch').style.position = 'absolute!important';
//				document.getElementById('front_filter_switch').style.top = '45px!important';
//			}
//				
//		} 
//		
//	});
	
	
	
	/******** car filter functions *********/
	$(document).on('change','#auto_brand_id', function(){
		var id = $(this).val();
		
		if (id > 0) {
			$.post("/ad/car-model", { id: id} ).done(function( data ) {
				data = JSON.parse(data);
				console.log(data);
				$('#auto_model_id').empty();
				
				$.each(data, function( index, value){
					$('#auto_model_id').append('<option value="'+value.id+'">'+value.name+'</option>');
				});
                $("#auto_model_id").multiselect('destroy');
                $("#auto_model_id").multiselect();
			});
		}
		else {
			$('#auto_model_id').empty();
            $("#auto_model_id").multiselect('destroy');
            $("#auto_model_id").multiselect();
		}
	});
	
	
	$(document).on('change','.js-filtet_cat_3_id',function(){
		var id = parseInt($(this).val());
		if (!(id > 0)){
			$('.js-filtet_cat_4_id').empty();
			$('.js-filtet_cat_4_id').append('<option>Category</option>');
			return true;
		}
		
		$.post("/ad/sub-cat", { id: id} ).done(function( data ) {
            data =  $.parseJSON(data);
            $('.js-filtet_cat_4_id').empty();
            $('.js-filtet_cat_4_id').append('<option></option>');
			
            $.each(data, function( index, value){
				if (index == '904' || index == '908' || index == 904 || index == 908){
				
				}
				else {
					$('.js-filtet_cat_4_id').append('<option value="'+value.id+'">'+value.name+'</option>');
				}
            });
        });
	});
	
	//**********Reload filter when changing type***************
	$(document).on('change','select[name="sub_cat_id"]', function () {
		var type_id = $(this).val();
		$.post("/ad/car-filter", { type_id: type_id} ).done(function( filter ) {
			$('.ad_filter_body').html(filter);
		});
	});

    $(document).on('change', '#sub_cat_part_id', function(){
        var type_id = $(this).val();

        $('#type_part_id').empty();
        $('#type_part_id').append('<option></option>');

        $.post("/ad/sub-cat", { id: type_id} ).done(function( data ) {
            data =  $.parseJSON(data);
            $.each(data, function( index, value){
                $('#type_part_id').append('<option value="'+value.id+'">'+value.name+'</option>');
            });
        });
    });
});