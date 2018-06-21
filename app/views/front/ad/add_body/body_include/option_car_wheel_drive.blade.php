<span class="icon-13 add_ad_option__img">
@foreach ($props->get(10)->relPropOption as $option)
	<div style="width: auto; display: inline-block;">
		<input name='prop[10]' type="radio" value='{{ $option->id }}'
               {{ (!empty($advert_props) && isset($advert_props[10]) && in_array($option->id, $advert_props[10])) ? 'checked' : '' }} >
		<label class='add_ad_option__label' for='prop[10]'>{{$option->name}} </label>
	</div>
@endforeach
