jQuery( document ).ready( function( $ ) {
 
	////////////

	
	function openBar () {
        if ($('.m-right-bar_ico').hasClass( "open" )) {
            $('.m-right-bar_ico').removeClass( "open" );
            $('.rest_main__right').removeClass( "open" );
			$('body').removeClass( "modal_open");
            $('.p_v_c_main__right').removeClass( "open" );
			$('.js_right_block_bg').remove();
            
 
        }
        else {
            $('.m-right-bar_ico').addClass( "open" );
            $('.rest_main__right').addClass( "open" );
            $('.p_v_c_main__right').addClass( "open" );
            $('body').addClass( "modal_open");
            $('.p_v_c_main__right').addClass( "shadow" );
            $('.rest_main__right').addClass( "shadow" );
            $('.body').append('<div style="width: 100%;  position: fixed; height: 100%; z-index: 990; top: 0;" class="js_right_block_bg"></div>');
	 
        }
    }
	

	
	$('.m-right-bar_ico').click(function(){
		openBar();
	});
	
	
	var wrapper_click = true;
	$( ".js_right_block_bg" ).click(function(){
		if (open_bar_right && wrapper_click){
			openBar();
		}
		
		wrapper_click = true;
		return true;
	});
	
	////////////
	
	function openRightButtons () {
        if ($('.get_right_buttons').hasClass( "open" )) {
            $('.get_right_buttons').removeClass( "open" );
            $('.m-right-buttons').removeClass( "open" );
			$('.m-right-buttons').removeClass( "shadow" );
            
        }
        else {
            $('.get_right_buttons').addClass( "open" );
            $('.m-right-buttons').addClass( "open" );
			$('.m-right-buttons').addClass( "shadow" );

	 
        }
    }
	
	$('.get_right_buttons').click(function(){
		openRightButtons();
	});
	
});