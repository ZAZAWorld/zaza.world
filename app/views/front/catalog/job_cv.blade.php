<div class="ad-modal open">
	<div class='ad-modal_bg'></div>
    <!-- Prev or next ad link -->
    @include('front.catalog.advert_include.prev_next_link')
	<!-- Modal content 2-->
    <div class="ad-modal__content" id="tabs" >
        <span class="ad-modal__close">×</span>
		<!-- Advert headers -->
        <div class="ad-modal__header-cv">
			<div class="ad-modal__header">
				
				<div class="ad_head_r_buttons">
					<span class="ad_head_r_buttons__b"> <img src="/front/img/icons/ad_calendar.png" /> {{$advert->created_at}} </span>
					<span class="ad_head_r_buttons__b js-likes {{ ($advert->checkLike() ? 'active' : null) }}" data-id="{{ $advert->id }}" > <img src="/front/img/icons/ad_like.png" /> <span class='count_likes_ad'>{{ $advert->count_likes }}</span></span>
					<span class="ad_head_r_buttons__b"> <img src="/front/img/icons/ad_view.png" /> {{$advert->vip_views}}</span>
				</div> 
			</div>
		</div>
		<!-- Advert body -->
		<div class="ad-modal__jobcv">
			<!-- Advert detail chars -->
			<div class="ad-modal__jobcv-left">
				<table border="0">
					<tbody>
						<tr>
							<td width="170">{{ TransWord::getArabic('Full name') }}:</td>
							<td><strong>{{ $advert->title }}</strong></td>
						</tr>
						<tr style="height: 10px;">
						</tr>
						<tr>
							<?php $prop = $props[35]; ?>
							@if ($prop->prop_val)
								<td>{{ TransWord::getArabic('Targeted Role') }}:</td>
								<td>{{ $prop->prop_val }}</td>
							@endif
						</tr>
						<tr>
							<td>{{ TransWord::getArabic('Targeted Industry') }}:</td>
							<td>{{TransWord::getArabic($ar_cat[$cat->cat3_id],false)}}</td>
						</tr>
						
						<tr style="height: 10px;">
						</tr>
						<tr>
							<?php $prop = $props[37]; ?>
							@if ($prop->prop_val)
								<td>{{ TransWord::getArabic('Current/Last position') }}:</td>
								<td>{{ $prop->prop_val }}</td>
							@endif
						</tr>
						<tr>
							<?php $prop = $props[38]; ?>
							@if ($prop->prop_val)
								<td>{{ TransWord::getArabic('Experience of this role') }}:</td>
								<td>{{ $prop->prop_val }}</td>
							@endif
						</tr>
						<tr>
							<?php $prop = $props[39]; ?>
							@if ($prop->prop_val)
								<td>{{ TransWord::getArabic('Total experience') }}:</td>
								<td>{{ $prop->prop_val }}</td>
							@endif
						</tr>
						<tr>
							<?php $prop = $props[40]; ?>
							@if ($prop->prop_val)
								<td>{{ TransWord::getArabic('Experience in UAE') }}:</td>
								<td>{{ $prop->prop_val }}</td>
							@endif
						</tr>
						
						<tr style="height: 10px;">
						</tr>
						<tr>
							<?php $prop = $props[41]; ?>
							@if ($prop->prop_val)
								<td>{{ TransWord::getArabic('Country of Residence') }}:</td>
								<td>{{TransWord::getArabic($prop->prop_val,false)}}</td>
							@endif
						</tr>
						<tr>
							<?php $prop = $props[42]; ?>
							@if ($prop->prop_val)
								<td>{{ TransWord::getArabic('Nationality') }}:</td>
								<td>{{TransWord::getArabic($prop->prop_val,false)}}</td>
							@endif
						</tr>
						 
						<!--<tr>
							 
							 
								<td>{{ TransWord::getArabic('Gender') }}:</td>
								<td>{{TransWord::getArabic($prop->prop_val,false)}}</td>
							 
						</tr>
						<tr>
							 
							 
								<td>{{ TransWord::getArabic('Visa type') }}:</td>
								<td>{{TransWord::getArabic($prop->prop_val,false)}}</td>
							 
						</tr>
						 -->
						<tr style="height: 10px;">
						</tr>
						<tr>
							<td width="170">{{ TransWord::getArabic('Additional information') }}:</td>
							<td>{{ $about->note }}</td>
						</tr>
						
					</tbody>
				</table>
			</div>
			<!-- Advert main chars -->
			<div class="ad-modal__jobcv-right">
				<div class="ad-modal__jobcv-avatar" style="background: url({{ $advert->photo }})no-repeat center center; background-size: cover;"></div>
				</br>
				<p align="center"><strong>{{ $advert->title }}</strong></p>
				<div class="ad-modal__jobcv-inform">
					<div class="ad-modal__jobcv-contact">
						<i class="icon-jobcv-contact"></i>
						<div class="icon-jobcv-contacts__number">{{ $advert->order_number }}</div>
					</div>
					<div class="ad-modal__jobcv-mail">
						<img src="/images/mail-note.png" class="icon-jobcv-mail"/>
						<div class="icon-jobcv-mail__contact">{{ $owner->email }}</div>
					</div>
				</div>
				<?php $i = 0; ?>
				@foreach ($files as $f)
					@if ($f->prop_val)
						<div class="ad-modal_jobcv-download">
							<a href="{{ $f->prop_val }}" target='_blank'>
								<img src="/images/download_icon_card.png"/>
								<span>{{ TransWord::getArabic('Download CV (PDF | DOC)') }}</span>
							</a>
						</div> <br />
					@endif
				@endforeach
			</div>
			<div style="height:300px;"></div>
		</div>
	</div>
</div>
	

<script type="text/javascript">
	jQuery( document ).ready( function( $ ) {
		$('.flexslider').flexslider();
	});
	$(document).ready(function(){
		$('div.tabs a').click(function(){
			var tab_id = $(this).attr('data-tab');
			$('div.tabs a').removeClass('current');
			$('.tab-content').removeClass('current');
			$(this).addClass('current');
			$("#"+tab_id).addClass('current');
		});

        $('.hasTooltip').each(function() { // Notice the .each() loop, discussed below
            $(this).qtip({
                content: {
                    text: $(this).next('div') // Use the "div" element next to this for the content
                },
                hide: {
                    fixed: true,
                    delay: 300
                },
                style: {
                    classes: 'qtip-spec '+ 'qtip-rounded' ,
                    tip: {
                        corner: true
                    }
                },
                position: {
                    corner: {
                        target: "rightMiddle",
                        tooltip: "leftMiddle"
                    }
                }
            });
        });

	});
</script>
