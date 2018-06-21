@if (Auth::check())
	<div class='last_ad_block shadow js-custom-scroll'>
		@if(AdvertView::getUserList())
			@foreach (AdvertView::getUserList() as $i) 
				@if (!$i->relAdvert)
					<?php continue; ?>
				@endif
				<div class="advert"  data-id='{{ $i->relAdvert->id }}'>
					<a href="#link-advert" class="advert__link" data-id='{{ $i->relAdvert->id }}'>
						<div class="advert__image-block" style="background:#eee url('{{ $i->relAdvert->photo }}') no-repeat center center; background-size: contain;">
						</div>
						<div class="advert__text-block">
							<h3 class="advert__title">{{$i->relAdvert->title}}</h3>
							<p>{{TransWord::getArabic('AED')}} <strong>{{$i->relAdvert->price_name}}</strong></p>
						</div>
					</a>
				</div>
			@endforeach
		@else 
			<p>{{TransWord::getArabic('Note have any results',false)}}</p>
		@endif 
		
	</div>
@else 
	<div class='last_ad_block shadow js-custom-scroll'>
		@if(AdvertView::getUserList())
			@foreach (AdvertView::getUserList() as $i) 
				<div class="advert"  data-id='{{ $i->id }}'>
					<a href="#link-advert" class="advert__link" data-id='{{ $i->id }}'>
						<div class="advert__image-block" style="background:#eee url('{{ $i->photo }}') no-repeat center center; background-size: contain;">
						</div>
						<div class="advert__text-block">
							<h3 class="advert__title">{{$i->title}}</h3>
							<p>{{TransWord::getArabic('AED')}} <strong>{{$i->price_name}}</strong></p>
						</div>
					</a>
				</div>
			@endforeach
		@else 
			<p>{{TransWord::getArabic('Note have any results',false)}}</p>
		@endif 
		
	</div>
	
@endif 