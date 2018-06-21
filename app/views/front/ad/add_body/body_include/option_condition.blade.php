<span class="icon-72 add_ad_option__img"></span>
<span>{{ TransWord::getArabic($props->get(13)->name) }}</span>
@foreach ($props->get(13)->relPropOption as $option)
	<div style="width: auto; display: inline-block;">
		<label class='add_ad_option__label' for='prop[13]'><input name='prop[13]' type="radio" value='{{ $option->id }}' {{ (!empty($advert_props) && isset($advert_props[13]) && in_array($option->id, $advert_props[13])) ? 'checked' : '' }}> {{TransWord::getArabic($option->name,false)}}</label>
	</div>
@endforeach