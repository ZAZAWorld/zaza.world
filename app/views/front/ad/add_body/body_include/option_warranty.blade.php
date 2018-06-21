<span class="icon-50 add_ad_option__img"></span>
<span>{{TransWord::getArabic($props->get(11)->name)}}</span>
@foreach ($props->get(11)->relPropOption as $option)
	<div style="width: auto; display: inline-block;">
	<input name='prop[11]' type="radio" value='{{ $option->id }}' {{ (!empty($advert_props) && isset($advert_props[11]) && in_array($option->id, $advert_props[11])) ? 'checked' : '' }}> <label class='add_ad_option__label' for='prop[11]'>{{TransWord::getArabic($option->name,false)}} </label></div>
@endforeach