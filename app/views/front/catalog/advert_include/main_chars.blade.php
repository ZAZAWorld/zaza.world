<div class="ad_header">
	<div class="ad_header__title">
		@if($advert->relOneCat->cat2_id != 17)
			{{ $advert->title }}
		@elseif($advert->relOneCat->cat2_id == 17)
            <?php
            $title_auto = substr($advert->title,0,-5).",".substr($advert->title,-5);
            ?>
			{{ $title_auto }}
		@endif
		<div class="ad_header__location">
		{{ mb_substr(ucfirst($advert->address), 0, 40, 'UTF-8') }}
		</div>
	</div>
	<div class="ad_header__price" style='text-align: right;'>
		@if ($advert->price && isset($advert_cat) && $advert_cat->cat1_id == 3)
			{{TransWord::getArabic('AED',false)}}  <span class="price">{{ $advert->spec_price_two_name }}</span>
		@elseif(isset($advert_cat) && $advert_cat->cat1_id == 3)
			To be discussed
		@else 
			{{TransWord::getArabic('AED',false)}}  <span class="price">{{ $advert->spec_price_two_name }}</span>
		@endif
		<div style='overflow: hidden'>
			@if ($advert->negotiable || $advert->exchange || $advert->free)
				<?php 
					$ar_spec_price = array(); 
					if ($advert->negotiable)
						$ar_spec_price[] = TransWord::getArabic('Negotiable',false);
					if ($advert->exchange)
						$ar_spec_price[] = TransWord::getArabic('Exchange',false);
					if ($advert->free)
						$ar_spec_price[] = TransWord::getArabic('Free',false);
				?>
				<div style='font-size: 16px; height: 28px; color: #d41f26; font-weight: 400; float:left; position: relative; top: 4px'>
					{{ (implode(", ", $ar_spec_price)) }}
				</div>
			@endif
			@if($advert->user_type_id == 4)
			    @if ($advert->urgent || $advert->hot_price)
				    <div class='timer_2_block' style='float:left'>
					    <div class='my_timer_2' data-date-end='{{ $advert->getTimeEndSale() }}' data-date-start='{{ $advert->getTimeStartSale() }}'>
						    <span class='my_timer_2_block'>
						    	<span class='my_timer_2_el day'>9</span>
						    	<span class='my_timer_2_el day'>9</span>
						    	<span class='my_timer_2_sign'>{{TransWord::getArabic('days',false)}}</span>
							</span>
						       <span class='jojojasdpf'>:</span>
						       <span class='my_timer_2_block'>
						     	<span class='my_timer_2_el hour'>9</span>
						    	<span class='my_timer_2_el hour'>9</span>
						     	<span class='my_timer_2_sign'>{{TransWord::getArabic('hours',false)}}</span>
						    </span>
					        	<span class='jojojasdpf'>:</span>
					        	<span class='my_timer_2_block'>
					     		<span class='my_timer_2_el minute'>9</span>
						    	<span class='my_timer_2_el minute'>9</span>
						    	<span class='my_timer_2_sign'>{{TransWord::getArabic('min',false)}}</span>
						     </span>
					        	<span class='jojojasdpf'>:</span>
					        	<span class='my_timer_2_block'>
						    	<span class='my_timer_2_el second'>9</span>
						    	<span class='my_timer_2_el second'>9</span>
							    <span class='my_timer_2_sign'>{{TransWord::getArabic('sec',false)}}</span>
						     </span>
					    </div>
					</div>
			    @endif
			@endif
		</div>
	</div>
	
</div>
<div class="ad_prop">
	<div class="ad_prop_item">
		@if (isset($props) and $props)
			@foreach ($props as $prop) 
				@if($prop->prop_val && $prop->prop_id == 17)
					<?php continue; ?>
				@endif
				<!--
				@if($prop->prop_val && $prop->prop_id != 17)
					<span class="ad_prop_item__val">
						@if ($prop->prop && $prop->prop->icon)
							<span class='{{ $prop->prop->icon }}'> </span><br />
						@else 
							{{TransWord::getArabic($prop->prop->name)}}<br />
						@endif
						{{ $prop->prop_val }}
					</span>
				@endif
				-->
				@if($prop->prop_id != 50)
						<span class="ad_prop_item__val  podskazka" hover-text="{{TransWord::getArabic($prop->prop->name)}}">
				@elseif($prop->prop_id == 50)
						<span class="ad_prop_item__val  podskazka_fulltime" hover-text="{{TransWord::getArabic($prop->prop->name)}}">
				@endif
					@if ($prop->prop_val && $prop->prop_id == 15)
						<span class='icon-71' style='position: relative; top: 7px;'> </span><br />
					@elseif ( $prop->prop_id == 34)
						<span class='cheque_ico' style='position: relative; top: -4px;'> </span><br />
					@elseif ($prop->prop && $prop->prop->icon)
						@if ($prop->prop->icon != 'icon-16')
							<span  class='{{ $prop->prop->icon }}'> </span><br />
						@else
							<span class='icon-192' style='position: relative;'> </span><br />
						@endif
					@else 
						{{TransWord::getArabic($prop->prop->name)}}<br />
					@endif
					
					@if ($prop->prop_val && $prop->prop_id == 8) 
						{{ $prop->prop_val }} km
					@elseif ($prop->prop_val && $prop->prop_id == 7)
						{{ $prop->prop_val }} HP
					@elseif ($prop->prop_val && $prop->prop_id == 11)
						{{ $prop->prop_val }} 
					@elseif ($prop->prop_val && $prop->prop_id == 15)
						<span class='show_ad_color_option {{ $prop->prop_val }}-{{ $prop->prop_id }}' style='background-color: {{ $prop->prop_val }};
																	display: inline-block;
																	width: 10px;
																	height: 10px;
																	border-radius: 50%;
																	margin-top: 7px;'>&nbsp; </span>
					@elseif ($prop->prop_val && $prop->prop_id == 34)
						{{ $prop->prop_val }}
					@elseif ($prop->prop_val && $prop->prop_id == 27)
						{{ $prop->prop_val }} sq.ft
					@elseif ($prop->prop_val)
						{{ $prop->prop_val }}
					@else 
						&nbsp;
					@endif
				</span>
			@endforeach
		@endif
	</div>
	<div class="ad_prop_owner">
		<a href='{{ action('PersonController@getView', $owner->id) }}'>
			<div class="ad_prop_owner__logo" style="background:url({{ $owner->photo }}) no-repeat center center; background-size: cover">
			</div>
		</a>
		<div class="ad_prop_owner__stat">
			@if ($owner->checkUserOnlain())
				<span class="ad_prop_owner__stat_onlain active">
					<span class="circle">&nbsp;</span>
					 {{ TransWord::getArabic('Online') }}
				 </span>
			@endif
			@if (Auth::check())
			<span class="ad_prop_owner__stat_chat" data-owner-id="{{ $advert->user_id }}">
				<img src="/front/img/icons/ad_chat.png" />
				<span class="ad_prop_owner__stat_chat_text">{{TransWord::getArabic('chat')}} </span>
			</span>
			@else
				<span class="qtip-rounded hasTooltip">
				<img src="/front/img/icons/ad_chat.png" />
				<span class="ad_prop_owner__stat_chat_text">{{TransWord::getArabic('chat')}} </span>
			    </span>
				<div class="hidden qtip-rounded">
					{{TransWord::getArabic('Please',false)}}
					<a href='#login' class='js-login'>{{TransWord::getArabic('sign_in',false)}}</a> <br />
					{{TransWord::getArabic('to use',false)}} <br />
					{{TransWord::getArabic('this function',false)}}
				</div>
			@endif
		</div>
	</div>
</div>