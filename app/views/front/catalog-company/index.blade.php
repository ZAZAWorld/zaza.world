@extends('front.layout')
@section('js')
	@parent
	{{ HTML::script('front/js/company_filter.js') }}
@endsection

@section('content')
<!----------- filter block ------------->
@if (isset($filter_block))
	{{ $filter_block }}
@endif
<!--map data block-->
<script>
    window.pageType = 'company';
    window.mapCatalogId = {{ $catalog->id }} ;
</script>
<!----------- switch block ------------->
<div class='front_filter_switch' id='front_filter_switch'>
	<div class="front_filter_switch_button">
		<i class="c-postmore__icon js-switch-filter"></i>
	</div>
</div>

<div class="catalogs js-default-company-bar" id="catalogs">
<?php

#@if ($copms_vip->count() > 0)
#	<!----------- vip company list ------------->
#
#	<div class="ad_vip_wrapper">
#		<div class="row ad_vip">
#			<div class="catalogs__vip">
#				<ul class="bxslider_ad">
#							<div class="advert">
#								<a href="{{ action('CatalogCompanyController@getCompanyView', $comp->id) }}" class="advert__link">
#									<div class="advert__image-block"
#											style="background:url('{{ $comp->photo }}') no-repeat center center; background-size: 100%;">
#										<div style='position: absolute;
#													top: 1px;
#													right: 5px;'>
#											<div style="color: #8dc24c;
#														font-size: 16px;
#														font-weight: 600;">
#												<img src='/front/img/icons/green_grafic.png' style="width: auto;
#																									height: 22px;
#																									position: relative;
#																									top: 5px;
#																									display: inline-block;
#																									margin-right: 5px;"/>{{ $comp->onlain_index }}
#											</div>
#										</div>
#									</div>
#									<div class="advert__text-block red">
#										<h3 class="advert__title">{{$comp->title}}</h3>
#										<p class="comp_activity">{{$comp->activity}}</p>
#									</div>
#								</a>
#							</div>
#						</li>
#					@endforeach
#				</ul>
#			</div>
#		</div>
#	</div>
#	@endif
#	-->
?>
	<!----------- simple company list ------------->
    <div class="row ad_normal">
        @foreach ($copms as $comp)
			<div class="advert" >
				<a href="{{ action('CatalogCompanyController@getCompanyView', $comp->id) }}" class="advert__link">
					<div class="advert__image-block" 
							style="background:url('{{ $comp->photo }}') no-repeat center center; background-size: 100%;">
						<div style='position: absolute;
									top: 1px;
									right: 5px;'>
							<div style="color: #8dc24c;
										font-size: 16px;
										font-weight: 600;">
								<img src='/front/img/icons/green_grafic.png' style="width: auto;
																					height: 22px;
																					position: relative;
																					top: 5px;
																					display: inline-block;
																					margin-right: 5px;"/>{{ $comp->onlain_index }}
							</div>
						</div>
					</div>
					<div class="advert__text-block red">
						<h3 class="advert__title">{{$comp->title}}</h3>
						<p class="comp_activity">{{$comp->activity}}</p>
					</div>
				</a>
			</div>
        @endforeach
			<div class="pagination">
				{{ $copms->appends(Input::except('page'))->links('paginator') }}
			</div>
    </div>
</div>

@stop
