<input name='prop[46]' type="text" class="add_ad_field idiot_price_format js-add-ad-price-value22222222" style="width:50%; margin-right:10px;" placeholder="{{$props->get(46)->name}}"
       value="{{ (!empty($advert_props) && isset($advert_props[46])) ? $advert_props[46][0] : '' }}" />
<ul class="add_ad_option__list_horizontal" style="display: inline-block;">
	<li style="margin-top: 10px;">
		<input type="checkbox" name="to_be_discuss" class='js_joijijads45878897' value="1" />{{TransWord::getArabic('To be discussed')}}
	</li>
</ul>