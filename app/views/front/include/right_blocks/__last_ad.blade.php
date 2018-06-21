@if (Auth::check())
	<div class='last_ad_block shadow js-custom-scroll'>
		@if(AdvertView::getUserList())
			@foreach (AdvertView::getUserList() as $i) 
				@if (!$i->relAdvert)
					<?php continue; ?>
				@endif
				<div class="advert"  data-id='{{ $i->relAdvert->id }}'>
					<a href="#link-advert" class="advert__link" data-id='{{ $i->relAdvert->id }}'>
						<div class="advert__image-block {{ ($->relAdvert->checkView() ? 'normal_blur' : null ) }}" 
								style="background:#eee url('{{ $i->relAdvert->photo }}') no-repeat center center; background-size: contain;">
							@if ($i->relAdvert->urgent || $i->relAdvert->hot_price)
								<div class="advert__urgent">
									@if ($i->relAdvert->urgent)
										<img src="/front/img/icons/urgent.png"/>
									@endif
									@if ($i->relAdvert->hot_price)
										<div class="ad_vip_block_text">{{TransWord::getArabic('Hot Deal',false)}}</div>
									@endif
									<div class="advert__urgent__trangle"> </div>
								</div>
							@endif
							
							
							
						</div>
						
						<div class="advert__text-block">
							<h3 class="advert__title">{{$i->relAdvert->title}}</h3>
							<p>
								@if (empty($hide_sum))
									@if ($i->relAdvert->spec_price_name != 0)
										{{TransWord::getArabic('AED')}} <strong>{{$i->relAdvert->spec_price_name}}</strong>
									@elseif ($i->relAdvert->to_be_discuss = 1)
										{{TransWord::getArabic('AED')}} <strong>{{$i->relAdvert->spec_price_name}}</strong>
									@endif
								@endif
								
								@if ($i->relAdvert->relOneCat->cat1_id == 3 &&  $i->relAdvert->relOneCat->cat2_id == 33)
									<?php $cat_sadasd = SysAdvertCat::find($i->relAdvert->relOneCat->cat3_id); ?>
									@if ($cat_sadasd)
										{{TransWord::getArabic($cat_sadasd->name,false)}}
									@endif
								@endif
							</p>
							
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
					<a href="#link-advert" class="advert__link" data-id='{{ $i->relAdvert->id }}'>
						<div class="advert__image-block {{ ($i->relAdvert->checkView() ? 'normal_blur' : null ) }}" 
								style="background:#eee url('{{ $i->relAdvert->photo }}') no-repeat center center; background-size: contain;">
							@if ($i->relAdvert->urgent || $i->relAdvert->hot_price)
								<div class="advert__urgent">
									@if ($i->relAdvert->urgent)
										<img src="/front/img/icons/urgent.png"/>
									@endif
									@if ($i->relAdvert->hot_price)
										<div class="ad_vip_block_text">{{TransWord::getArabic('Hot Deal',false)}}</div>
									@endif
									<div class="advert__urgent__trangle"> </div>
								</div>
							@endif
							
							
							
						</div>
						<div class="advert__text-block">
							<h3 class="advert__title">{{$->relAdvert->title}}</h3>
							<p>
								@if (empty($hide_sum))
									@if ($i->relAdvert->spec_price_name != 0)
										{{TransWord::getArabic('AED')}} <strong>{{$i->relAdvert->spec_price_name}}</strong>
									@elseif ($i->relAdvert->to_be_discuss = 1)
										{{TransWord::getArabic('AED')}} <strong>{{$i->relAdvert->spec_price_name}}</strong>
									@endif
								@endif
								
								@if ($i->relAdvert->relOneCat->cat1_id == 3 &&  $i->relAdvert->relOneCat->cat2_id == 33)
									<?php $cat_sadasd = SysAdvertCat::find($i->relAdvert->relOneCat->cat3_id); ?>
									@if ($cat_sadasd)
										{{TransWord::getArabic($cat_sadasd->name,false)}}
									@endif
								@endif
							</p>
							
						</div>
					</a>
				</div>
			@endforeach
		@else 
			<p>{{TransWord::getArabic('Note have any results',false)}}</p>
		@endif 
		
	</div>
	
@endif 