 <!--<span class="{{ $props->get(23)->icon }} add_ad_option__img">
	<span>{{TransWord::getArabic($props->get(23)->name)}}</span>-->
@foreach ($props->get(23)->relPropOption as $option)
	<input name='prop[23][]' type="checkbox" class="" value='{{ $option->id }}'
           {{ (!empty($advert_props) && isset($advert_props[23]) && in_array($option->id, $advert_props[23])) ? 'checked' : '' }} >
		<label class='add_ad_option__label' for='prop[23]' {{ (!empty($advert_props) && isset($advert_props[11]) && in_array($option->id, $advert_props[11])) ? 'checked' : '' }}>{{$option->name}} <label>
@endforeach