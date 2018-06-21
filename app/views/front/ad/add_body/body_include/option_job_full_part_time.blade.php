<span class="term_ico"></span>
@foreach ($props->get(50)->relPropOption as $option)
	<input name='prop[50]' type="radio" value='{{ $option->id }}' {{ (!empty($advert_props) && isset($advert_props[50]) && in_array($option->id, $advert_props[50])) ? 'checked' : '' }} > <label class='add_ad_option__label' for='prop[50]'>{{$option->name}}</label><br />
@endforeach