@extends('front.layout')
@section('js')
	@parent
	{{ HTML::script('front/js/ad_filters.js') }}
	{{ HTML::script('front/js/jquery.ui.addresspicker.js') }}
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
<script>
    $(function() {
        var addresspicker = $( "#addresspicker" ).addresspicker({
            componentsFilter: 'locality:Dubai'
        });
    });
</script>
<!------- swith filter block ------>
<div class='front_filter_switch' id='front_filter_switch'>
	<div class="front_filter_switch_button">
		<i class="c-postmore__icon js-switch-filter"></i>
	</div>
</div>
<div class="catalogs" id="catalogs">
	<!--------- vip adds block ------>
	@if ($total_vip_ads->count() > 0)
		<div class="row vip_normal">
		<div class="ad_vip_wrapper" style="width:100%;float:left; margin-top:30px;overflow:visible;">
			<div class="row ad_vip" style="padding:0px 0px !important;margin: 0px 0px !important; width: 100% !important;">
				<div class="row_ad_vip_title">Featured</div>
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
		</div>
	@endif
	<div class="row ad_normal">
	    <!----------- simple adds block -------->
		<?php $ik=0; ?>
		@foreach ($all_ads as $key=>$ad)
			<?php $ik++;?>
			@include('front.ad.ad_template.view')
			@if($ik%32==0)
					<div class="vip_ads_in_row">
						@if ($total_vip_ads->count() > 0)
							<div class="ad_vip_wrapper" style="width:100%;float:left; margin-top:30px;overflow:visible;">
								<div class="row ad_vip" style="padding:0px 0px !important;margin: 0px 0px !important; width: 100% !important;">
									<div class="row_ad_vip_title">Featured</div>
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
			@endif
		@endforeach
    </div>
</div>
<div class="pagination">
	{{ $all_ads->appends(Input::except('page'))->links() }}
</div>
@stop
