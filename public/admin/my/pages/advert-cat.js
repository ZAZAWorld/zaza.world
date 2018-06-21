jQuery( document ).ready( function( $ ) {
	function getCategoryByType (id) {
		$.ajax({
			type: "POST",
			url: DOCUMENT_ROOT + "/adminka/json/advert-cat/" + id,
			dataType: "json",
			success: function ( data ) {
				$( '#cat2_id' ).empty();
				if (isEmptyObject(data)) {
					console.log('not have results');
				}
				else {
					$( '#cat2_id:last' ).append( '<option></option>' );
					$.each( data, function( key, value ) {
						$( '#cat2_id:last' ).append( '<option value="' + key + '">' + value + '</option>' );
					});
				}
			},
			error: function () {
				console.log(id);
				console.log('error on page');
			}
		});
	}

	$( '#cat1_id' ).change(function () {
		var cat1_id = $('#cat1_id').val();
		getCategoryByType(cat1_id);
	});

});
