<span class="{{ $props->get(24)->icon }} add_ad_option__img">
{{TransWord::getArabic($props->get(24)->name)}}
@foreach ($props->get(24)->relPropOption as $option)
	<input name='prop[24]' type="radio" value='{{ $option->id }}'
           {{ (!empty($advert_props) && isset($advert_props[24]) && in_array($option->id, $advert_props[24])) ? 'checked' : '' }} > <label class='add_ad_option__label' for='prop[12]'>{{$option->name}} <label>
@endforeach