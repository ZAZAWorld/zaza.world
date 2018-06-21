@extends('front.layout')
@section('content')

<div class="catalogs">
	<div class="ad_vip_wrapper">
		<div class="row ad_vip">
			
			<div class="catalogs__vip">
			 <ul class="bxslider_ad">
				@foreach ($copms_vip as $comp)
					<li>
						<div class="ad-vip-block ">
							<div class="ad_restoran">
								<div class="ad_restoran__image-block ">
									<img src="{{ $comp->photo }}" class="ad_restoran__image " />
								</div>
								<div class="ad_restoran__text-block red">
									<a href="{{ action('CatalogCompanyController@getCompanyView', $comp->id) }}" class="ad_restoran__link">
										<h3 class="ad_restoran__title">{{$comp->title}}</h3>
									</a>
									<p> {{TransWord::getArabic('Cost for')}} 2 {{TransWord::getArabic('people')}}: {{TransWord::getArabic('AED')}} 350</p>
									<ul class="ad_restoran__chars">
										<li>{{TransWord::getArabic('casual food')}}</li>
										<li>{{TransWord::getArabic('wine bar')}}</li>
									</ul>
									<span class="ad_restoran__location">
										<img src="/front/img/icons/ad_location.png" />
										{{TransWord::getArabic('Dubai')}}, {{TransWord::getArabic('Difc')}}
									</span>
									<span class="ad_restoran__stars">
										4.2
										<span class="ad_restoran__star ad_restoran__star-full">☆</span>
										<span class="ad_restoran__star ad_restoran__star-full">☆</span>
										<span class="ad_restoran__star ad_restoran__star-half">☆</span>
										<span class="ad_restoran__star ad_restoran__star-empty">☆</span>
										<span class="ad_restoran__star ad_restoran__star-empty">☆</span>
									</span>
								</div>
							</div>

						</div>
				   </li>
				@endforeach
			 </ul>
			</div>
		</div>
	</div>
	
	<div class="row ad_normal">
        @foreach ($copms as $comp)
			<div class="col-md-20 col-lg-12-5 ad-vip-block ">
				<div class="ad_restoran">
					<div class="ad_restoran__image-block ">
						<img src="{{ $comp->photo }}" class="ad_restoran__image " />
					</div>
					<div class="ad_restoran__text-block ">
						<a href="{{ action('CatalogCompanyController@getCompanyView', $comp->id) }}" class="ad_restoran__link">
							<h3 class="ad_restoran__title">{{$comp->title}}</h3>
						</a>
						<p> {{TransWord::getArabic('Cost for')}} 2 {{TransWord::getArabic('people')}}: {{TransWord::getArabic('AED')}} 350</p>
						<ul class="ad_restoran__chars">
							<li>{{TransWord::getArabic('casual food')}}</li>
							<li>{{TransWord::getArabic('wine bar')}}</li>
						</ul>
						<span class="ad_restoran__location">
							<img src="/front/img/icons/ad_location.png" />
							{{TransWord::getArabic('Dubai')}}, {{TransWord::getArabic('Difc')}}
						</span>
						<span class="ad_restoran__stars">
							4.2
							<span class="ad_restoran__star ad_restoran__star-full">☆</span>
							<span class="ad_restoran__star ad_restoran__star-full">☆</span>
							<span class="ad_restoran__star ad_restoran__star-half">☆</span>
							<span class="ad_restoran__star ad_restoran__star-empty">☆</span>
							<span class="ad_restoran__star ad_restoran__star-empty">☆</span>
						</span>
					</div>
				</div>
			</div>
        @endforeach
    </div>
</div>

@stop
