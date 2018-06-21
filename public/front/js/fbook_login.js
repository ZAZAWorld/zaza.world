jQuery( document ).ready( function( $ ) {

    $('.mess_footer__button_fbook_cancel').click(function(){
        $('.add_ad_modal').removeClass('open');
        $('.wrapper').removeClass( "total_blur" );
        $('body').removeClass( "modal_open" );
        location.href = "/logout";
    });

    var prove = 0;

    function hasClass(element, className) {
        var rx = new RegExp('(?:^| )' + className + '(?: |$)');
        return rx.test(element.className);
    }

    $('.mess_footer__button_fbook_login').click(function(){
        var checkEmail = $('.b_req_input.fbook_email_input').val()

        if (hasClass('email-error-check-isset','error')){
            console.log('has ERROR!!!');
        }else{
            console.log('not has ERROR!!!');
        }

        if(prove == 1){
            console.log('ERROR!!!');
        } else {
            if (!!checkEmail){
                $.ajax({
                    url: "/facebook/setmail",
                    type: "POST",
                    data: { email:checkEmail },
                    success: function(res){
                        $('.add_ad_modal').removeClass('open');
                        $('.wrapper').removeClass( "total_blur" );
                        $('body').removeClass( "modal_open" );
                        location.reload();
                    }
                });
            }else{
                console.log('111ERROR!!!');
            }
        }
    });

    $('.fbook_email_input').blur(function(){
        var checkEmail = $(".b_req_input.fbook_email_input").val();
        $.ajax({
            url: "/facebook/checkmail",
            type: "GET",

            data: { email:checkEmail },
            success: function(res){
                if (res == '1'){
                    $('.fbook_email_input').addClass('error');
                    $('.fbook_email_input').after( "<label id=\"email-error-check-isset\" class=\"error\" for=\"email\" style=\"display: block;\">This email is already used!</label>" )
                    console.log('this email already used');
                    prove=1;
                }
                else {
                    $('.fbook_email_input').removeClass('error');
                    $('#email-error-check-isset').remove();
                    prove=0;
                }
            }
        });
    });

});