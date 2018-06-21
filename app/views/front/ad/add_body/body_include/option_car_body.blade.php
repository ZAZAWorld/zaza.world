<span class="icon-88 add_ad_option__img"></span>
<select name="prop[6]" data-placeholder="Body" class="add_ad_option__inline chosen-select">
	<option selected="Body" value="Body" disabled>Body</option>
	@foreach ($props->get(6)->relPropOption as $option)
		<option @if (!empty($advert_props) && isset($advert_props[6]) && in_array($option->id, $advert_props[6])) selected  @endif value="{{ $option->id }}">{{$option->name}}</option>
	@endforeach
</select>