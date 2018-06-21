jQuery( document ).ready( function( $ ) {

	function getCityByCountry (id) {
		$.ajax({
			type: "POST",
			url: DOCUMENT_ROOT + "/adminka/json/city-by-country/" + id,
			dataType: "json",
			success: function ( data ) {
				var default_val = $( '#city_id' ).val();
				$( '#city_id' ).empty();
				if (isEmptyObject(data)) {
					console.log('not have results');
				}
				else {
					$( '#city_id:last' ).append( '<option></option>' );
					$.each( data, function( key, value ) {
						if (default_val == key)
							$( '#city_id:last' ).append( '<option value="' + key + '" selected>' + value + '</option>' );
						else
							$( '#city_id:last' ).append( '<option value="' + key + '">' + value + '</option>' );
					});
				}
			},
			error: function () {
				console.log(id);
				console.log('error on page');
			}
		});
	}

	// смены и запрос городов по области
	var country_id = $('#country_id').val();
	getCityByCountry(country_id);

	$( '#country_id' ).change(function () {
		var country_id = $('#country_id').val();
		getCityByCountry(country_id);
	});


});
