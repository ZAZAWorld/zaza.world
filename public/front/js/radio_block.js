jQuery( document ).ready( function( $ ) {
    var open_radio = false;

    $('.js_open_radio').click(function(){
        var radio_block = $('.radio_block');

        if (radio_block.hasClass('active')){
            radio_block.removeClass('active');
            $('.js_right_block_bg').remove();
        }

        else {
            radio_block.addClass('active');

        }

        if ($('.js-right-buttons.open:not(".js_open_radio")'))
            $('.js-right-buttons.open:not(".js_open_radio")').click();


        if ($(this).hasClass('open')){
            open_radio = false;
            $(this).removeClass('open');
        }
        else {
            open_radio = true;
            $(this).addClass('open');
        }


    });





    var station_list = [
			{ name: 'Star FM', url: '//19393.live.streamtheworld.com/STAR_FM.mp3' },
			{ name: 'Tag 91.1', url: '//17893.live.streamtheworld.com/TAG911AEAAC.aac' },
			{ name: 'Hit 96.7', url: '//19093.live.streamtheworld.com/HITAAC.aac' },
			{ name: 'Dubai 92', url: '//18403.live.streamtheworld.com/DUBAI_92AAC.aac' },
			{ name: 'City 101.6 FM', url: '//19523.live.streamtheworld.com/ARNCITY.mp3' },
			{ name: 'Channel 4 FM', url: '//19393.live.streamtheworld.com/CHANNEL4FM_SC' },
			{ name: 'Virgin Radio Dubai', url: '//19513.live.streamtheworld.com/VIRGINRADIO_DUBAI_SC' }
		];
		var select_station = $('.radio_station_select');
		var title_station = $('.radio_station_title');
        var audio = new Audio(station_list.url);
        title_station.html(station_list.name);
		select_station.empty();
		select_station.append('<option value="xxx"> Select station </option>');

		for (var i = 0; i < station_list.length; i++) {
			select_station.append('<option value="' + i + '">' + station_list[i].name + '</option>');
		}

		$('.radio_play_block').click(function(){
			var play = $(this).data('play');
			var icon = $(this).find('.radio_play');
			if (play == 0 || play == '0') {
				$(this).data('play', '1');
				icon.html('&#9632;');
				audio.play();
			}
			else {
				$(this).data('play', '0');
				icon.html('&#9658;');
				audio.pause();
			}
		});
		
		$('.radio_volume').change(function(){
			var volume = $(this).val();
			audio.volume = parseFloat(volume);
		});
		
		
		$('.radio_station_select').change(function(){
			var station_key = $(this).val();
			if (station_key == 'xxx' || station_key == undefined)
				return false;
				
			station_key = parseInt(station_key);
			
			audio.pause();
			
			select_station.val('xxx');
			audio.setAttribute("src", station_list[station_key].url);
			title_station.html(station_list[station_key].name);
			
			audio.play();
		});

});