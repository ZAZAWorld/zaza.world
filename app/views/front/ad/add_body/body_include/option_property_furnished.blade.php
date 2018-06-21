<span class="{{ $props->get(30)->icon }} add_ad_option__img">
<span>{{TransWord::getArabic($props->get(30)->name)}}</span>
@foreach ($props->get(30)->relPropOption as $option)
	<input name='prop[30]' type="radio" value='{{ $option->id }}'
           {{ (!empty($advert_props) && isset($advert_props[30]) && in_array($option->id, $advert_props[30])) ? 'checked' : '' }} > <label class='add_ad_option__label' for='prop[30]'>{{TransWord::getArabic($option->name,false)}}</label>
@endforeach