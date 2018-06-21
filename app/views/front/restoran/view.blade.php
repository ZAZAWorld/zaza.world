@extends('front.layout')
@section('js')
	@parent
	{{ HTML::script('front/js/restoran.js') }}
@endsection

@section('content')
<!--map data block-->
<script>
    window.pageType = 'company';
    window.mapCatalogId = {{ $company->id }} ;
</script>

<section class="c-restourant js-default-company-bar">
   <div class="c-restourant__topstatus">
	   <div class="c-topstatus">
		   <div class="l-container">
			   <div class="l-grid-noGutter">
				   <div class="l-grid__col-4_lg-4_md-6_sm-6">
					   <div class="c-description">
							<!-------- Restoran title -------->
						   <h1 class="c-description__name">
							   {{ $company->title }}
						   </h1>
						   <!-------- Cost for 2 people -------->
						   @if (count($restoran->cousine) > 0)
								<?php $str = implode(' | ', $restoran->cousine);?>
								<h3 class="c-cost" style='color: #455a64'>
									{{ $str }}
								</h3>
							@endif
						   
						   
						   <!-------- Restoran categories -------->
						   <ul class="c-description__type">
								@foreach ($ar_cat as $c)
									<li class="c-description__type__item">{{TransWord::getArabic($ar_cat_names[$c],false)}}</li>
								@endforeach
						   </ul>
					   </div>
				   </div>
				   <div class="l-grid__col-1_lg-1_md-2_sm-3">
					   <div class="l-grid-noGutter-middle_sm-12">
							   <div class="c-rating">
									<!-------- Restoran total_score -------->
								   <div class="c-rating__total">
									   {{ $restoran->total_score }}
								   </div>
								   <!-------- Restoran score_service -------->
								   <div class="c-rating__stars">
									   {{ $restoran->getStarViews($restoran->score_service) }}
									   <div class="c-rating__votes">{{ $restoran->count_score }} {{TransWord::getArabic('votes')}}</div>
								   </div>
							   </div>
						</div>
					</div>
				   <div class="l-grid__col-7_lg-7_md-9_sm-12">
					   <div class="l-grid-noGutter-middle_sm-12">
						   <div class="l-grid__col-5_md-5_sm-5_xs-5" style="text-align:center">
								<!-------- Restoran social -------->
							   <div class="c-social">
									@if ($social->facebook)
									   <div class="c-social__item">
										   <a href="{{ $social->facebook }}" class="c-social__link c-social--fb"></a>
									   </div>
									@endif
									@if ($social->instagram)
									   <div class="c-social__item">
										   <a href="https://instagram.com/{{ $social->instagram }}" class="c-social__link c-social--in"></a>
									   </div>
									@endif
								   @if ($social->youtube)
									   <div class="c-social__item">
										   <a href="{{ $social->youtube }}" class="c-social__link c-social--yt"></a>
									   </div>
								   @endif
							   </div>
						   </div>
						   <div class="l-grid__col-7_md-7_sm-7_xs-7" style="text-align:right">
						   		<div class="top_status_info">
								
								<!-------- Restoran chat -------->
							   <div class="c-chat">
								   <i class="icon-11 c-chat__icon"></i>
								   <a href="#" class="c-chat__link js-open-chat" data-user-id="{{ $company->user_id }}">
									   {{TransWord::getArabic('chat')}}
								   </a>
							   </div>
							   <!-------- Restoran follow__count -------->
							   <div class="c-follow">
								   <div class="c-follow__count">
									   <i class='c-follower__icon icon-19 {{ ($company->checkLike() ? "active" : null) }} js-like-company-set' data-id="{{ $company->id }}"> </i>
									   <span class="c-follow__number js-total-company-like">{{ $company->total_like }}</span>
								   </div>
							   </div>
							   <!-------- Restoran follow -------->
							   
								@if (Auth::check() && Auth::user()->id != $company->user_id)
									<div class='company-follow {{ ($company->checkLike() ? "active" : null) }} js-like-company-set' data-id="{{ $company->id }}">
										<i class="c-button__icon follow_icon icon-21"></i>
										<span class='company-follow__name'>
											@if ($company->checkLike())
												{{TransWord::getArabic('unfollow',false)}}
											@else 
												{{TransWord::getArabic('follow',false)}}
											@endif
										</span>
									</div>
								@endif
							   <!-------- Restoran online -------->
								<div class="c-online restoran_online">
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
								</div>
						   </div>
							
					   </div>
				   </div>
			   </div>
		   </div>
	   </div>
   </div>
   <div class="c-restourant__photonav">
	   <div class="l-container">
		   <div class="l-grid-noGutter-middle_sm-1">
			   <div class="l-grid__col-7_sm-12">
					<!-------- Restoran photo_galerea tab -------->
					<div class='restoran_slide_tab open' id='restoran_slide_tab_main'>
					   <div class="c-slider">
						   <div class="rest-slider">
								@forelse ($photo_galerea as $i)
									<div style='position:relative'>
									   <a href="{{ $i->path }}" data-lightbox="photo_galerea"><img src="/front/popup/size-up.png" class="popup_company_img_full" /></a>
									   <div class="c-slider__item" style="background:#eee url('{{ $i->path }}') no-repeat center; background-size: cover;"> </div>
								   </div>
								@empty
									<div>
									   <div class="c-slider__item" style="background:#eee url('/images/no_name.png') no-repeat center; background-size: cover;"></div>
								   </div>
								@endforelse
								@foreach ($ar_youtube as $i) 
									<div>
										<div class="c-slider__item" >
											<iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $i->path }}?showinfo=0&enablejsapi=1&origin=https://zaza.ae:8350" frameborder="0" allowfullscreen></iframe>
										</div>
								   </div>
								@endforeach
						   </div>
					   </div>
					</div>
					<!-------- Restoran photo_menu tab -------->
					<div class='restoran_slide_tab' id='restoran_slide_tab_menu'>
						<div class='restoran_slide_tab_close js-restoran_slide_tab-close'>✖</div>
						<div class="c-slider">
						   <div class="rest-menu-slider">
								@forelse ($photo_menu as $i)
									<div style='position:relative;'>
									   <a href="{{ $i->path }}" data-lightbox="menu_galerea"><img src="/front/popup/size-up.png" class='popup_company_img_full'></a>
									   <div class="c-slider__item" style="background:#eee url('{{ $i->path }}') no-repeat center; background-size: contain;"></div>
								   </div>
								@empty
									<div>
									   <div class="c-slider__item" style="background: url('/images/no_name.png') no-repeat center; background-size: cover;"></div>
									</div>
								@endforelse
							</div>
						</div>
					</div>
					<!-------- Restoran photo_melas tab -------->
					<div class='restoran_slide_tab' id='restoran_slide_tab_meal'>
						<div class='restoran_slide_tab_close js-restoran_slide_tab-close'>✖</div>
						<div class='restoran_meal_tab_list'>
							@forelse ($photo_melas as $i)
								<div class='restoran_meal_tab_item' style='position:relative;'>
									<div class='restoran_meal_tab_img_block'>
										<img  class='restoran_meal_tab_img' src='{{ $i->path }}' />
									</div>
									<div class='restoran_meal_tab_text_block'>
										<div class='restoran_meal_tab_title'>{{ $i->title }}</div>
										<div class='restoran_meal_tab_note'>{{ $i->note }}</div>
									</div>
							   </div>
							@empty
								
							@endforelse
						</div>
					</div>
					<!-------- Restoran photo_guests tab -------->
					<div class='restoran_slide_tab' id='restoran_slide_tab_guest'>
						<div class='restoran_slide_tab_close js-restoran_slide_tab-close'>✖</div>
						<div class="c-slider">
						   <div class="rest-menu-slider">
								@forelse ($photo_guests as $i)
									<div style='position:relative;'> 
									   <a href="{{ $i->path }}" data-lightbox="guests_galerea"><img src="/front/popup/size-up.png" class='popup_company_img_full'></a>
									   <div class="c-slider__item" style="background: url('{{ $i->path }}') no-repeat center; background-size: cover;"></div>
								   </div>
								@empty
									<div>
									   <div class="c-slider__item" style="background: url('/images/no_name.png') no-repeat center; background-size: cover;"></div>
								   </div>
								@endforelse
						   </div>
					   </div>
					</div>
					<!-------- Restoran photo_team tab -------->
					<div class='restoran_slide_tab' id='restoran_slide_tab_team'>
						<div class='restoran_slide_tab_close js-restoran_slide_tab-close'>✖</div>
						<div class="c-slider">
						   <div class="rest-menu-slider">
								@forelse ($photo_team as $i)
									<div style='position:relative;'>
									   <a href="{{ $i->path }}" data-lightbox="team_galerea"><img src="/front/popup/size-up.png" class='popup_company_img_full'></a>
									   <div class="c-slider__item" style="background:#eee url('{{ $i->path }}') no-repeat center; background-size: contain;"></div>
								   </div>
								@empty
									<div>
									   <div class="c-slider__item" style="background: url('/images/no_name.png') no-repeat center; background-size: cover;"></div>
								   </div>
								@endforelse
						   </div>
					   </div>
					</div>
			   </div>
			   <div class="l-grid__col-5_sm-12">
					<!-------- Restoran select tab links -------->
				   <div class="c-menu">
					   <div class="l-grid-noGutter-middle_sm-1">
							<!-------- Select tab photo_menu link -------->
						   <div class="l-grid__col-6_sm-3_xs-3">
								@if (count($photo_menu) > 0)
									<?php $f_img = $photo_menu->first(); ?>
									<div class="c-menu__item js-select-restoran-tab" data-tab-id='restoran_slide_tab_menu' style="background: url('{{ $f_img->path }}') no-repeat; background-position: center; background-size: cover;">
								@else 
									<div class="c-menu__item js-select-restoran-tab" data-tab-id='restoran_slide_tab_menu' style="background: url('/images/no_name.png') no-repeat; background-position: center; background-size: cover;">
								@endif
								   <div class="c-menu__text">
									   <a href="#menu" class="c-menu__link " data-toggle="tab">{{TransWord::getArabic('Menu')}}</a>
								   </div>
								   <span class="c-menu__bg"></span>
							   </div>
						   </div>
						   <!-------- Select tab photo_melas link -------->
						   <div class="l-grid__col-6_sm-3_xs-3">
								@if (count($photo_melas) > 0)
									<?php $f_img = $photo_melas->first(); ?>
									<div class="c-menu__item js-select-restoran-tab" data-tab-id='restoran_slide_tab_meal' style="background: url('{{ $f_img->path }}') no-repeat; background-position: center; background-size: cover;">
								@else 
									<div class="c-menu__item js-select-restoran-tab"  data-tab-id='restoran_slide_tab_meal' style="background: url('/images/no_name.png') no-repeat; background-position: center; background-size: cover;">
								@endif
								   <div class="c-menu__text">
									   <a href="#meals" class="c-menu__link " data-toggle="tab" >{{TransWord::getArabic('Meals')}}</a>
								   </div>
								   <span class="c-menu__bg"></span>
							   </div>
						   </div>
						    <!-------- Select tab photo_guests link -------->
						   <div class="l-grid__col-6_sm-3_xs-3">
								@if (count($photo_guests) > 0)
									<?php $f_img = $photo_guests->first(); ?>
									<div class="c-menu__item js-select-restoran-tab" data-tab-id='restoran_slide_tab_guest' style="background: url('{{ $f_img->path }}') no-repeat; background-position: center;background-size: cover;">
								@else 
									<div class="c-menu__item js-select-restoran-tab"  data-tab-id='restoran_slide_tab_guest' style="background: url('/images/no_name.png') no-repeat; background-position: center; background-size: cover;">
								@endif
								   <div class="c-menu__text">
									   <a href="#guests" class="c-menu__link " data-toggle="tab" >{{TransWord::getArabic('Our guests')}}</a>
								   </div>
								   <span class="c-menu__bg"></span>
							   </div>
						   </div>
						    <!-------- Select tab photo_team link -------->
						   <div class="l-grid__col-6_sm-3_xs-3">
							   @if (count($photo_team) > 0)
									<?php $f_img = $photo_team->first(); ?>
									<div class="c-menu__item js-select-restoran-tab" data-tab-id='restoran_slide_tab_team' style="background: url('{{ $f_img->path }}') no-repeat; background-position: center;background-size: cover;">
								@else 
									<div class="c-menu__item js-select-restoran-tab"  data-tab-id='restoran_slide_tab_team' style="background: url('/images/no_name.png') no-repeat; background-position: center; background-size: cover;">
								@endif
								   <div class="c-menu__text">
									   <a href="#team" class="c-menu__link " data-toggle="tab" >{{TransWord::getArabic('Our team')}}</a>
								   </div>
								   <span class="c-menu__bg"></span>
							   </div>
						   </div>
					   </div>
				   </div>
			   </div>
		   </div>
	   </div>
   </div>
   <div class="c-restourant__downstatus">
	   <div class="contacts-container">
		   <div class="l-grid-noGutter-middle_sm-1">
			   <div class="l-grid__col-6_lg-6_md-12_sm-8">
					<!-------- Restoran contacts -------->
				   <div class="c-contacts-wrap js-contacts">
					   <div class="c-contacts">
							<?php $company_locations =  $company->location_ar;  $company_phones = $company->phone_ar;?>
							@for ($i = 0; $i < count($company_locations); $i++)
							   <div class="c-contacts__item">
									<!-------- Restoran phone -------->
								   <div class="c-contacts__phone">
									   <i class="c-contacts__icon icon-22"></i>
									   <div class="c-contacts__number">{{ (isset($company_phones[$i]) ? $company_phones[$i] : null) }}</div>
								   </div>
								   <!-------- Restoran location -------->
								   <div class="c-contacts__city">
									   <i class="c-contacts__icon icon-25"></i>
									   <div class="c-contacts__address">{{ (isset($company_locations[$i]) ? TransWord::getArabic($company_locations[$i],false) : null) }}</div>
								   </div>
							   </div>
						   @endfor
					   </div>
					   <a href="#" class="c-contacts__showall js-showall"></a>
				   </div>

			   </div>
			   <div class="l-grid__col-3_md-6_sm-4_xs-4">
					<!-------- Restoran view map link -------->
					@if ($company->gps_lan && $company->gps_lat)
                    <script>
                       (function(){
                           window.dynamicLocations = [{gps_lat: {{ $company->gps_lat }}, gps_lan: {{ $company->gps_lan }} }];
                       })();
					</script> 
                   <div class="c-onmap">
                       <a href="#map" onclick="$('.js-open-maps').click();" class="c-button c-button--redborder js-restoran_map_dialog-toggle">
                       <i class="c-button__icon c-onmap__icon"></i>
							   <span class="c-button__text ">{{TransWord::getArabic('View map')}}</span>
						   </a>
					   </div>
				   @endif
			   </div>
			   <div class="l-grid__col-3_md-6_sm-6_xs-6">
					<!-------- Restoran visitors_today block -------->
				   <div class="c-todayvisitors">
					   <div class="c-todayvisitors__text">
						   {{ TransWord::getArabic('Visitors for today') }} -
					   </div>
					   <i class="c-todayvisitors__icon icon-19"></i>
					   <div class="c-todayvisitors__count">{{ $company->visitors_today }}</div>
				   </div>
			   </div>
		   </div>
	   </div>
   </div>
   <div class="c-restourant__content">
			<div class="p_v_c_main">
					<!-------- Restoran blog block -------->
					@if (Auth::check() && Auth::user()->id != $company->user_id)
					   <div class="rest_main__left">
						   @include('front.restoran.include.blog_view')
					   </div>
					@else
						<div class="rest_main__left"></div>
				   @endif
				   <div class="rest_main__right">
					   <div class="c-sidebar">
							<!-------- Restoran cost_for_2 block -------->
						   <div class="c-sidebar__cost">
							   <h3 class="c-cost">{{TransWord::getArabic('Cost for 2 people:',false)}} <span class="c-cost__price">{{TransWord::getArabic('AED')}} {{ $restoran->cost_for_2 }}</span></h3>
						   </div>
						   <!-------- Restoran timetable block -------->
						   <div class="c-sidebar__days">
							   <div class="c-days">
									@foreach ($restoran->timetable as $k=>$t)
										<div class="c-days__item">
										   <div class="c-days__day">{{TransWord::getArabic($t['name'],false)}}</div>
										   <div class="c-days__time">
												{{ TransWord::getArabic($t['value_1'],false).'-'.TransWord::getArabic($t['value_2'],false) }}
											</div>
									   </div>
									@endforeach
								</div>
						   </div>
						    <!-------- Restoran rating block -------->
						    
						   <div class="c-sidebar__rating">
							   <div class="c-rating">
								   <div class="c-rating--food">
									   <div class="c-rating__label">{{TransWord::getArabic('Food',false)}}</div>
									   <div class="c-rating__count">{{ $restoran->score_food }}</div>
									   <div class="c-rating__stars">
										   {{ $restoran->getStarViews($restoran->score_food) }}
									   </div>
								   </div>
								   <div class="c-rating--service">
									   <div class="c-rating__label">{{TransWord::getArabic('Service',false)}}</div>
									   <div class="c-rating__count">{{ $restoran->score_service }}</div>
									   <div class="c-rating__stars">
											{{ $restoran->getStarViews($restoran->score_service) }}
									   </div>
								   </div>
								   <div class="c-rating--city">
									   <div class="c-rating__label">{{TransWord::getArabic('Interior',false)}}</div>
									   <div class="c-rating__count">{{ $restoran->score_interior }}</div>
									   <div class="c-rating__stars">
										   {{ $restoran->getStarViews($restoran->score_interior) }}
									   </div>
								   </div>
							   </div>
						   </div>
						   
						   <!-------- Restoran options block -------->
						   <div class="c-sidebar__checklist">
							   <ul class="c-checklist">
									@foreach ($restoran->options as $id=>$r)
										<li class="c-checklist__item {{ ($r['check'] ? '_active' : null) }}">
										   <i class="c-png-icon c-png-icon-pointer c-icon--checkbox"></i>
										   <i class="c-png-icon {{ $r['icon'] }}"></i>
										   <div class="c-checklist__text">{{TransWord::getArabic($r['name'],false)}}</div>
									   </li>
									@endforeach
							   </ul>
						   </div>
						   <!-------- Restoran more_info block -------->
						   <div class="c-sidebar__about">
							   <div class="c-about">
								   <h3 class="c-about__header">
									   {{TransWord::getArabic('About us',false)}}
								   </h3>
								   <div class="c-about__body">
										{{ preg_replace('/(\r\n|\n|\r)/', '<br/>', $company->more_info) }}
								   </div>
							   </div>
						   </div>
						   <!-------- Restoran contacts block -------->
						   <div class="c-sidebar__contacts">
								<!-------- Restoran email -------->
							   <div class="c-sidebar__mail">
								   <a href="mailto:{{ $user->email }}" class="c-sidebar__mail__link">
									   <i class="c-png-icon c-icon--sidebar--mail"></i>
									   {{ $user->email }}
									</a>
							   </div>
							   <!-------- Restoran web_site -------->
							   <div class="c-sidebar__site">
									<a href="http://{{ $company->web_site }}" class="c-sidebar__mail__link">
									   <i class="c-png-icon c-icon--sidebar--site"></i>
										{{ $company->web_site }}
									</a>
							   </div>
						   </div>
						   <div class="c-sidebar__info">
							   <div class="c-info">
									<div class="c-info__since_mob">
									   {{TransWord::getArabic('visitors today',false)}} - <div class="c-info__value c-info__value--green">{{ $company->visitors_today }}</div>
								   </div>
									<!-------- Restoran total_views -------->
								   <div class="c-info__since">
									   {{TransWord::getArabic('visitors total',false)}} - <div class="c-info__value c-info__value--green">{{ $company->total_views }}</div>
								   </div>
								   <!-------- Restoran created_at -------->
								   <div class="c-info__since">
									   {{TransWord::getArabic('member since',false)}} <div class="c-info__value">{{ $company->created_at }}</div>
								   </div>
							   </div>
						   </div>
					   </div>
				   </div>
			    
			</div>
		
   </div>
</section>
<div class="m-right-bar_ico"></div>
<!-------- Company greating block -------->
@if ($company->is_greeting && !Session::has('mess_ad_success') && $errors->isEmpty() && !Session::has('error') && !Session::has('success'))
	<div class='js-greeting-block' style=' position: absolute; width: 100%; top: 0; height: 1600px; z-index: 9999999; display: none;'>
		<div style='position: fixed; right: 10%; width: 20%; min-width:200px; height: auto; bottom: 5%; text-align: center; background: black; padding: 20px; opacity: 0.7; color: #fff; border-radius: 15px;'>
			{{ $company->greeting }}
		</div>
	</div>
@endif

<!-------- Restoran map -------->
@include('front.restoran.include.map')

@stop
