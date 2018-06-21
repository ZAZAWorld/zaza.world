@extends('front.layout')
@section('js')
	@parent
	{{ HTML::script('front/js/autoresize.jquery.js') }}
	{{ HTML::script('front/js/cabinet.js') }}
	{{ HTML::script('front/js/blog.js') }}
@endsection

@section('content')

<div class="c-restourant__topstatus ">
	<div class="c-topstatus">
		<div class="l-container">
			<div class="l-grid-noGutter">
			   <div class="l-grid__col-4_lg-4_md-6_sm-7">
					<!-- {{-- Person name --}} -->
					<div class="c-description">
						<h1 class="c-description__name">
							{{ $personal->full_name }}
						</h1>
						<span style='color: #8da0a6;
							font-size: 13px;
							display: block;
							position: relative;
							top: -4px;'>
							{{TransWord::getArabic('your login is',false)}} {{ $user->email }}
						</span>
					</div>
				</div>
				<div class="l-grid__col-6_lg-5_md-9_sm-12">
					<div class="l-grid-noGutter-middle_sm-12">
						<!-- {{-- Tab links --}} -->
						 
							<div class="p_p_button_block">
								<button class="p_p_button active" data-tab='p_p_content_tab_1' style='height: 37px;'>
									{{TransWord::getArabic('Blog',false)}}
								</button>
								<button class="p_p_button" data-tab='p_p_content_tab_2' style='height: 37px;'>
									{{TransWord::getArabic('My shares')}}
								</button>
								<button class="p_p_button" data-tab='p_p_content_tab_3' style='height: 37px;'>
									{{TransWord::getArabic('My ads')}}
								</button>
								<button class="p_p_button" data-tab='p_p_content_tab_4' style='height: 37px;'>
									{{TransWord::getArabic('My likes')}}
								</button>
								<!--mobile about page-->
								<button class="p_p_button m-about" data-tab='p_p_content_tab_5' style='height: 37px;'>
									{{TransWord::getArabic('About me')}}
								</button>
							</div>
						 
					</div>
				</div>
					<div class="l-grid__col-2_lg-3_md-4_sm-5 m-pers-right" style="margin-top: 10px;">	
						 <div class="l-grid-noGutter-middle_sm-12 person_lgrid_middle">
						
						<div style='display: inline-block; margin-right: 15px;'>
							<span>
								<img src='/front/img/icons/price.png' style='height: 25px; margin-top: 6px;'>
							</span>
							<span 	class='js-refil-budjet person_budjet' data-tooltip="<a href='#refill'>{{TransWord::getArabic('Refill balance',false)}}</a>"
									style='display: inline-block;
											position: relative;
											top: -6px;
											margin-right: 2px;
											margin-left: 3px;
											text-decoration: underline;
											color: #283138;
											font-weight: 600;'>
								{{ ($user->relBudjet ? $user->relBudjet->total_aed : 0)  }} AED
							</span>
						</div>
						<!-- {{-- setting link --}} -->
						<div class="c-settings personal_cab_c-settings" style=' display: inline-block;   margin-right: 15px !important;'>
							<a href="/personal-cabinet/update" class="c-settings__link">
								<i class="c-settings__icon icon-54"></i>
							</a>
							
						</div>
						
						<div class='active personal_active' style='display: inline-block; margin-top: 5px;'>
							<span class='p_title__button__onlain__circle' style='background: #8bc34a !important; height: 22px  !important; width: 22px  !important;'>&nbsp;</span>
							<span style='display: inline-block; margin: 1px 0 0 0;'>{{ TransWord::getArabic('Online' )}}</span>
						</div>
						 </div>
					</div>
				 
			</div>
		</div>
	</div>

</div>

    <div class="p_personal">
        <div class="p_personal__left">
			<!---- Person info.-------->
            <div class="p_personal__left_block">
                @if( $personal->photo != '')
					<div class="p_p_logo js_logo" style="background:url('{{ $personal->photo }}') no-repeat center center; background-size:cover;">
					</div>
				@else 
					<div class="p_p_logo js_logo" style="background:url('/images/no_name.png') no-repeat center; background-size: cover;">
					</div>
				@endif
                <div class="p_p_location">
                    <img src="/front/img/icons/location_blue.png"> {{ $user->location }}
                </div>
            </div>
            <div class="p_personal__left_block">
                <div class="p_p_about">
                    <span class="p_p_about__title"> {{ TransWord::getArabic('About me') }} </span>
					{{ $personal->about }}
                </div>
            </div>
			
			<!---- Person contacts.-------->
            <div class="p_personal__left_block">
                <div class="p_p_phones">
                    <a href="tel:{{ $personal->phone }}"><img src='/front/img/icons/photo.png' /> {{ $personal->phone }}</a> <br/>
                    <a href="tel:{{ $personal->mobile }}"><img src='/front/img/icons/mobile.png' /> {{ $personal->mobile }}</a> <br/>
                    <a href="mailto:{{ $user->email }}"><img src='/front/images/c-sidebar__mail.png' width="12px" /> {{ $user->email }}</a>
                </div>
            </div>
			
			<!---- Social links.-------->
            <div class="p_personal__left_block">
				@include('front.personal-page.include.social_link')
            </div>
			
			<!---- Company likes.-------->
            <div class="p_personal__left_tab">
				@include('front.personal-page.include.company_likes')
            </div>
        </div>
        <div class="p_personal__content">
			<!---- Blog tabs.-------->
			<div id='p_p_content_tab_1' class='p_p_content_tab '>
				<!---- Blog interest. -------->
				<div class="p_p_interest_block">
					@include('front.personal-page.include.blog_interest')
				</div>
				
				<!---- Blog add article. -------->
				@include('front.personal-page.include.blog_add_article')
				
				<!---- Blog articles. -------->
				<div class="p_p_contents">
					@forelse ($blogs as $b)
						@if ($b->user_id == Auth::user()->id)
							@include('front.personal-page.include.blog_edit')
						@else 
							@include('front.personal-page.include.blog')
						@endif
					@empty
					<p>{{ TransWord::getArabic('Please') }} <a href="/personal-cabinet/update">{{ TransWord::getArabic('click here') }}</a> {{ TransWord::getArabic('to set your account') }} </p>
					@endforelse
				</div>
			</div>
			
			<!---- Blog shares tabs. -------->
			<div id='p_p_content_tab_2' class='p_p_content_tab '>
				<!---- Blog shares articles. -------->
				<div class="p_p_contents">
					@forelse ($shares as $b)
						@if ($b->user_id != Auth::user()->id)
							@include('front.personal-page.include.blog')
						@else
							@include('front.personal-page.include.blog_edit')
						@endif
					@empty
						<p>{{ TransWord::getArabic('You have no posts') }}</p>
					@endforelse
				</div>
			</div>
			
			<!---- My adds tabs. -------->
			<div id='p_p_content_tab_3' class='p_p_content_tab '>
				@include('front.personal-page.include.my_adds')
			</div>
			
			<!---- My likes tabs. -------->
			<div id='p_p_content_tab_4' class='p_p_content_tab '>
				@include('front.personal-page.include.my_likes')
			</div>
			<div id='p_p_content_tab_5' class='p_p_content_tab'>
				<!---- Person info.-------->
            <div class="p_personal__left_block m-100 m-top5">
                <div class="p_p_about">
                    <span class="p_p_about__title"> {{ TransWord::getArabic('About me') }} </span>
					{{ $personal->about }}
                </div>
            </div>
			<div class="p_personal__left_block">
                @if( $personal->photo != '')
					<div class="p_p_logo js_logo" style="background:url('{{ $personal->photo }}') no-repeat center center; background-size:100%;">
					</div>
				@else 
					<div class="p_p_logo js_logo" style="background:url('/images/no_name.png') no-repeat center; background-size: cover;">
					</div>
				@endif
                
            </div>
            
			
			<!---- Person contacts.-------->
            <div class="p_personal__left_block">
				<div class="p_p_location">
                    <img src="/front/img/icons/location_blue.png"> {{ $user->location }}
                </div>
                <div class="p_p_phones">
                    <a href="tel:{{ $personal->phone }}"><img src='/front/img/icons/photo.png' /> {{ $personal->phone }}</a> <br/>
                    <a href="tel:{{ $personal->mobile }}"><img src='/front/img/icons/mobile.png' /> {{ $personal->mobile }}</a> <br/>
                    <a href="mailto:{{ $user->email }}"><img src='/front/images/c-sidebar__mail.png' width="12px" /> {{ $user->email }}</a>
                </div>
            </div>
			
			<!---- Social links.-------->
            <div class="p_personal__left_block">
				@include('front.personal-page.include.social_link')
            </div>
			</div>
        </div>
    </div>
@stop
