@extends('front.layout')
@section('js')
	@parent
	{{ HTML::script('front/js/autoresize.jquery.js') }}
	{{ HTML::script('front/js/company_vip.js') }}
	{{ HTML::script('front/js/blog.js') }}
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
			<div class="l-grid-noGutter">
				<div class="l-grid__col-5_lg-5_md-8_sm-8">
					<div class="c-description">
					<!---- Company name ------>
						<h1 class="c-description__name">
							{{ $company->title }}
						</h1>
					</div>
					<!----------- company  greatings ------------>
					<div class="greatings"> 
						{{ $company->activity }}
						<!--------- company Whosale and Retail block ------------>
						@if ($company->whosale || $company->retail)
							<ul class="whosale">
								@if ($company->whosale)
									<li style='display: inline-block; position: relative; padding: 0 5px 0 15px; margin-right: 5px;'>
										<span style='position: absolute; left: 0; top: 50%; margin-top: -4px; content: ""; 
														width: 8px; height: 8px;  background: #15499f; -webkit-border-radius: 50%; 
														-moz-border-radius: 50%; -ms-border-radius: 50%; border-radius: 50%;'> </span>
										{{TransWord::getArabic('Wholesale',false)}}
									</li>
								@endif
								@if ($company->retail)
									<li style='display: inline-block; position: relative; padding: 0 5px 0 15px; margin-right: 5px;'>
										<span style='position: absolute; left: 0; top: 50%; margin-top: -4px; content: ""; 
														width: 8px; height: 8px;  background: #15499f; -webkit-border-radius: 50%; 
														-moz-border-radius: 50%; -ms-border-radius: 50%; border-radius: 50%;'> </span>
										{{TransWord::getArabic('Retail',false)}}
									</li>
								@endif
							</ul>
						@endif
					
					</div>
					
					
				</div>
				
					<div class="l-grid__col-7_lg-7_md-12_sm-12">
						<div class="l-grid-noGutter-middle_sm-12">
						   <div class="l-grid__col-3_md-3_sm-4_xs-4">
								<!-------- Restoran social --------->
							   <div class="c-social">
									@if ($social->skype)
									   <div class="c-social__item">
										   <a href="skype:{{ $social->skype }}" class="c-social__link c-social--sk"></a>
									   </div>
									@endif
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
							<div class="l-grid__col-9_md-9_sm-8_xs-8">
						   		<div class="top_status_info">
									<!-------- Company follow --------->
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
									<!-------- Company chat --------->
									@if (Auth::check())
										<div class="c-chat">
											<i class="icon-11 c-chat__icon"></i>
											<a href="#" class="c-chat__link js-open-chat" data-user-id="{{ $company->user_id }}">
												{{TransWord::getArabic('chat',false)}}
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
								   <!-------- Company follow__count --------->
								   <div class="c-follow">
									   <div class="c-follow__count">
										   <i class='c-follower__icon icon-19 {{ ($company->checkLike() ? "active" : null) }} js-like-company-set' data-id="{{ $company->id }}"> </i>
										   <span class="c-follow__number js-total-company-like">{{ $company->total_like }}</span>
									   </div>
								   </div>
								   <!--------- Company onlain index ------->
									<div class="online_index" style="display: inline-block;">
										<div style="display: inline-block;">
											<img src='/front/img/icons/green_grafic.png' style="
																								width: auto;
																								height: 28px;
																								position: relative;
																								top: 7px;"/> {{ $company->onlain_index }}
										</div>
									
								   <!-------- Company online --------->
										<div class="c-online">
											<div class="c-online__yes">
												@if ($user->checkUserOnlain())
													<div class="c-online__icon c-online__icon--online"></div>
													<div class="c-online__text">{{TransWord::getArabic('Online',false)}}</div>
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
</div>

<div class="p_v_c_top">
	<!--------- company sliders ------------>
    <div class="p_v_c_top__left"> 
		<div class="item">	
            <div class="vip_company_bx_wrapper">
                <ul class="image-gallery_bx">
                    @forelse ($photos as $p)
						<li> 
							<img src="{{ $p->path }}" />
                        </li>
					@empty 
						<li> 
							<img src="/images/no_name.png" />
                        </li>
					@endforelse
					
					@foreach ($ar_youtube as $p)
						<li> 
							<iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $p->path }}?showinfo=0&enablejsapi=1&origin=https://zaza.ae:8350" frameborder="0" allowfullscreen></iframe>
                        </li>
					@endforeach
                </ul>
				</div>
				
				<div id="bx-pager" class="js-custom-scroll" style="width:160px; float:left; margin-left: 15px; height:500px; overflow-y:auto">
				<p style="font-weight:600;">{{TransWord::getArabic('Media gallery',false)}}</p> 
						   
					<?php $i = 0; ?>
					@forelse ($photos as $p)
						<a data-slide-index="{{ $i }}" href="">
							<img src="{{ $p->path }}" width="100" style="margin: 5px 0;"/>
                        </a>
						<?php $i++; ?>
					@empty 
						<a data-slide-index="1" href=""> 
							<img src="/images/no_name.png" width="100" style="margin: 5px 0;"/>
                        </a>
					@endforelse
					
					@foreach ($ar_youtube as $p)
						<a data-slide-index="{{ $i }}" href=""> 
							<img src="https://img.youtube.com/vi/{{ $p->path }}/0.jpg" width="100" style="margin: 5px 0;"/>
                        </a>
						<?php $i++; ?>
					@endforeach
					
				</div>
		</div>
    </div>
	<!--------- company profile ------------>
    <div class="p_v_c_top__right">
        <div class="p_v_c_profile">
            <div class="p_v_c_logo" style="background:url({{ $company->photo }}) no-repeat center center; background-size: auto 100%;"></div>
            <div class="p_v_c_option">
				<!--------- company phone ------------>
                <div class="p_v_c_option__item">
                    <img class="p_v_c_option__img" src="/front/img/icons/icon_phone.png" />
                    <a href="tel:{{ $company->phone }}"><span class="p_v_c_option__text">{{ $company->phone }}</span></a>
                </div>
				<!--------- company mobile ------------>
                <div class="p_v_c_option__item">
                    <img class="p_v_c_option__img" src="/front/img/icons/icon_mobile.png" />
                    <a href="tel:{{ $company->mobile }}"><span class="p_v_c_option__text"> {{ $company->mobile }}</span></a>
                </div>
				<!--------- company email ------------>
                <div class="p_v_c_option__item">
                    <img class="p_v_c_option__img" src="/front/img/icons/icon_mail.png" />
                    <a href="mailto:{{ $user->email }}"><span class="p_v_c_option__text"> {{ $user->email }}</span></a>
                </div>
				<!--------- company location ------------>
                <div class="p_v_c_option__item">
                    <img class="p_v_c_option__img" src="/front/img/icons/icon_location.png" />
                    <span class="p_v_c_option__text"> {{$company->location_govno}}</span>
                </div>
                
            </div>
			
			<div class="p_v_c_top_buttons tabs">
					<!--------- company view map button ------------>
					@if ($company->gps_lan && $company->gps_lat)
                    <script>
                        (function(){
                            window.dynamicLocations = [{gps_lat: {{ $company->gps_lat }}, gps_lan: {{ $company->gps_lan }} }];
                        })();
                    </script>
                    <button class="p_v_c_top_buttons__item view_map js-view_map" onclick="$('.js-open-maps').click();">
                    {{TransWord::getArabic('View Map')}}
						</button>
					@endif
					<!--------- callback button ------------>
					@if ($company->is_callback)
						<?php
						#<a href='{{ action('CatalogCompanyController@getCallBack', $company->id) }}'>
						?>
							<button class="p_v_c_top_buttons__item callback view_callback">
							{{TransWord::getArabic('Callback')}}
						</button>
						@include('front.company-vip.include.callback')
					@endif
                </div>
				
				
        </div>
    </div>
</div>
<!--------- company panel ------------>
<div class="p_panel">
    <div class="p_panel__content">
		<!--------- company tab links ------------>
        <div class="p_panel__left">
            <div class="p_panel_buttons tabs">
                <a href="#Shares" class="p_panel_buttons__item active tab-link current" data-tab="tab-1" >
                    {{TransWord::getArabic('Shares')}}
                </a>
                <a href="#About" class="p_panel_buttons__item tab-link" data-tab="tab-2">
                    {{TransWord::getArabic('About us')}}
                </a>
                <a href="#GoodsServices" class="p_panel_buttons__item tab-link" data-tab="tab-3">
                    {{TransWord::getArabic('Goods & Services')}}
                </a>
                <a href="#Team" class="p_panel_buttons__item tab-link" data-tab="tab-4">
                    {{TransWord::getArabic('Our team')}}
                </a>
                <a href="#License" class="p_panel_buttons__item tab-link" data-tab="tab-5">
                    {{TransWord::getArabic('License / Certificates')}}
                </a>
				<a href="#Reviews" class="p_panel_buttons__item tab-link mobile" data-tab="tab-6">
					{{TransWord::getArabic('Reviews')}}
				</a>
            </div>
        </div>
		<!--------- company visitors ------------>
        <div class="p_panel__rignt">
            <div class="p_panel_visitor">
                <span class="p_panel_visitor__name"> {{TransWord::getArabic('Visitors for today')}}  -</span>
                <span class="p_panel_visitor__val">
                    <img class="p_panel_visitor__icon" src="/front/img/icons/login_hover.png" /> {{ $company->visitors_today }}
                </span>
            </div>
        </div>
		<div style="clear:both"></div>
    </div>
</div>

<div class="p_v_c_main">
    <div class="p_v_c_main__left">
		<!--------- company blog ------------>
        <div class="news_shares tab-content current" id="tab-1">
            <div class="news_shares__title"> {{TransWord::getArabic('Shares & news',false)}} <b>({{ $ar_blogs->count() }})</b> </div>
			@include('front.company-vip.include.blog')
            <div class="p_news__pagination">
				{{ $ar_blogs->links() }}
            </div>
        </div>
		<!--------- company more_info ------------>
		<div class="about_us tab-content" id="tab-2">
			<h3 class='news_shares__title'>{{TransWord::getArabic('About us',false)}}</h3>
			{{ preg_replace('/(\r\n|\n|\r)/', '<br/>', $company->more_info) }}
		</div>
		<!--------- company goods_services ------------>
		<div class="goods_services tab-content" id="tab-3">
			<h3 class='news_shares__title'> {{TransWord::getArabic('Goods & Services')}}</h3>
			@include('front.company-vip.include.goods_services_view')
		</div>
		<!--------- company out_team_view ------------>
		<div class="team tab-content" id="tab-4">
			<h3 class='news_shares__title'>{{TransWord::getArabic('Our team',false)}}</h3>
			@include('front.company-vip.include.out_team_view')
		</div>
		<!--------- company license_view ------------>
		<div class="license tab-content" id="tab-5">
			<h3 class='news_shares__title'>{{TransWord::getArabic('License / Certificates',false)}}</h3>
			@include('front.company-vip.include.license_view')
		</div>

		<div class="reviews tab-content mobile" id="tab-6">
			<h3 class='news_shares__title mobile'>{{TransWord::getArabic('Reviews',false)}}</h3>
			<div class="m-visitors_panel mobile">
					<span class="p_panel_visitor__name mobile"> {{TransWord::getArabic('Visitors for today')}}  -</span>
					<span class="p_panel_visitor__val mobile">
				<img class="p_panel_visitor__icon mobile" src="/front/img/icons/login_hover.png" /> {{ $company->visitors_today }}
			</span>
			</div>
				<!--------- company comment ------------>
			<div class="comment mobile">
					@include('front.company-vip.include.comment')
			</div>

			<div class="p_v_c_accaunt_info mobile">
					<!--------- created_at --------->
					<div class="p_v_c_accaunt_info__item mobile">
						{{TransWord::getArabic('member since')}} - <b>{{ $company->created_at }}</b>
					</div>
					<!--------- total_views --------->
					<div class="p_v_c_accaunt_info__item mobile">
						{{TransWord::getArabic('visitors total')}} - <b class="green">{{ $company->total_views }}</b>
					</div>
			</div>
		</div>
    </div>
    <div class="p_v_c_main__right">
		<div class="m-visitors_panel">
			<span class="p_panel_visitor__name"> {{TransWord::getArabic('Visitors for today')}}  -</span>
			<span class="p_panel_visitor__val">
				<img class="p_panel_visitor__icon" src="/front/img/icons/login_hover.png" /> {{ $company->visitors_today }}
			</span>
		</div>
		<!--------- company comment ------------>
        <div class="comment">
			@include('front.company-vip.include.comment')
        </div>
		
        <div class="p_v_c_accaunt_info">
			<!--------- created_at --------->
            <div class="p_v_c_accaunt_info__item">
                {{TransWord::getArabic('member since')}} - <b>{{ $company->created_at }}</b>
            </div>
			<!--------- total_views --------->
            <div class="p_v_c_accaunt_info__item">
                {{TransWord::getArabic('visitors total')}} - <b class="green">{{ $company->total_views }}</b>
            </div>
        </div>
    </div>
</div>
<div class="m-right-bar_ico"></div>
<!-------- Company greating block --------->
@if ($company->is_greeting && !Session::has('mess_ad_success') && $errors->isEmpty() && !Session::has('error') && !Session::has('success'))
	<div class='js-greeting-block' style=' position: absolute; width: 100%; top: 0; height: 1600px; z-index: 999999999999999999999; display: none;'>
		<div style='position: fixed; right: 10%; width: 300px; height: auto; bottom: 5%; text-align: center; background: #15499f; padding: 20px; opacity: 0.7; color: #fff; border-radius: 10px;'>
			{{ $company->greeting }}
		</div>
	</div>
@endif

@include('front.company-vip.include.map')

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
