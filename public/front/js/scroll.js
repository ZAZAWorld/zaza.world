jQuery( document ).ready( function( $ ) {
    var document_height = $(document).height();
    var window_height = $(window).height();
    var scroll_top = $(window).scrollTop();
	
    var line = 4;
    $(window).scroll(function(){
        if (line > 70) {
            return false;
        }

        document_height = $(document).height();
        window_height = $(window).height();
        scroll_top = $(window).scrollTop();

       

        if((window_height + scroll_top + 250) >= document_height) {
            $('.ads div:first').clone(true, true).appendTo('.ads');
            $('.ads div:first').clone(true, true).appendTo('.ads');
            $('.ads div:first').clone(true, true).appendTo('.ads');
            $('.ads div:first').clone(true, true).appendTo('.ads');
            $('.ads div:first').clone(true, true).appendTo('.ads');
            $('.ads div:first').clone(true, true).appendTo('.ads');
            $('.ads div:first').clone(true, true).appendTo('.ads');
            $('.ads div:first').clone(true, true).appendTo('.ads');
            $('.ads div:first').clone(true, true).appendTo('.ads');
            $('.ads div:first').clone(true, true).appendTo('.ads');
            $('.ads div:first').clone(true, true).appendTo('.ads');
            $('.ads div:first').clone(true, true).appendTo('.ads');

            line++;
        }
    });
});
