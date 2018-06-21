<div class="add_ad_price_field">
	<span class="icon-38 add_ad_price_field__img"></span>
	<input name='price' value="{{ !empty($advert) ? $advert->price : '' }}" type="text" class="add_ad_price_field__input new_price_format js-add-ad-price-value js-add-ad-price-value22222222 normalValidate " placeholder='Price *'/>
</div>
@if ((isset($ad_negotiable) && $ad_negotiable) || (isset($ad_exchange) && $ad_exchange) || (isset($ad_free) && $ad_free))
	<div class="add_ad_price_dop">
		@if (isset($ad_negotiable) && $ad_negotiable)
			<div class="add_ad_price_dop__block">
				<input name='negotiable' type="checkbox" class="add_ad_price_dop__item js-add-ad-price-negotiable" value='1' {{ ((!empty($advert) && $advert->negotiable) ? 'checked': null) }}> {{TransWord::getArabic('Negotiable',false)}}
			</div>
		@endif
		@if (isset($ad_exchange) && $ad_exchange)
			<div class="add_ad_price_dop__block">
				<input name='exchange' type="checkbox" class="add_ad_price_dop__item js-add-ad-price-exchange" value='1' {{ ((!empty($advert) && $advert->exchange) ? 'checked': null) }}> {{TransWord::getArabic('Exchange',false)}}
			</div>
		@endif
		@if (isset($ad_free) && $ad_free)
			<div class="add_ad_price_dop__block">
				<input name='free' type="checkbox" class="add_ad_price_dop__item js-add-ad-price-free" value='1' {{ ((!empty($advert) && $advert->free) ? 'checked': null) }}> {{TransWord::getArabic('Free',false)}}
			</div>
		@endif
	</div>
@endif