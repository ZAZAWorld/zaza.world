<ul class="add_ad_option__list_horizontal">
	<li style="margin-top: 10px;">
		<input type="checkbox" name="prop[5]" {{ (!empty($advert_props) && isset($advert_props[5]) && in_array($option->id, $advert_props[5])) ? 'checked' : '' }} value="1" />{{TransWord::getArabic('With Driver')}}
	</li>
</ul>