<select name='prop[17]' class="add_ad_field">
	<option>{{ TransWord::getArabic('Year') }}</option>
	@foreach ($ar_year as $year)
		<option @if (!empty($advert_props) && in_array($year,$advert_props[17])) selected @endif value="{{ $year }}">{{$year}}</option>
	@endforeach
</select>