jQuery( document ).ready( function( $ ) {
	function getCategoryByType (id) {
		$.ajax({
			type: "POST",
			url: DOCUMENT_ROOT + "/adminka/json/company-cat-by-type/" + id,
			dataType: "json",
			success: function ( data ) {
				$( '#cat2_id' ).empty();
                $( '#cat3_id' ).empty();
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

    function getSubcategoryByCategory (id) {
		$.ajax({
			type: "POST",
			url: DOCUMENT_ROOT + "/adminka/json/company-subcat-by-cat/" + id,
			dataType: "json",
			success: function ( data ) {
				$( '#cat3_id' ).empty();
				if (isEmptyObject(data)) {
					console.log('not have results');
				}
				else {
					$( '#cat3_id:last' ).append( '<option></option>' );
					$.each( data, function( key, value ) {
						$( '#cat3_id:last' ).append( '<option value="' + key + '">' + value + '</option>' );
					});
				}
			},
			error: function () {
				console.log(id);
				console.log('error on page');
			}
		});
	}

	$( '#cat2_id' ).change(function () {
		var cat2_id = $('#cat2_id').val();
		getSubcategoryByCategory(cat2_id);
	});


});
