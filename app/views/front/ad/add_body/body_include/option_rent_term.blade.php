<ul class="add_ad_option__list_horizontal">
	<li>
		<span class="icon-31 add_ad_option__img"></span>
		<span class="add_ad_option__title">{{TransWord::getArabic('Terms')}}* </span>
	</li>
	<li>
		<input type="radio" name="prop[4]" value="3"
               {{ (!empty($advert_props) && isset($advert_props[4]) && in_array(3, $advert_props[4])) ? 'checked' : '' }} />{{TransWord::getArabic('Hourly')}}
	</li>
	<li>
		<input type="radio" name="prop[4]" value="4"
               {{ (!empty($advert_props) && isset($advert_props[4]) && in_array(4, $advert_props[4])) ? 'checked' : '' }}/>{{TransWord::getArabic('Daily')}}
	</li>
	<li>
		<input type="radio" name="prop[4]" value="5"
               {{ (!empty($advert_props) && isset($advert_props[4]) && in_array(5, $advert_props[4])) ? 'checked' : '' }} />{{TransWord::getArabic('Monthly')}}
	</li>
</ul>
