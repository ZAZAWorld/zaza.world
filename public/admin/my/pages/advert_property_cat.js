jQuery( document ).ready( function( $ ) {
    console.log('advert property categoryeis');

    function getCat (select_id, parent_id) {
        $.post( "/adminka/adv-prop/advert-cat-ajax", { parent_id: parent_id }).done(function( data ) {
            var data = JSON.parse(data);
            console.log( "Data Loaded: " + data );
            $( '#'+select_id ).empty();
            if (isEmptyObject(data)) {
                console.log('not have results');
            }
            else {
                $( '#'+select_id+':last' ).append( '<option></option>' );
                $.each( data, function( key, value ) {
                    $( '#'+select_id+':last' ).append( '<option value="' + key + '">' + value + '</option>' );
                });
            }
        });
    }

    $( '#cat1_id' ).change(function () {
		var parent_id = $(this).val();
		getCat('cat2_id', parent_id);
        $('cat2_id').empty();
        $('cat3_id').empty();
        $('cat4_id').empty();
	});

    $( '#cat2_id' ).change(function () {
		var parent_id = $(this).val();
		getCat('cat3_id', parent_id);
        $('cat3_id').empty();
        $('cat4_id').empty();
	});

    $( '#cat3_id' ).change(function () {
		var parent_id = $(this).val();
		getCat('cat4_id', parent_id);
        $('cat4_id').empty();
	});




});
