
<div class="add_ad_line">
	<div class="add_ad_line__title" style='    text-align: right;'>
		{{TransWord::getArabic('Select quick sell options and post your ad')}}
	</div>
	<div class="add_ad_line__stroke">&nbsp;</div>
	<div class="add_ad_line__ball_1 add_ad_line__ball-check"><span>&#10004;</span></div>
	<div class="add_ad_line__ball_2 add_ad_line__ball-check"><span>&#10004;</span></div>
	<div class="add_ad_line__ball_3 add_ad_line__ball-green">&nbsp;</div>
</div>

<div class="add_ad_vip">
	<div class="add_ad_vip__top">
		<img class="add_ad_vip__title_img" src="/front/img/icons/more_info.png">
		{{TransWord::getArabic('Sell your ad quick!',false)}}
	</div>
	<div class="add_ad_vip__body">
		<div class="add_ad_vip_block">
			<!---- green block ------------>
			<div class="add_ad_vip_block__item {{ $advert->is_green ? '' : 'add_ad_vip_block__item_grey' }} js-vip-option"  id='add_ad_vip_block__1' data-sum='0' data-val_selector='js_add_advert_is_green'>
				<div class="add_ad_vip_block__price"><strike>{{TransWord::getArabic('AED')}} 7</strike> <br />{{TransWord::getArabic('FREE')}}</div>
				<div class="add_ad_vip_block__price-back">&nbsp;</div>
				<div class="add_ad_vip_block__check">
					<span class="{{ $advert->is_green ? 'icon-33' : 'icon-32' }} js-check_vip">&nbsp;</span>
				</div>
				<div class="add_ad_vip_block__body">
					<h2 class="add_ad_vip_block__title green">{{TransWord::getArabic('Color',false)}}</h2>
					<h4 class="add_ad_vip_block__sub_title"> {{TransWord::getArabic('Make your ad visible',false)}}</h4>
					<span class="add_ad_vip_block__slogan">{{TransWord::getArabic('Available for 7 days',false)}}</span>

				</div>
				<div class="add_ad_vip_block__bottom">
					<img src="/front/img/ad_as_vip.png">
				</div>
			</div>
			
			<!---- sale block ------------>
			<div class="add_ad_vip_block__item {{ $advert->is_sale ? '' : 'add_ad_vip_block__item_grey' }} js-vip-option"  id='add_ad_vip_block__2' data-sum='0' data-val_selector='js_add_advert_is_sale'>
				<div class="add_ad_vip_block__price"><strike>{{TransWord::getArabic('AED')}} 7</strike> <br />{{TransWord::getArabic('FREE')}}</div>
				<div class="add_ad_vip_block__price-back">&nbsp;</div>
				<div class="add_ad_vip_block__check">
					<span class="{{ $advert->is_sale ? 'icon-33' : 'icon-32' }} js-check_vip">&nbsp;</span>
				</div>
				<div class="add_ad_vip_block__body">
					<h2 class="add_ad_vip_block__title black">{{TransWord::getArabic('Price')}}</h2>
					<span class="add_ad_vip_block__slogan">{{TransWord::getArabic('Available for 7 days',false)}}</span>

				</div>
				<div class="add_ad_vip_block__bottom">
					<div class="add_ad_vip_block__bottom_line">
						<div class="col-md-25 add_ad_vip_block__input_label"> {{TransWord::getArabic('was')}} </div>
						<div class="col-md-70">
							<input type='text' name='advert_pay[price_was]' class="idiot_price_format js-add-ad-price-value add_ad_vip_block__input js-add-ad-price-value3333"  value="{{ ($advert->discount_was_price > 0) ? $advert->discount_was_price : $advert->price }}"/>
						 </div>
					</div>
					<div class="add_ad_vip_block__bottom_line">
						<div class="col-md-25 add_ad_vip_block__input_label"> {{TransWord::getArabic('now')}} </div>
						<div class="col-md-70">
							<input type='text' name='advert_pay[price_now]' class="idiot_price_format add_ad_vip_block__input js-add-ad-price-value4444" value="{{ $advert->discount_price }}"/>
						 </div>
					</div>
				</div>
			</div>
		</div>
		<div class="add_ad_vip_block">
			<!---- hot_deal and urgent block ------------>
			<div class="add_ad_vip_block__item {{ ($advert->urgent || $advert->hot_price) ? '' : 'add_ad_vip_block__item_grey' }}  js-vip-option"  id='add_ad_vip_block__3' data-sum='0' data-val_selector='js_add_advert_is_hot_or_urgent'>
				<div class="add_ad_vip_block__price"><strike>{{TransWord::getArabic('AED')}} 7</strike> <br />{{TransWord::getArabic('FREE')}}</div>
				<div class="add_ad_vip_block__price-back">&nbsp;</div>
				<div class="add_ad_vip_block__check">
					<span class="icon-32 js-check_vip" style='visibility: hidden;'>&nbsp;</span>
				</div>
				<div class="add_ad_vip_block__body">
					<br />
					<h2 class="add_ad_vip_block__title">{{TransWord::getArabic('Make your ad Hot')}}</h2>

				</div>
				<div class="add_ad_vip_block__bottom">
					<div class="add_ad_vip_block__bottom_line">
						<div class="col-md-50 add_ad_vip_block__input_check">
							<span class="{{ $advert->hot_price ? 'icon-33 active' : 'icon-32' }} js-add_ad_hot_deal_click"  style='font-size: 16px;
																		display: inline-block;
																		width: 14px;
																		position: relative;
																		top: 3px;
																		cursor: pointer;' >&nbsp;</span>
							{{TransWord::getArabic('Hot deal')}}
						</div>
						<div class="col-md-50 add_ad_vip_block__input_check">
							<span class="{{ $advert->urgent ? 'icon-33 active' : 'icon-32' }} js-add_ad_urgent_click" style='font-size: 16px;
																		display: inline-block;
																		width: 14px;
																		position: relative;
																		top: 3px;
																		cursor: pointer;' >&nbsp;</span>
							{{TransWord::getArabic('Urgent')}}
						</div>
					</div>
					<div class="add_ad_vip_block__bottom_line">
						<p class="add_ad_vip_block__slogan">{{TransWord::getArabic('Available for 7 days',false)}}</p>
						<img src="/front/img/timer.png">
					</div>
				</div>
			</div>
			
			<!---- vip block ---------->
			<div class="add_ad_vip_block__item {{ $advert->vip ? '' : 'add_ad_vip_block__item_grey' }} js-vip-option"  id='add_ad_vip_block__4' data-sum='0' data-val_selector='js_add_advert_is_vip'>
				<div class="add_ad_vip_block__check">
					<span class="{{ $advert->vip ? 'icon-33': 'icon-32' }} js-check_vip">&nbsp;</span>
				</div>
				<div class="add_ad_vip_block__body">
					<br />
					<h2 class="add_ad_vip_block__title">{{TransWord::getArabic('TOP only for AED 0,25')}}</h2>
					<h5 class="add_ad_vip_block__sub_title-small"> {{TransWord::getArabic('Increase views of your ad for')}} 18 {{TransWord::getArabic('times')}}</h5>
				</div>
				<div class="add_ad_vip_block__bottom">
					<div class="add_ad_vip_block__bottom_line">
						<span class="icon-10 ad_add_eye_icon">&nbsp;</span>
						<span class="one_view_cost"> 1 {{TransWord::getArabic('view')}} - {{TransWord::getArabic('AED')}} 0,25</span>
					</div>
					<div class="add_ad_vip_block__bottom_line">
						<div class="col-md-45">
							<input name='advert_pay[vip_count]' value="{{ ($advert->is_vip_counter < 100) ? 100 : $advert->is_vip_counter }}" type='number' class="add_ad_vip_block__input js-vip_view-input" placeholder="100" min='100' />
							<small>{{TransWord::getArabic('min 100 views',false)}}</small>
						</div>
						<div class="col-md-50 col-md-offset-5 js-vip_view-value" style="color: #d41f26; font-size: 16px; line-height: 20px; font-weight: 600;">
							{{TransWord::getArabic('AED') }} {{ ($advert->is_vip_counter*0.25) }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="add_ad_vip__bottom">
		&nbsp;
	</div>
	<br />
	<div class="row">
		<div class="col-md-45">
			<div style='border-bottom: 1px solid #d41f26; padding-bottom5px; width: 100%;'>
				<span style="color: #d41f26; font-size: 18px; font-weight: 600;">{{TransWord::getArabic('TOTAL')}}: </span>
				<span style="color: #568b3e; font-size: 18px; font-weight: 600;" class="js-total-vip-sum" data-balans='{{ (Auth::check() ? Budjet::getBalans(Auth::user()) : 0) }}'>{{TransWord::getArabic('FREE',false)}}</span>
			</div>
		</div>
		<div class="col-md-10">
			&nbsp;
		</div>
		<div class="col-md-45">
			<p style=" font-size: 10px;">
				<span class="icon-32 js-check_terms" style='font-size: 20px; float:left; display:inline-block; cursor: pointer; color: inherit;'>&nbsp;</span>
				<span class='js_call_modal_terms' style='cursor: pointer'>
					{{ TransWord::getArabic('I have read the <span style="  color: #15499f;
																			font-weight: 600;">"Terms & Conditions"</span> and agree to abide by them') }}
				</span>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-45">
			<span style="font-size: 15px;">{{ TransWord::getArabic('Your balance') }}: </span>
			<span class="icon-38" style="color: #f3b904; font-size: 27px; position: relative; top: 5px;"> </span>
			<strong style="font-size: 16px;"> {{ (Auth::check() ? Budjet::getBalans(Auth::user()) : 0) }}  {{ TransWord::getArabic('AED') }}</strong>
			
			<span class='js-default-user-balans-info' style='display:none;border: 1px solid red !important;
																padding: 2px 5px;
																margin-top: 5px;'>Not enough money! Refill your balans</span>
																		
			<input type='hidden' class='js-default-user-balans' value="{{ (Auth::check() ? Budjet::getBalans(Auth::user()) : 0) }}">
		</div>
		<div class="col-md-10">
			&nbsp;
		</div>
	</div>

	<input type='hidden' name='advert_pay[is_green]' value='{{ $advert->is_green }}' class='js_add_advert_is_green' />
	<input type='hidden' name='advert_pay[is_sale]' value='{{ $advert->is_sale }}' class='js_add_advert_is_sale' />
	<input type='hidden' name='advert_pay[is_hot_or_urgent]' value='{{ $advert->urgent | $advert->hot_price }}' class='js_add_advert_is_hot_or_urgent' />
	<input type='hidden' name='advert_pay[is_vip]' value='{{ $advert->vip }}' class='js_add_advert_is_vip' />
	
	<input type='hidden' name='advert_pay[is_hot]' value='{{ $advert->hot_price }}' class='js_add_advert_is_hot' />
	<input type='hidden' name='advert_pay[is_urgent]' value='{{ $advert->urgent }}' class='js_add_advert_is_urgent' />
	
	
</div>