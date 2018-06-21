<span class="term_ico"></span>
<span>{{TransWord::getArabic($props->get(33)->name)}}*</span>
@foreach ($props->get(33)->relPropOption as $option)
	<div style="width: auto; display: inline-block;">
		<input name='prop[33]' type="radio" value='{{ $option->id }}'
               {{ (!empty($advert_props) && isset($advert_props[33]) && in_array($option->id, $advert_props[33])) ? 'checked' : '' }} />
		<label class='add_ad_option__label' for='prop[33]'>{{TransWord::getArabic($option->name,false)}} </label>
	</div>
@endforeach