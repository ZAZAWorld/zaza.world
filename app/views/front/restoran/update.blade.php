@extends('front.layout')
@section('js')
	@parent
	{{ HTML::script('front/js/restoran.js') }}
@endsection
@section('content')

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
						   {{--<!-------- Restoran chat -------->
						   <div class="l-grid__col-1_md-3_sm-12_xs-12">
							   <div class="c-chat">
								   <i class="icon-11 c-chat__icon"></i>
								   <a href="#" class="c-chat__link">
									   {{TransWord::getArabic('chat')}}
								   </a>
							   </div>
						   </div>
						   --}}
						   <div class="l-grid__col-7_md-7_sm-7_xs-7" style="text-align:right">
								<!-------- Restoran follow__number -------->
							   <div class="c-follow">
								   <div class="c-follow__count">
									   <i class="c-follower__icon icon-19"></i>
									   <span class="c-follow__number">{{ $company->total_like }}</span>
								   </div>
							   </div>
							   <!-------- Restoran to top link ------>
							   <div class="c-top">
									@if ($company->is_top)
										<a href="#asdas" class="c-top__link ">
											<span class="icon-10 watchs__spec" style="font-size: 20px; vertical-align: middle;"> </span> {{ $company->count_top }} <div><small>{{TransWord::getArabic('views left',false)}}</small></div>
										</a>
									@else 
										<a href="#asdas" class="c-top__link js_call_to_top">
											<i class="c-top__icon icon-122"></i>
										</a>
									@endif
							   </div>
							   <!-------- Restoran ballance link -------->
							   <div class="c-ballance">
								   <a href="#" class="c-ballance__link">
									   <i class="c-ballance__icon icon-38"></i>
									   
									   <span class="c-ballance__text">{{TransWord::getArabic('AED')}} {{ Budjet::getBalans($user) }}</span>
								   </a>
							   </div>
							   <!-------- Restoran settings link -------->
							   <div class="c-settings">
								   <a href="#" class="c-settings__link">
									   <i class="c-settings__icon icon-54 js-open-main-setting"></i>
								   </a>
							   </div>
							   <!-------- Restoran online link -------->
							   <div class="c-online restoran_online">
								   <div class="c-online__yes">
									   <div class="c-online__icon c-online__icon--online"></div>
									   <div class="c-online__text">{{TransWord::getArabic('Online')}}</div>
								   </div>
							   </div>
						   </div>
						    
					   </div>
				   </div>
			   </div>
		   </div>
	   </div>
	 </div>  
	   
			<!-------- Restoran main_settings block -------->
			@include('front.restoran.include.main_settings')
			<!-------- Restoran photo_settings block -------->
			@include('front.restoran.include.photo_settings')
	    
   
   <div class="c-restourant__photonav">
	   <div class="l-container">
		   <div class="l-grid-noGutter-middle_sm-1">
				<!-------- Restoran photo_galerea block -------->
			   <div class="l-grid__col-7_sm-12">
				   <div class="c-slider">
					   <div class="rest-slider">
							@forelse ($photo_galerea as $i)
								<div>
								   <div class="c-slider__item" style="background: url('{{ $i->path }}') no-repeat center; background-size: cover;"></div>
							   </div>
							@empty
								<div>
								   <div class="c-slider__item" style="background: url('/images/no_name.png') no-repeat center; background-size: cover;"></div>
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
					   <div class="c-slider__admin">
						   <a href="#" class="c-edit js-open-photo-setting c-edit--round"><i class="c-edit__icon icon-57"></i></a>
					   </div>
				   </div>
			   </div>
			   <div class="l-grid__col-5_sm-12">
					<!-------- Restoran select tab links -------->
				   <div class="c-menu">
					   <div class="l-grid-noGutter-middle_sm-1">
							<!-------- Select photo setting link -------->
						    <div class="l-grid__col-6_sm-3_xs-3">
								@if (count($photo_menu) > 0)
									<?php $f_img = $photo_menu->first(); ?>
									<div class="c-menu__item" style="background: url('{{ $f_img->path }}') no-repeat; background-position: center; background-size: cover;">
								@else 
									<div class="c-menu__item" style="background: url('/images/no_name.png') no-repeat; background-position: center; background-size: cover;">
								@endif
									<div class="c-menu__text">
									   <a href="#menu" class="c-menu__link js-open-photo-setting" data-toggle="tab">{{TransWord::getArabic('Menu')}}</a>
								   </div>
								   <span class="c-menu__bg"></span>
							   </div>
						   </div>
						   <!-------- Select photo setting link -------->
						   <div class="l-grid__col-6_sm-3_xs-3">
								@if (count($photo_melas) > 0)
									<?php $f_img = $photo_melas->first(); ?>
									<div class="c-menu__item" style="background: url('{{ $f_img->path }}') no-repeat; background-position: center; background-size: cover;">
								@else 
									<div class="c-menu__item" style="background: url('/images/no_name.png') no-repeat; background-position: center; background-size: cover;">
								@endif
								   <div class="c-menu__text">
									   <a href="#meals" class="c-menu__link js-open-photo-setting" data-toggle="tab">{{TransWord::getArabic('Meals')}}</a>
								   </div>
								   <span class="c-menu__bg"></span>
							   </div>
						   </div>
						   <!-------- Select photo setting link -------->
						   <div class="l-grid__col-6_sm-3_xs-3">
								@if (count($photo_guests) > 0)
									<?php $f_img = $photo_guests->first(); ?>
									<div class="c-menu__item" style="background: url('{{ $f_img->path }}') no-repeat; background-position: center; background-size: cover;">
								@else 
									<div class="c-menu__item" style="background: url('/images/no_name.png') no-repeat; background-position: center; background-size: cover;">
								@endif
								   <div class="c-menu__text">
									   <a href="#guests" class="c-menu__link js-open-photo-setting" data-toggle="tab">{{TransWord::getArabic('Our guests')}}</a>
								   </div>
								   <span class="c-menu__bg"></span>
							   </div>
						   </div>
						   <!-------- Select photo setting link -------->
						   <div class="l-grid__col-6_sm-3_xs-3">
							   @if (count($photo_team) > 0)
									<?php $f_img = $photo_team->first(); ?>
									<div class="c-menu__item js-select-restoran-tab" data-tab-id='restoran_slide_tab_team' style="background: url('{{ $f_img->path }}') no-repeat; background-position: center; background-size: cover;">
								@else 
									<div class="c-menu__item js-select-restoran-tab" data-tab-id='restoran_slide_tab_team' style="background: url('/images/no_name.png') no-repeat; background-position: center; background-size: cover;">
								@endif
								   <div class="c-menu__text">
									   <a href="#team" class="c-menu__link js-open-photo-setting" data-toggle="tab">{{TransWord::getArabic('Our team')}}</a>
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
			   <div class="l-grid__col-6_lg-6_md-12_sm-12">
					<!-------- Restoran contacts -------->
				   <div class="c-contacts-wrap js-contacts">
					   <div class="c-contacts">
							<?php $company_locations =  $company->location_ar;  $company_phones = $company->phone_ar;?>
							@for ($i = 0; $i < count($company_locations); $i++)
							    @if (!$company_locations[$i])
							        <?php continue; ?>
							    @endif
							   <div class="c-contacts__item">
									<!-------- Restoran phone -------->
								   <div class="c-contacts__phone">
									   <i class="c-contacts__icon icon-22"></i>
									   <div class="c-contacts__number">{{ (isset($company_phones[$i]) ? $company_phones[$i] : null) }}</div>
								   </div>
								   <!-------- Restoran location -------->
								   <div class="c-contacts__city">
									   <i class="c-contacts__icon icon-25"></i>
									   <div class="c-contacts__address">{{ (isset($company_locations[$i]) ? $company_locations[$i] : null) }}</div>
								   </div>
							   </div>
						   @endfor
					   </div>
					   <a href="#" class="c-contacts__showall js-showall"></a>
				   </div>

			   </div>
			   <div class="l-grid__col-3_md-6_sm-6_xs-6">
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
							   <span class="c-button__text">{{TransWord::getArabic('View map')}}</span>
						   </a>
					   </div>
				   @endif
			   </div>
			   <div class="l-grid__col-3_md-6_sm-6_xs-6">
					<!-------- Restoran visitors_today block -------->
				   <div class="c-todayvisitors">
					   <div class="c-todayvisitors__text">
						   {{TransWord::getArabic('Visitors for today')}} —
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
			   <div class="rest_main__left">
				   @include('front.restoran.include.blog')
			   </div>
			   <div class="rest_main__right">
				   <div class="c-sidebar">
						<!-------- Restoran cost_for_2 block -------->
					   <div class="c-sidebar__cost">
						   <h3 class="c-cost">{{TransWord::getArabic('Cost for 2 people:')}} <span class="c-cost__price">{{TransWord::getArabic('AED')}} {{ $restoran->cost_for_2 }}</span></h3>
					   </div>
					   <!-------- Restoran timetable block -------->
					   <div class="c-sidebar__days">
						   <div class="c-days">
								@foreach ($restoran->timetable as $k=>$t)
									<div class="c-days__item">
									   <div class="c-days__day">{{TransWord::getArabic($t['name'],false)}}</div>
									   <div class="c-days__time">
									   
									   <!--
											{{ Form::select('value_1', $ar_time_am, $t['value_1'], array('class'=>'js-timetable-value', 'data-id'=>$k, 'data-type'=>'1')) }}
											
											-->
											
											<select name='value_1' class='js-timetable-value'>
												<option >{{ TransWord::getArabic($t['value_1'], false) }}</option>
												@foreach ($ar_time_am as $k=>$v)
													@if (Input::has('value_1') && Input::get('value_1') == $k)
														<option value='{{ $k }}' selected>{{ TransWord::getArabic($v, false) }}</option>
													@else 
														<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
													@endif
												@endforeach
											</select>
											
											<select name='value_2' class='js-timetable-value'>
												<option >{{ TransWord::getArabic($t['value_2'], false) }}</option>
												@foreach ($ar_time_pm as $k=>$v)
													@if (Input::has('value_2') && Input::get('value_2') == $k)
														<option value='{{ $k }}' selected>{{ TransWord::getArabic($v, false) }}</option>
													@else 
														<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
													@endif
												@endforeach
											</select>
											
											<!--
											{{ Form::select('value_2', $ar_time_pm, $t['value_2'], array('class'=>'js-timetable-value', 'data-id'=>$k, 'data-type'=>'2')) }}
											
											<!-- <input type="text" data-name="{{ $t['name'] }}" value="{{ $t['value_1'] }}" class='js-input-restoran js-timetable-value' /> -->
										</div>
								   </div>
								@endforeach
							   

							</div>
							{{--<div class="c-sidebar__days__admin">
							   <a href="#" class="c-edit">
								   <i class="c-edit__icon icon-55"></i>
							   </a>
							</div>--}}
					   </div>
					    <!-------- Restoran rating block -------->
					   <div class="c-sidebar__rating">
						   <div class="c-rating">
							   <div class="c-rating--food">
								   <div class="c-rating__label">{{TransWord::getArabic('Food')}}</div>
								   <div class="c-rating__count">{{ $restoran->score_food }}</div>
								   <div class="c-rating__stars">
									   {{ $restoran->getStarViews($restoran->score_food) }}
								   </div>
							   </div>
							   <div class="c-rating--service">
								   <div class="c-rating__label">{{TransWord::getArabic('Service')}}</div>
								   <div class="c-rating__count">{{ $restoran->score_service }}</div>
								   <div class="c-rating__stars">
										{{ $restoran->getStarViews($restoran->score_service) }}
								   </div>
							   </div>
							   <div class="c-rating--city">
								   <div class="c-rating__label">{{TransWord::getArabic('Interior')}}</div>
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
									   <i class="c-png-icon c-png-icon-pointer c-icon--checkbox js-select-restoran-option" data-id='{{ $id }}' data-check='{{ ($r['check'] ? '1' : '0') }}'></i>
									   <i class="c-png-icon {{ $r['icon'] }}"></i>
									   <div class="c-checklist__text">{{TransWord::getArabic($r['name'],false)}}</div>
								   </li>
								@endforeach
						   </ul>
						   {{--<div class="c-sidebar__checklist__admin">
							   <a href="#" class="c-edit c-edit--round"><i class="c-edit__icon icon-57"></i></a>
						   </div>--}}
					   </div>
					   <!-------- Restoran more_info block -------->
					   <div class="c-sidebar__about">
						   <div class="c-about">
							   <h3 class="c-about__header">
								   {{TransWord::getArabic('About us')}}
							   </h3>
							   <div class="c-about__body">
									<textarea class="form_update_input js-max-500-symbol" disabled='disabled'  name="more_info" data-id='more_info'
												data-type='company' data-before=''  height="200" style="width:100%" placeholder="{{TransWord::getArabic('Max 500 symbols',false)}}">{{ $company->more_info }}</textarea>
							   </div>
							   <div class="c-sidebar__about__admin">
									<span class="form_update_ok hide" data-id='more_info'>
										&#10004;
									</span>
									<span class="form_update_cancel hide" data-id='more_info'>
										&#10006;
									</span>
									<span class="form_update_pencil " data-id='more_info'>
										<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
									</span>
							   </div>
						   </div>
					   </div>
					   <!-------- Restoran contacts block -------->
					   <div class="c-sidebar__contacts">
							<!-------- Restoran email -------->
						   <div class="c-sidebar__mail">
								<a href="mailto:{{ $user->email }}" class="c-sidebar__mail__link">
								   <i class="c-png-icon c-icon--sidebar--mail"></i>
								   
									<input type="text" class="form_update_input" value="{{ $user->email }}" disabled='disabled'  name="email" data-id='email' data-type='user' data-before=''>
								</a>
									<span class="form_update_ok hide" data-id='email'>
										&#10004;
									</span>
									<span class="form_update_cancel hide" data-id='email'>
										&#10006;
									</span>
									<span class="form_update_pencil" data-id='email'>
										<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
									</span>								
						   </div>
						   <!-------- Restoran web_site -------->
						   <div class="c-sidebar__site">
							<a href="http://{{ $company->web_site }}" class="c-sidebar__mail__link">
								<i class="c-png-icon c-icon--sidebar--site"></i>
							   
							   <input type="text" class="form_update_input" value="{{ $company->web_site }}" disabled='disabled'  name="web_site" data-id='web_site' data-type='company' data-before=''>
							</a>
								<span class="form_update_ok hide" data-id='web_site'>
									&#10004;
								</span>
								<span class="form_update_cancel hide" data-id='web_site'>
									&#10006;
								</span>
								<span class="form_update_pencil" data-id='web_site'>
									<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
								</span>
								
						   </div>
					   </div>
					   <div class="c-sidebar__info">
						   <div class="c-info">
								<!-------- Restoran created_at -------->
							   <div class="c-info__since">
								   {{TransWord::getArabic('member since')}} <div class="c-info__value">{{ $company->created_at }}</div>
							   </div>
							   <!-------- Restoran total_views -------->
							   <div class="c-info__since">
								   {{TransWord::getArabic('visitors total')}} — <div class="c-info__value c-info__value--green">{{ $company->total_views }}</div>
							   </div>
						   </div>
					   </div>
				   </div>
			   
		   </div>
	   </div>
   </div>
</section>
	
<script type="text/javascript">
jQuery(function($){
	$.mask.definitions['9'] = '';
	$.mask.definitions['n'] = '[0-9]';
    $(".phone_uae").mask("+ (971) nn nnn-nnnn");
});
</script>

@include('front.restoran.include.map')
@stop
