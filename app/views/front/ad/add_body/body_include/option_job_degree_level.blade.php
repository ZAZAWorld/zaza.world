<span style="line-height: 30px;">{{TransWord::getArabic($props->get(48)->name)}}</span>
<select name="prop[48]" class="add_ad_option__inline inline60">
	@foreach ($props->get(48)->relPropOption as $option)
		<option @if (!empty($advert_props) && isset($advert_props[48]) && in_array($option->id, $advert_props[48])) selected  @endif value="{{ $option->id }}">{{$option->name}}</option>
	@endforeach
</select>