@foreach ($props->get(22)->relPropOption as $option)
	<div style="width: 65px; display: inline-block;">
		<input name='prop[22]' type="radio" value='{{ $option->id }}'
               {{ (!empty($advert_props) && isset($advert_props[22]) && in_array($option->id, $advert_props[22])) ? 'checked' : '' }} > <label class='add_ad_option__label' for='prop[12]'>{{$option->name}} <label>
	</div>
@endforeach
