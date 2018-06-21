<div class="advert"  data-id='{{ $ad->id  }}'>
	<div class="ad_like js-likes-form-catalog {{ ($ad->checkLike() ? 'active' : null) }}" data-id="{{ $ad->id }}"></div>
	<a href="#link-advert" class="advert__link" data-id='{{ $ad->id }}' data-ids='{{ implode(',', $all_ads_ids) }}'>
        <?php
        $files_count = AdvertFile::where('advert_id', $ad->id)->count();
        $files = AdvertFile::where('advert_id', $ad->id)->get();
        ?>
            @if($files_count > 1)
				<div class="advert__image-block {{ ($ad->checkView() ? 'normal_blur' : null ) }}">
					<div class="closed_slides_ads">
                        <?php $fc=0; ?>
						@forelse ($files as $f )
                            <?php $fc++;?>
								@if($fc === 1 || $fc === 2 || $fc === 3 || $fc === 4)
									<div class="slides_close_images" style="background-image:url('{{ $f->file }}');" >
									</div>
								@endif
						@empty
								<div class="slides_close_images" style="background-image:url('{{ $ad->photo }}');" >
								</div>
						@endforelse
					</div>
                </div>
				<div class="advert__count_pic_img_slides">
					<div class="advert__count_pic_num">
                        <?php
                        echo $files_count;
                        ?>
					</div>
					<img src="/front/img/photoparat.png" height="18px" width="18px"/>
				</div>
            @elseif ($files_count < 1 | $files_count == 1)
                <div class="advert__image-block {{ ($ad->checkView() ? 'normal_blur' : null ) }}">
						<div class="slides_close_images" style="background-image:url('{{ $ad->photo }}');">
						</div>
                </div>
				<div class="advert__count_pic_img_slides">
					<div class="advert__count_pic_num">
                        <?php
                        echo $files_count;
                        ?>
					</div>
					<img src="/front/img/photoparat.png" height="18px" width="18px"/>
				</div>
            @endif
			@if ($ad->urgent || $ad->hot_price)
				<div class="corner-ribbon top-left sticky red shadow">
					@if ($ad->urgent)
						{{TransWord::getArabic('Urgent',false)}}
					@endif
					@if ($ad->hot_price)
						{{TransWord::getArabic('Hot Deal',false)}}
					@endif
				</div>
			@endif
			@if($ad->user_type_id == 4)
				@if ($ad->urgent || $ad->hot_price)
					<div class='timer_block'>
						<div class='my_timer' data-date-end='{{ $ad->getTimeEndSale() }}' data-date-start='{{ $ad->getTimeStartSale() }}'>
				<span class='my_timer_block'>
					<span class='my_timer_el day'>9</span>
					<span class='my_timer_el day'>9</span>
				</span> :
							<span class='my_timer_block'>
					<span class='my_timer_el hour'>9</span>
					<span class='my_timer_el hour'>9</span>
				</span> :
							<span class='my_timer_block'>
					<span class='my_timer_el minute'>9</span>
					<span class='my_timer_el minute'>9</span>
				</span> :
							<span class='my_timer_block'>
					<span class='my_timer_el second'>9</span>
					<span class='my_timer_el second'>9</span>
				</span>
						</div>
					</div>
				@endif
			@endif
		<div class="advert__text-block <?php if ($ad->is_green) echo 'green'; else if ($ad->vip) echo 'red'; ?>">
			@if($ad->relOneCat->cat2_id != 17)
			    <h3 class="advert__title">{{$ad->title}}</h3>
			@elseif($ad->relOneCat->cat2_id == 17)
                <?php
                 $title_auto = substr($ad->title,0,-5).",".substr($ad->title,-5);
                ?>
				<h3 class="advert__title">{{ $title_auto }}</h3>
			@endif
			<p>
				@if (empty($hide_sum))
					@if ($ad->spec_price_name != 0)
						{{TransWord::getArabic('AED')}} <strong>{{$ad->spec_price_name}}</strong>
					@elseif ($ad->to_be_discuss != 1 && $ad->spec_price_name == 0)
						{{TransWord::getArabic('AED')}} <strong>{{$ad->spec_price_name}}</strong>
					@elseif ($ad->to_be_discuss == 1 && $ad->spec_price_name == 0)
						to be discussed
					@endif
				@endif

				@if ($ad->relOneCat->cat1_id == 3 &&  $ad->relOneCat->cat2_id == 33)
					<?php $cat_sadasd = SysAdvertCat::find($ad->relOneCat->cat3_id); ?>
					@if ($cat_sadasd)
						{{TransWord::getArabic($cat_sadasd->name,false)}}
					@endif
				@endif
			</p>
			<p class="advert__location" aria-valuemax="10">{{ mb_substr(ucfirst($ad->address), 0, 14, 'UTF-8').'..'  }}</p>
			@if ($ad->negotiable || $ad->exchange || $ad->free)
				<?php
					$ar_spec_price = array();
					if ($ad->negotiable)
						$ar_spec_price [] = '<i>'.TransWord::getArabic('Negotiable',false).'</i>';
					if ($ad->exchange)
						$ar_spec_price [] = '<i>'.TransWord::getArabic('Exchange',false).'</i>';
					if ($ad->free)
						$ar_spec_price [] = '<i>'.TransWord::getArabic('Free',false).'</i>';
				?>
				<div style='position: absolute;
							bottom: 3px;
							right: 10px; font-size:11px;'>
					{{ (implode(" | ", $ar_spec_price)) }}
				</div>
			@endif
		</div>
	</a>
</div>