<div class='radio_block shadow'>
	<div class='radio_play_block' data-play='0'>
		<span class='radio_play'> &#9658; <!-- &#9632; --></span>
	</div>
	<div class='radio_body'>
		<div class='radio_station_title'> {{TransWord::getArabic('Dubai auto radio',false)}} 103.2FM </div>
		<div class='radio_station_select_block'>
			<select class='radio_station_select'>
				<option value='xxx'> {{TransWord::getArabic('Select station',false)}} </option>
				<option value=''> {{TransWord::getArabic('Station 1',false)}} </option>
				<option> {{TransWord::getArabic('Station 2',false)}} </option>
				<option> {{TransWord::getArabic('Station 3',false)}} </option>
				<option> {{TransWord::getArabic('Station 4',false)}} </option>
			</select>
		</div>
	</div>
	<div class='radio_volume_block'>
		<input class='radio_volume' min="0" max="1" step="0.1" type="range" />
	</div>
	<div class='radio_close js_open_radio'>
		{{TransWord::getArabic('close',false)}}
	</div>
</div>