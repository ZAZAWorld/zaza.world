@extends('front.layout')
@section('content')

    @include('front.index.slider')

	@include('front.index.company-icons')
    @include('front.index.advert-icons')
    
    @include('front.index.footer-search')
    @include('front.include.right-buttons')
	
	<div class='radio_block active shadow'>
		<div class='radio_play_block' data-play='0'>
			<span class='radio_play'> &#9658; <!-- &#9632; --></span>
		</div>
		<div class='radio_body'>
			<div class='radio_station_title'> Dubai auto radio 103.2FM </div>
			<div class='radio_station_select_block'>
				<select class='radio_station_select'>
					<option value='xxx'> Select station </option>
					<option value=''> Station 1 </option>
					<option> Station 2 </option>
					<option> Station 3 </option>
					<option> Station 4 </option>
				</select>
			</div>
		</div>
		<div class='radio_volume_block'>
			<input class='radio_volume' min="0" max="1" step="0.1" type="range" />
		</div>
		<div class='radio_close js_open_radio'>
			close
		</div>
	</div>
@stop
