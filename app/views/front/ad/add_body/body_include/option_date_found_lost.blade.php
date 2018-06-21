<div class="col-md-45">
	<span class="{{ $props->get(25)->icon }} add_ad_option__img"> </span>
	<span>{{TransWord::getArabic($props->get(25)->name)}}</span>
</div>
<div class="col-md-45">
	<input name="prop[25]" type="date" class="add_ad_option__inline" data-date="" data-date-format="MMMM DD YYYY"
           value="{{ (!empty($advert_props) && isset($advert_props[25])) ? $advert_props[25][0] : '' }}"
        />
</div>
<div style="clear:both;"></div>