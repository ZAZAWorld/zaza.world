jQuery( document ).ready( function( $ ) {
    function tooltip(selector, css_class, my_pos, at_post){
        $('.' + selector).qtip({ // Grab some elements to apply the tooltip to
            content: {
                text: $('.' + selector).data('tooltip')
            },
            style: {
                classes: 'qtip-spec '+ css_class ,
                tip: {
                   corner: true
               }
            },
            hide: {
                delay: 600
            },
            corner: 'bottomMiddle',
            position: {
                my: my_pos,
                at: at_post
            }
        });
    }
	
	function spectooltip(selector, css_class, my_pos, at_post){
        $('.' + selector).qtip({ // Grab some elements to apply the tooltip to
            content: {
                text: $('.' + selector).data('tooltip')
            },
            style: {
                classes: 'qtip-spec '+ css_class ,
                tip: {
                   corner: true
               }
            },
            hide: {
                delay: 3000
            },
            corner: 'bottomMiddle',
            position: {
                my: my_pos,
                at: at_post
            }
        });
    }

    // add ad tooltip
    tooltip('js-add-tooltip', 'qtip-bootstrap-blue', 'top center', 'bottom center');

    // inquiry tooltip
    tooltip('js-tooltip-inquiry', 'qtip-default', 'right center', 'left center');

    // watchs tooltip
    tooltip('js-tooltip-watchs', 'qtip-default', 'right center', 'left center');

    // adverts tooltip
    tooltip('js-tooltip-adverts', 'qtip-default', 'right center', 'left center');

    // maps tooltip
    tooltip('js-tooltip-maps', 'qtip-default', 'right center', 'left center');

    // location tooltips
    spectooltip('js-tooltip-location', 'qtip-bootstrap', 'top center', 'bottom center');

    // js-logout tooltips
    spectooltip('js-logout', 'qtip-bootstrap-red', 'top center', 'bottom center');
	
	spectooltip('js-refil-budjet', 'qtip-bootstrap-balans', 'top center', 'bottom center');
});
