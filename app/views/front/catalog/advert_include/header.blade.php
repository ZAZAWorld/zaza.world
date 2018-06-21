<div class="ad_head_buttons tabs">
	<a href="#photo" class="ad_head_buttons__b ad_b_photo tab-link current" data-tab="tab-1">  </a> 
	@if ($advert->youtube)
		<a href="#video" class="ad_head_buttons__b ad_b_video tab-link" data-tab="tab-2"> </a>	
	@endif			
	@if (abs($advert->gps_lat) > 0 && abs($advert->gps_lan))
    <script>
        (function(){
            window.dynamicLocations = [{gps_lat: {{ $advert->gps_lat }}, gps_lan: {{ $advert->gps_lan }} }];
        })();
    </script>
    <a href="#map"  class="ad_head_buttons__b ad_b_map tab-link" data-tab="tab-3" onclick="Map.initMap()" data-tab="tab-google-map-box">{{TransWord::getArabic('View map')}}</a>
	@endif
	<!--<span class="ad_head_buttons__b ad_b_location"> <img /> </span>-->
</div>

<div class="ad_head_r_buttons">
	
	<span class="ad_head_r_buttons__b"> <img src="/front/img/icons/ad_calendar.png" /> {{ $advert->created_at }} </span>
	@if ($advert->is_renew)
		<span class="ad_head_r_buttons__b"> 
			<img src="/front/images/refresh_ico_2.png" /><!--<i style='background: url(/front/images/refresh_ico.png) no-repeat; width: 18px; height: 18px; display:block'></i>-->
		</span>
	@endif
	<span class="ad_head_r_buttons__b js-likes {{ ($advert->checkLike() ? 'active' : null) }}" data-id="{{ $advert->id }}" > 
		@if ($advert->checkLike())
			<img src="/front/img/icons/ad_like_true.png" /> 
		@else 
			<img src="/front/img/icons/ad_like.png" /> 
		@endif
		<span class='count_likes_ad'>{{ $advert->count_likes }}</span>
	</span>
	<span class="ad_head_r_buttons__b"> <img src="/front/img/icons/ad_view.png" /> {{ $advert->vip_views }}</span>
	
</div>