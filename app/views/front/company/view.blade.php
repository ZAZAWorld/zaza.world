@extends('front.layout')
@section('js')
	@parent
	{{ HTML::script('front/js/company_simple.js') }}
@endsection

@section('content')
<!--map data block-->
<script>
    window.pageType = 'company';
    window.mapCatalogId = {{ $company->id }} ;
</script>
<div class="c-restourant__topstatus js-default-company-bar">
	<div class="c-topstatus">
		<div class="l-container">
			<div class="l-grid-noGutter-middle_sm-1 wrapper_header">
				<!---- Company name ------>
				<div class="" style="width:35%;">
					<div class="c-description">
						<h1 class="c-description__name">
							{{$company->title}}
						</h1>
					</div>
				</div>
				<div class="buttons_header_company_simple">
					 {{-- <!-- <div class="l-grid-noGutter-middle_sm-12"> --> --}}
						<!---- Tab links ------>
						<div class="categories">
							<button class="js-open-tab-simple-company aboutus active" data-tab="js-tab-simple-company-1">
							   {{TransWord::getArabic('About us')}}
							</button>
							<button class="js-open-tab-simple-company goodsservices " data-tab="js-tab-simple-company-2">
							   {{TransWord::getArabic('Goods')}} / {{TransWord::getArabic('Services')}}
							</button>
						</div>
						<!--------- company chat links ------------>
						@if (Auth::check())
						<div class="c-chat">
							<i class="icon-11 c-chat__icon"></i>
							<a href="#" class="c-chat__link js-open-chat" data-user-id="{{ $company->user_id }}">
								chat
							</a>
						</div>
						@else
							 <div class="c-chat hasTooltipCompany">
								 <i class="icon-11 c-chat__icon"></i>
								 <span class="c-chat__link">
									 {{TransWord::getArabic('chat',false)}}
								 </span>
							 </div>
							 <div class="hidden">
								 {{TransWord::getArabic('Please',false)}}
								 <a href='#login' class='js-login'>{{TransWord::getArabic('sign_in',false)}}</a> <br />
								 {{TransWord::getArabic('to use',false)}} <br />
								 {{TransWord::getArabic('this function',false)}}
							 </div>
						@endif
						<!--------- follow count ------------>
						<div class="c-follow">
							<div class="c-follow__count">
								<i class="c-follower__icon icon-19"></i>
								<span class="c-follow__number js-total-company-like">{{ $company->total_like }}</span>
							</div>
						</div>
						<!---- Follow link ------>
						<div class='company-follow {{ ($company->checkLike() ? "active" : null) }} js-like-company-set' data-id="{{ $company->id }}">
							<span class='company-follow__name'>
								@if ($company->checkLike())
									unfollow
								@else 
									follow
								@endif
							</span>
						</div>
						<!---- Onlain block ------>
						<div class="c-online">
							<div class="c-online__yes">
								@if ($user->checkUserOnlain())
									<div class="c-online__icon c-online__icon--online"></div>
									<div class="c-online__text">{{TransWord::getArabic('Online')}}</div>
								@else 
									<div class="c-online__icon c-online__icon--offline"></div>
									<div class="c-online__text">
										{{TransWord::getArabic('Last visit on')}} <br />
										{{ $user->last_visit_view }}
									</div>
								@endif
								
							</div>
						</div>
					 {{--</div>--}}
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
<script type="text/javascript">
   $(document).ready(function(){
       $('.hasTooltipCompany').each(function() { // Notice the .each() loop, discussed below
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
@stop
