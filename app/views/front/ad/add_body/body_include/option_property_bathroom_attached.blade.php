<span class="{{ $props->get(54)->icon }} add_ad_option__img">
<span>{{TransWord::getArabic($props->get(54)->name)}}</span>
@foreach ($props->get(54)->relPropOption as $option)
	<input name='prop[54]' type="radio" value='{{ $option->id }}' > <label class='add_ad_option__label' for='prop[54]'>{{TransWord::getArabic($option->name,false)}}</label>
@endforeach