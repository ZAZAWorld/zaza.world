jQuery( document ).ready( function( $ ) {
	/********** add image for blog function **************/
	$('.js-form-blog-add').click(function(){
		$('.js-form-blog-file').click();
	});
	
	/******** reply comment functions ***********/
	$( "body" ).on( "click",'.js-reply-comment', function() {
		var user = $(this).data('user-name');
		var note = $(this).data('note');
		var id = $(this).data('id');
		if (user == '' || user == undefined || note == '' || note == undefined || id == '' || id == undefined)
			return false;
		console.log(user + 'user');
		
		$('.js-reply-comment-title').remove();
		
		var text = '<span class="js-reply-comment-title">'+
						'Answer to comment from <span style="color:#dd2c00;">"'+user+'"</span>'+ 
						'<a href="#empty-reply" class="js-reply-comment-clear" style="display: block; float: right; color: #dd2c00; font-size: 12px; font-weight: 600;"> clear</a>'+
						'<input type="hidden" name="parent_id" value="'+id+'">'+
					'</span>';
		$('.js-reply-comment-block').prepend(text);
	});
	
	/*********** remove reply comment ************/
	$( "body" ).on( "click",'.js-reply-comment-clear', function() {
		$('.js-reply-comment-title').remove();
	});
	
	/********* functions for open comment block in blog ***************/
	$('.c-postcomments__icon.icon-20').click(function(){
		var parent = $(this).closest('.l-grid-noGutter-top-1');
		var comment = parent.siblings(".blog_comments");
		var postmore = parent.siblings(".c-postmore");
		
		if (comment.css('display') == 'none') {
			comment.show();
			var icon = postmore.find('.c-postmore__icon');
			icon.removeClass('c-postmore__icon');
			icon.addClass('c-postmore__up');
		}
		else {
			comment.hide();
			var icon = postmore.find('.c-postmore__up');
			icon.removeClass('c-postmore__up');
			icon.addClass('c-postmore__icon');
		}
	});
	
	var $postmoreicon = $(this).siblings(".c-postmore__icon");
	var $blogcomments = $(this).siblings(".blog_comments");

	$(".c-postmore__icon").on('click',function() {
		var parent = $(this).parent().parent();
		var blog_comment = parent.siblings(".blog_comments");
		var span = $(this);
		if (blog_comment.is(":hidden")) {
			blog_comment.slideDown("slow");
			span.removeClass("c-postmore__icon").addClass( "c-postmore__up" );
		} else {
			blog_comment.hide("slow");
			span.removeClass("c-postmore__up").addClass( "c-postmore__icon" );
		}
	});
	
	/************* function for open  dialog blog update *********************/
	$( ".body " ).on( "click",'.js-call-blog-update-blog', function() {
		var id = $(this).data('id');
		$.post("/blog/update-dialog", { blog_id: id} ).done(function( data ) {
			if(data == '' || data == '0')
					return false;

			$( ".body" ).append( data);
		});
	});
	
	/************** function for close dialog blog update *****************/
	$( ".body " ).on( "click",'.blog_dialog_edit__close', function() {
		$('.blog_dialog_edit').remove();
	});
	$( ".body " ).on( "click",'.blog_dialog_edit__cancel', function() {
		$('.blog_dialog_edit').remove();
	});
	
	/*************** function for upload dialog blog update photo **************/
	
	$( ".body " ).on( "click",'.blog_dialog_edit_photo__add', function() {
		$('.blog_dialog_edit_photo__file').click();
	});
	$( ".body " ).on( "change",'.blog_dialog_edit_photo__file', function() {
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
					$('.blog_dialog_edit_photo__image').attr('src', data);
					$('.blog_dialog_edit_photo__value').val(data);
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
	});
	
	/********** function set user blog shared ***************/
	$('.js-add-user-bloh_share').click(function(){
		var id = $(this).data('id');
		var check = parseInt($(this).data('check'));
		var element = $(this);
		
		console.log('id ' + id);
		$.post("/blog/add-share", { blog_id: id} ).done(function( data ) {
			console.log(data);
			console.log(check);
			var child = element.find('.js-add-user-bloh_share_text');
			
			if (check == 1){
				element.data('check', 0);
				child.html('share');
			}
			else {
				element.data('check', 1);
				child.html('shared');
			}
			
		});
	});
	
});