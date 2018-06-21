jQuery( document ).ready( function( $ ) {
	/************ close search dialog block **********/
	$( "body" ).on( "click",'.search_modal__close', function() {
		$('.search_modal').removeClass('open');
	});
	/*********** generate search dialog block **********/
	function emptySearch () {
		$('.search_modal__body').empty();
		$('.search_modal__body').html('<p> Note have any results </p>');
		$('.search_modal__sub_title').html('(about 0 matches)');
		$('.search_modal__search_word').empty();
	}
	
	$( "body" ).on( "click",'.m-search__value', function() {
		if (!$('.search_modal').hasClass('open'))
			$('.search_modal').addClass('open')
		
		var search = $('.m-search__input').val();
		if (search == '' || search == undefined) 
			emptySearch();
		
		$.post("/ad/search-body", { search: search } ).done(function( data ) {
			data = JSON.parse(data);
			if (data == '0') {
				emptySearch();
			}
			
			
			$('.search_modal__body').empty();
			$('.search_modal__sub_title').html('(about '+data.length+' matches)');
			$('.search_modal__search_word').html(search);
			
			$.each(data, function( index, value ) {
				var text = '';
				
				text = text + "<div class='search_modal_item'>";
				if (value.type == '1' || value.type == 1)
					text = text + "<a href='/catalog-ad/index/" + value.cat_2_id + "?show_id=" + value.id + "' class='search_modal_item__title'>" + value.title + "</a> <br/>";
				else 
					text = text + "<a href='/catalog-company/index/" + value.cat_2_id + "' class='search_modal_item__title'>" + value.title + "</a> <br/>";
				text = text + "<div class='search_modal_item__about'>" + value.note +"</div>";
				if (value.type == '1' || value.type == 1)
					text = text + "<div class='search_modal_item_found'>found in: <a href='/catalog-ad/index/" + value.cat_2_id + "' class='search_modal_item_found_link'>" + value.cat +"</a></div>";
				else 
					text = text + "<div class='search_modal_item_found'>found in: <a href='/catalog-company/index/" + value.cat_2_id + "' class='search_modal_item_found_link'>" + value.cat +"</a></div>";
				text = text + "</div>";
				
				$( ".search_modal__body" ).append(text);
			});
				
        });		
		
	});
	
	/*********** input set enter keypress *************/
	$( ".m-search__input" ).keypress(function() {
		if (event.keyCode == 13) {
			console.log('kello you set enter');
			$('.m-search__value').click();
		}
	});
	
});