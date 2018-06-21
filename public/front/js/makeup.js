jQuery( document ).ready( function( $ ) {

    $('input[name="min_period"]').datepicker({
        dateFormat: 'dd.mm.yy'
    });
    $('input[name="max_period"]').datepicker({
        dateFormat: 'dd.mm.yy'
    });
});
