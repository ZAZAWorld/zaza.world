@extends('front.layout')
@section('js')
	@parent
	{{ HTML::script('front/js/company_simple.js') }}
@endsection

@section('content')
<div class="c-restourant__topstatus js-default-company-bar">
	<div class="c-topstatus">
		<div class="l-container">
			<div class="l-grid-noGutter-middle_sm-1">
				<div class="l-grid__col-4_lg-4_md-12_sm-12">
					<div class="c-description">
					<!---- Company name ------>
						<h1 class="c-description__name">
							{{$company->title}}
						</h1>
					</div>
				</div> 
				<div class="buttons_header_company_simple">
					<div class="l-grid-noGutter-middle_sm-12">
						<!---- Tab links ------>
						<div class="categories">
							<button class="js-open-tab-simple-company aboutus active" data-tab="js-tab-simple-company-1">
							   {{TransWord::getArabic('About us')}}
							</button>
							<button class="js-open-tab-simple-company goodsservices " data-tab="js-tab-simple-company-2">
							   {{TransWord::getArabic('Goods')}} / {{TransWord::getArabic('Services')}}
							</button>
						</div>
						<div class="buttons_company_header">
							<!---- Upgrade link ------>
							<a href="#">
								<div class="upgrade">
									{{TransWord::getArabic('UPGRADE')}}<br />{{TransWord::getArabic('your plan')}}
								</div>
							</a>
							<!---- To top link ------>
							<div class="c-top">
								<a href="#" class="c-top__link">
									<img src="/front/img/icons/top.png" />
								</a>
							</div>
							<!---- Balance link ------>
							<div class="c-ballance">
								<i class="c-ballance__icon icon-38"></i>
								<span class="c-ballance__text js-refil-budjet" data-tooltip="<a href='#refill'>{{TransWord::getArabic('Refill balance')}}</a>">{{TransWord::getArabic('AED')}} {{ Budjet::getBalans($user) }}</span>
							</div>
							<!---- Settings link ------>
							<div class="c-settings">
								<a href="/company-simple/update" class="c-settings__link">
									<i class="c-settings__icon icon-54"></i>
								</a>
							</div>
						</div>
						<!---- Onlain block ------>
						<div class="c-online">
							<div class="c-online__yes">
								<div class="c-online__icon c-online__icon--online"></div>
								<div class="c-online__text">{{TransWord::getArabic('online')}}</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>       
</div>

<div class='js-tab-simple-company js-tab-simple-company-1'>
	<div class="p_company">
		<!---- Company main settings ------>
		<div class="p_company__left">
			@include('front.company.include.main_setting')
		</div>
		<!---- Company detail settings ------>
		<div class="p_company__right">
			@include('front.company.include.detail_setting')
		</div>
	</div>
</div>

<div class='js-tab-simple-company js-tab-simple-company-2'>
	@include('front.company.include.my_add')
</div>

@stop
