<span class="{{ $props->get(32)->icon }} add_ad_option__img">
<span>{{$props->get(32)->name}}</span>
@foreach ($props->get(32)->relPropOption as $option)
	<input name='prop[32]' type="radio" value='{{ $option->id }}'
           {{ (!empty($advert_props) && isset($advert_props[32]) && in_array($option->id, $advert_props[32])) ? 'checked' : '' }} > <label class='add_ad_option__label' for='prop[32]'>{{$option->name}} <label>
@endforeach