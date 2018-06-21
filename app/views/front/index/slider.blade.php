<div style="position:relative;">

<div class="wrapper_shadow"></div>
	<ul class="m-slider bxslider">
	<!--
		<li><iframe width="560" height="315" src="https://www.youtube.com/embed/t5vta25jHQI?showinfo=0&enablejsapi=1&origin=https://zaza.ae:8350" frameborder="0" allowfullscreen class="m-slider__image"></iframe></li>
		
		<li>
			<img src="/front/img/play_tab_hover.png" class="license_item_play license_item_ifram" />
			<img src="/front/img/background5.png" class="m-slider__image license_item_ifram" />
			
		</li>
		-->
		
		@if (SysAdBannerPartners::where('status_id', 4)->count() > 0)
			@foreach (SysAdBannerPartners::where('status_id', 4)->get() as $banner) 
				<li>
					<div class="m-slider__image" style="background: url({{ $banner->banner }}) no-repeat center; background-size: cover;"></div>
				</li>
			@endforeach
		@else 
			<li>
				<div class="m-slider__image" style="background: url('/front/img/background1.jpg') no-repeat center; background-size: cover;"></div>
			</li>
			<li>
				<div class="m-slider__image" style="background: url('/front/img/background2.jpg') no-repeat center; background-size: cover;"></div>
			</li>
			<li>
				<div class="m-slider__image" style="background: url('/front/img/background3.jpg') no-repeat center; background-size: cover;"></div>
			</li>
			<li>
				<div class="m-slider__image" style="background: url('/front/img/background_adv.jpg') no-repeat center; background-size: cover;"></div>
			</li>
			<li>
				<div class="m-slider__image" style="background: url('/front/img/background4.jpg') no-repeat center; background-size: cover;"></div>
			</li>
			<li>
				<div class="m-slider__image" style="background: url('/front/img/background5.jpg') no-repeat center; background-size: cover;"></div>
			</li>
			<li>
				<div class="m-slider__image" style="background: url('/front/img/background6.jpg') no-repeat center; background-size: cover;"></div>
			</li>
			<li>
				<div class="m-slider__image" style="background: url('/front/img/background_adv.jpg') no-repeat center; background-size: cover;"></div>
			</li>
			<li>
				<div class="m-slider__image" style="background: url('/front/img/background7.jpg') no-repeat center; background-size: cover;"></div>
			</li>
			<li>
				<div class="m-slider__image" style="background: url('/front/img/background8.jpg') no-repeat center; background-size: cover;"></div>
			</li>
			
			<li>
				<div class="m-slider__image" style="background: url('/front/img/background_adv.jpg') no-repeat center; background-size: cover;"></div>
			</li>
			
		@endif
		
	</ul>
	<iframe src="https://www.youtube.com/embed/t5vta25jHQI?showinfo=0&enablejsapi=1&origin=https://zaza.ae:8350" class="license_item_ifram_org" style="display:none" frameborder="0" allowfullscreen></iframe>
	<div class="m-company-bar">
		<div class="m-company-bar__item">
			<button class="h-button_green shadow js-open-company-bar" data-id='2'>{{TransWord::getArabic('SERVICE PROVIDERS')}}</button>
		</div>
		<div class="m-company-bar__item">
			<button class="h-button_red shadow js-open-company-bar" data-id='3'>{{TransWord::getArabic('STORES')}}</button>
		</div>
		<?php
		 //<div class="m-company-bar__item">
		 //	<button class="h-button_blue shadow js-open-company-bar" data-id='1'>{{TransWord::getArabic('Dining & Outing')}}</button>
		 //</div>
		?>
	</div>

	<div class="m-advert-bar">
		@foreach (SysAdvertCat::where(function($q) { $q->where('id', 4)->orWhere('id', 5)->orWhere('id', 7)->orWhere('id', 6);})->get() as $cat_1)

				@if ($cat_1->name == 'Services')
				     <a href="#bar" class="m-advert-bar__link bar_link_blue" data-id='{{ $cat_1->id }}'>
					 <span class="{{ $cat_1->icon }}"></span>
				     <span class="name" style="padding-right:10px;">{{ TransWord::getArabic($cat_1->name) }}</span>
				@elseif($cat_1->name == 'Business')
					 <a href="#bar" class="m-advert-bar__link bar_link_red" data-id='{{ $cat_1->id }}'>
					 <span class="{{ $cat_1->icon }}"></span>
					 <span class="name" style="padding-right:10px;">{{ TransWord::getArabic($cat_1->name) }}</span>
				@elseif($cat_1->name == 'Consumer Goods')
					 <a href="#bar" class="m-advert-bar__link bar_link_orange" data-id='{{ $cat_1->id }}'>
					 <span class="{{ $cat_1->icon }}"></span>
					 <span class="name">{{ TransWord::getArabic($cat_1->name) }}</span>
				@elseif($cat_1->name == 'Equipments and Materials ')
					 <a href="#bar" class="m-advert-bar__link bar_link_zel" data-id='{{ $cat_1->id }}'>
					 <span class="{{ $cat_1->icon }}"></span>
					 <span class="name" >{{ TransWord::getArabic($cat_1->name) }}</span>
				@endif
			</a>
		@endforeach
	</div>

</div>

