<span class="icon-68 add_ad_option__img">
@foreach ($props->get(12)->relPropOption as $option)
	<div style="width: auto; display: inline-block;">
		<input name='prop[12]' type="radio" value='{{ $option->id }}' {{ (!empty($advert_props) && isset($advert_props[12]) && in_array($option->id, $advert_props[12])) ? 'checked' : '' }}>
		<label class='add_ad_option__label' for='prop[12]'>{{$option->name}} </label>
	</div>
@endforeach