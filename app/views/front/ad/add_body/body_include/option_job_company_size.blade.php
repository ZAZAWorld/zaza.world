<span style="line-height: 30px;">{{TransWord::getArabic($props->get(49)->name)}}</span>
<select name="prop[49]" class="add_ad_option__inline inline60">
	@foreach ($props->get(49)->relPropOption as $option)
		<option @if (!empty($advert_props) && isset($advert_props[49]) && in_array($option->id, $advert_props[49])) selected  @endif value="{{ $option->id }}">{{$option->name}}</option>
	@endforeach
</select>