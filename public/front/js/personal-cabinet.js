jQuery( document ).ready( function( $ ) {
	/************ edit company fields **********/
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
	// create update link
    $('.form_update_pencil').click(function(){
        var id = $(this).data('id');

        swithHideInput(id, true);
    });
	// save update field ok
    $('.form_update_ok').click(function(){
        var id = $(this).data('id');
        var input = $(".form_update_input[data-id='" + id + "']");

        $.post("/company-simple/update", { name: input.data("id"), value: input.val(), type:  input.data("type") } ).done(function( data ) {
        });

        swithHideInput(id, true);
    });
	// cancel update field cancel
    $('.form_update_cancel').click(function(){
        var id = $(this).data('id');

        swithHideInput(id, false);
    });
	
	/************ upload logog functions *************/
    $(".p_com_logo_block__upload").on('click', function(e){
        e.preventDefault();
        $(".p_com_logo_block__file:hidden").trigger('click');
    });

    $(".p_com_logo_block__file").change(function(){
        var file = $(this);
        var parent = file.closest( ".p_com_logo_block" );
        var formData = new FormData();
        formData.append('value', $(this)[0].files[0] );
        formData.append('type', 'company' );
        formData.append('name', 'photo' );

        $.ajax({
            url: "/company-simple/update",
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                if (data!='0' && data!='1') {
                    parent.find('.p_com_logo__img').attr('src', data);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});
