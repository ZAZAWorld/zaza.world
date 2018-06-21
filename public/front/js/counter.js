jQuery( document ).ready( function( $ ) {
    /******* COUNTER FUNCTIONS *****/
	var px_height = 39;
	var counter = 0;
	
	function updateCounter(){
		var str_count = counter.toString();
		var counter_length = str_count.length;
		
		var i = 0
		for (var str_length = 9; str_length > 0; str_length--) {
			var current_number = 0;
			
			if (counter_length >= str_length){
				current_number = str_count.charAt(i);
				current_number = parseInt(current_number);
				i++;
			}
			
			var row = $('.m-counter__digit__row_'+str_length);
			row.data('number', current_number);
			
			var row_height = px_height * current_number;
			var row_inside = row.children(".m-counter__digit__row__inside");
			row_inside.css( "top",  '-' + row_height + 'px');
		}
	}

    var minNumber = -120;
    var maxNumber = 100;

    var randomNumber = randomNumberFromRange(minNumber, maxNumber);

    function randomNumberFromRange(min,max)
    {
        return Math.floor(Math.random()*(max-min+1)+min);
    }
	
	function updateCounterValue () {
		$.post("/onlain-user").done(function( data ) {
			counter = parseInt(data) + 300 + randomNumber;
			updateCounter();
		});
	}
	
	updateCounterValue();
	
	var timerId = setInterval(function() {
		updateCounterValue();
	}, 120000);
	
// 	$('.m-counter__name').click(function () {
// 	     counter = counter + 20;
// 	     updateCounter();
// 	 });
	
	
});
