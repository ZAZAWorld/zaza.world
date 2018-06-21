jQuery( document ).ready( function( $ ) {
	$( ".body" ).on( "click",'.js-set-restoran-score', function() {
		var score = parseInt($(this).data('score'));
		
		var score_stars_list = $(this).parent();
		var score_stars = '';
		for(var i = 1; i < 6; i++) {
			if (i <= score)
				score_stars = score_stars + '<div class="c-stars__item c-stars--full js-set-restoran-score" data-score="'+i+'"></div>';
			else 
				score_stars = score_stars + '<div class="c-stars__item c-stars--empty js-set-restoran-score" data-score="'+i+'"></div>';
		}
		score_stars_list.html(score_stars);
		
		var score_input = score_stars_list.siblings('.score_val');
		score_input.val(score);
	});
});