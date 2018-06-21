@extends('front.layout')
@section('js')
	@parent
	{{ HTML::script('front/js/ad_filters.js') }}
@endsection

@section('content')
<!------------- filter block ---------------->
@if (isset($filter_block))
	{{ $filter_block }}
@endif
<!--map data block-->
<script>
    window.pageType = 'company';
    window.mapCatalogId = {{ $catalog->id }} ;
</script>
<!------------- swith filter block ---------------->
<div class='front_filter_switch' id='front_filter_switch'>
	<div class="front_filter_switch_button">
		<i class="c-postmore__icon js-switch-filter"></i>
	</div>
</div>

<div class="catalogs js-default-company-bar" id="catalogs">
	@if ($copms_vip->count() > 0)
	<!----------- vip company list ------------->
	<div class="ad_vip_wrapper" style="height:390px !important">
		<div class="row ad_vip_rest">
			<div class="catalogs__vip">
				<ul class="bxslider_restoran_list">				
					@foreach ($copms_vip as $comp)
						<div class="advert_restaurant">
				<a href="{{ action('CatalogCompanyController@getCompanyView', $comp->id) }}" class="ad_restoran__link">
					<div class="advert__image-block_restaurant" style="background:#eee url('{{ $comp->photo }}') no-repeat center center; background-size: auto;">
					</div>
					<div class="ad_restoran__text-block ">
						<h3 class="ad_restoran__title">{{TransWord::getArabic($comp->title)}}</h3>
						<p> {{TransWord::getArabic('Cost for')}} 2 {{TransWord::getArabic('people')}}: {{TransWord::getArabic('AED')}} {{ $comp->relRestoran->cost_for_2 }}</p>
						<ul class="ad_restoran__chars">
							@foreach ($comp->relRestoran->cousine as $c) 
								<li>{{TransWord::getArabic( $c )}}</li>
							@endforeach
						</ul>
						@if ($comp->location)
							<span class="ad_restoran__location">
								<img src="/front/img/icons/ad_location.png" />
								{{ $comp->location }}
							</span>
						@endif
						@if ($comp->relRestoran->total_score  > 0)
							<span class="ad_restoran__stars">
								{{ $comp->relRestoran->total_score }}
								@for ($i = 1; $i < 6; $i++) 
									@if ($i <= $comp->relRestoran->total_score)
										<span class="ad_restoran__star ad_restoran__star-full">☆</span>
									@elseif ($i > $comp->relRestoran->total_score && ($i - 1) < $comp->relRestoran->total_score)
										<span class="ad_restoran__star ad_restoran__star-half">☆</span>
									@else 
										<span class="ad_restoran__star ad_restoran__star-empty">☆</span>
									@endif
								@endfor
							</span>
						@endif
					</div>
				</a>
			</div>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	@endif
	<!------------- restoran list ---------------->
	<div class="row ad_normal">
        @foreach ($copms as $comp)
			@if (!$comp->relRestoran)
				<?php continue; ?>
			@endif	
			<div class="advert_restaurant">
				<a href="{{ action('CatalogCompanyController@getCompanyView', $comp->id) }}" class="ad_restoran__link">
					<div class="advert__image-block_restaurant" style="background:#eee url('{{ $comp->photo }}') no-repeat center center; background-size: auto;">
					</div>
					<div class="ad_restoran__text-block ">
						<h3 class="ad_restoran__title">{{TransWord::getArabic($comp->title)}}</h3>
						<p> {{TransWord::getArabic('Cost for')}} 2 {{TransWord::getArabic('people')}}: {{TransWord::getArabic('AED')}} {{ $comp->relRestoran->cost_for_2 }}</p>
						<ul class="ad_restoran__chars">
							@foreach ($comp->relRestoran->cousine as $c) 
								<li>{{TransWord::getArabic( $c )}}</li>
							@endforeach
						</ul>
						@if ($comp->location)
							<span class="ad_restoran__location">
								<img src="/front/img/icons/ad_location.png" />
								{{ $comp->location }}
							</span>
						@endif
						@if ($comp->relRestoran->total_score  > 0)
							<span class="ad_restoran__stars">
								{{ $comp->relRestoran->total_score }}
								@for ($i = 1; $i < 6; $i++) 
									@if ($i <= $comp->relRestoran->total_score)
										<span class="ad_restoran__star ad_restoran__star-full">☆</span>
									@elseif ($i > $comp->relRestoran->total_score && ($i - 1) < $comp->relRestoran->total_score)
										<span class="ad_restoran__star ad_restoran__star-half">☆</span>
									@else 
										<span class="ad_restoran__star ad_restoran__star-empty">☆</span>
									@endif
								@endfor
							</span>
						@endif
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
