<div style="background: #f3f3f3; overflow: hidden; padding: 1px 0 5px 0;">
	<span class="icon-70 add_ad_option__img" style="float: left; margin-right: 10px;"> </span>
@foreach ($props->get(14)->relPropOption as $option)
	<div style="width: 65px; margin-top:2px; display: inline-block;">
		<input name='prop[14]' type="radio" value='{{ $option->id }}' {{ (!empty($advert_props) && isset($advert_props[14]) && in_array($option->id, $advert_props[14])) ? 'checked' : '' }}>
		<label class='add_ad_option__label' for='prop[14]'>{{$option->name}} </label>
	</div>
@endforeach

</div>