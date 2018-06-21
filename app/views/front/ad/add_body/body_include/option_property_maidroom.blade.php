<span class="{{ $props->get(31)->icon }} add_ad_option__img">
<span>{{TransWord::getArabic($props->get(31)->name)}}</span>
@foreach ($props->get(31)->relPropOption as $option)
	<input name='prop[31]' type="radio" value='{{ $option->id }}'
           {{ (!empty($advert_props) && isset($advert_props[31]) && in_array($option->id, $advert_props[31])) ? 'checked' : '' }} > <label class='add_ad_option__label' for='prop[31]'>{{TransWord::getArabic($option->name,false)}}</label>
@endforeach