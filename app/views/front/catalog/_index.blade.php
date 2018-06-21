@extends('front.layout')
@section('js')
	@parent
	{{ HTML::script('front/js/ad_filters.js') }}
@endsection

@section('content')
<!---- filter block ------>
@if (isset($filter_block))
	{{ $filter_block }}
@endif
<!--map data block-->
<script>
    window.pageType = 'advert';
    window.mapCatalogId = {{ $catalog->id }} ;
</script>
<!------- swith filter block ------>
<div class='front_filter_switch' id='front_filter_switch'>
	<div class="front_filter_switch_button">
		<i class="c-postmore__icon js-switch-filter"></i>
	</div>
</div>
<div class="catalogs" id="catalogs">
	<div class="row ad_normal">
	@if ($total_vip_ads->count() > 0)
		<!--------- vip adds block ------>
		<div class="ad_vip_wrapper" style="width:100%;float:left;margin-top:35px; margin-bottom: 15px; overflow:visible;padding:0px 0px;border-top: 3px solid #d41f26;">
			<div class="row_ad_vip_title">Featured</div>
			<div class="row ad_vip" style="padding:0px 0px !important; margin-top:0px; margin-bottom: 0px; width: 100% !important;">
				<div class="catalogs__vip">					
					<ul class="bxslider_ad">
						@foreach ($total_vip_ads as $ad)
							<li>
								@include('front.ad.ad_template.view_vips')
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	@endif
	</div>
	<!----------- simple adds block -------->
    <div class="row ad_normal">
		<?php $ik=0; ?>
		@foreach ($ads as $key=>$ad)
			<?php $ik++;?>
			@include('front.ad.ad_template.view')
			@if($ik%24==0)
				@if ($total_vip_ads->count() > 0)
				<div class="ad_vip_wrapper" style="width:100%;float:left;margin-top:35px; margin-bottom: 15px; overflow:visible;padding:0px 0px;border-top: 3px solid #d41f26;">
					<div class="row_ad_vip_title">Featured</div>
					<div class="row ad_vip" style="padding:0px 0px !important; margin-top:0px; margin-bottom: 0px; width: 100% !important;">
						<div class="catalogs__vip">
							<ul class="bxslider_ad">
								@foreach ($total_vip_ads as $ad)
									<li>
										@include('front.ad.ad_template.view_vips')
									</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
				@endif
			@endif
		@endforeach
    </div>
		<div class="pagination">
            {{ $ads->appends(Input::except('page'))->links() }}
		</div>
</div>


@stop
