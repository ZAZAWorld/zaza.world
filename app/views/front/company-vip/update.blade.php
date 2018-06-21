@extends('front.layout')
@section('js')
	@parent
	{{ HTML::script('front/js/autoresize.jquery.js') }}
	{{ HTML::script('front/js/company_vip.js') }}
	{{ HTML::script('front/js/blog.js') }}
@endsection

@section('content')


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
							<div class="top_status_info top_vip_update">
								<!--------- follow count ------------>
								<div class="c-follow follow_vip_update">
									<div class="c-follow__count">
										<i class='c-follower__icon icon-19 {{ ($company->checkLike() ? "active" : null) }} js-like-company-set' data-id="{{ $company->id }}"> </i>
										<span class="c-follow__number js-total-company-like">{{ $company->total_like }}</span>
									</div>
								</div>
								<!--------- to top link ------------>
								<div class="c-top c-top_vip_update">
									@if ($company->is_top)
										<a href="#asdas" class="c-top__link ">
											 <span class="icon-10 watchs__spec" style="font-size: 20px; vertical-align: middle;"> </span> {{ $company->count_top }} <div><small style="color:#000">views left</small></div>
										</a>
									@else 
										<a href="#asdas" class="c-top__link js_call_to_top">
											<i class="c-top__icon icon-122"></i>
										</a>
									@endif
								</div>
								<!--------- ballance link ------------>
								<div class="c-ballance c_ballance_vip_update">
									<i class="c-ballance__icon icon-38"></i>
									<span class="c-ballance__text js-refil-budjet" data-tooltip="<a href='#refill'>{{TransWord::getArabic('Refill balance',false)}}</a>">{{TransWord::getArabic('AED',false)}} {{ Budjet::getBalans($user) }}</span>
								</div>
								<!--------- setting link ------------>
								<div class="c-settings c-settings_vip_update">
									<a href="#main_setting" class="c-settings__link js-company_vip_main_setting_open">
										<i class="c-settings__icon icon-54"></i>
									</a>
								</div>
								<!--------- company onlain index ------->
								<div class="online_index online_index_vip_update" style="display: inline-block;">
									<div style="display: inline-block;">
										<img src='/front/img/icons/green_grafic.png' style="
																							width: auto;
																							height: 28px;
																							position: relative;
																							top: 7px;"/> {{ $company->onlain_index }}
									</div>
								
									<!--------- onlain link ------------>
									<div class="c-online c-online_vip_update">
										<div class="c-online__yes c-online__yes_vip_update">
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
		</div>
	</div>          
</div>
	
<div class="p_v_c_top">
	<!--------- setting main dialog ------------>
	@include('front.company-vip.include.setting_main')
	<!--------- setting photo dialog ------------>
	@include('front.company-vip.include.setting_photo')
	
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
				<p class="media_gallery">Media gallery <a href="#" class="js-company_photo_setting_open"><i class="c-edit__icon icon-57"></i></a></p> 
						   
					 	<?php $i = 0; ?>   
				  @forelse ($photos as $p)
						<a data-slide-index="{{ $i }}" href="">
							<img src="{{ $p->path }}" width="100" style="margin: 5px 0;"/>
                        </a>
						<?php $i++; ?>
					@empty 
						<a data-slide-index="0" href=""> 
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
			<!--------- logo block ------------>
            <div class="p_v_c_logo js-company_photo_setting_open" style="background:url({{ $company->photo }}) no-repeat center center; background-size: auto 100%;">
                <input class="p_com_logo_block__file" type="file" name="file" />
                <!--<img class='p_v_c_logo_block__upload ' src="/front/img/icons/link_plus.png" />-->
            </div>
            <div class="p_v_c_option">
				<!--------- company phone block ------------>
                <div class="p_v_c_option__item">
                    <img class="p_com_list__img" src="/front/img/icons/icon_phone.png" />
                    <span class="p_com_list__text">
                        <input type="text" class="phone_uae form_update_input" value="{{ $company->phone }}" name="phone" data-id='phone' data-type='company' data-before=''>
                        <span class="form_update_ok hide" data-id='phone'>
                            &#10004;
                        </span>
                        <span class="form_update_cancel hide" data-id='phone'>
                            &#10006;
                        </span>
                        <span class="form_update_pencil" data-id='phone'>
                            <img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
                        </span>
                    </span>
                </div>
				<!--------- company mobile block ------------>
                <div class="p_v_c_option__item">
                    <img class="p_com_list__img" src="/front/img/icons/icon_mobile.png" />
                    <span class="p_com_list__text">
                        <input type="text" class="phone_uae form_update_input" value="{{ $company->mobile }}" name="mobile" data-id='mobile' data-type='company' data-before=''>
                        <span class="form_update_ok hide" data-id='mobile'>
                            &#10004;
                        </span>
                        <span class="form_update_cancel hide" data-id='mobile'>
                            &#10006;
                        </span>
                        <span class="form_update_pencil" data-id='mobile'>
                            <img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
                        </span>
                    </span>
                </div>
				<!--------- company email block ------------>
                <div class="p_v_c_option__item">
                    <img class="p_com_list__img" src="/front/img/icons/icon_mail.png" />
                    <span class="p_com_list__text">
                        <input type="text" class="form_update_input" value="{{ $user->email }}"   name="email" data-id='email' data-type='user' data-before=''>
                        <span class="form_update_ok hide" data-id='email'>
                            &#10004;
                        </span>
                        <span class="form_update_cancel hide" data-id='email'>
                            &#10006;
                        </span>
                        <span class="form_update_pencil" data-id='email'>
                            <img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
                        </span>
                    </span>
                </div>
				<!--------- company location block ------------>
                <div class="p_v_c_option__item">
                    <img class="p_com_list__img" src="/front/img/icons/icon_location.png" />
                    <span class="p_com_list__text">
                        <input type="text" class="form_update_input" value="{{ $company->location }}"   name="location" data-id='location' data-type='company' data-before=''>
                        <span class="form_update_ok hide" data-id='location'>
                            &#10004;
                        </span>
                        <span class="form_update_cancel hide" data-id='location'>
                            &#10006;
                        </span>
                        <span class="form_update_pencil" data-id='location'>
                            <img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
                        </span>
                    </span>
                </div>
				
            </div>
			<div class="p_v_c_top_buttons tabs">
				<!--------- company view map button test ------------>
				@if ($company->gps_lan && $company->gps_lat)
                <script>
                    (function(){
                        window.dynamicLocations = [{gps_lat: {{ $company->gps_lat }}, gps_lan: {{ $company->gps_lan }} }];
                    })();
                </script>
                <button class="p_v_c_top_buttons__item view_map js-view_map" onclick="$('.js-open-maps').click();" >
                {{TransWord::getArabic('View Map')}}
					</button>
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
            </div>
        </div>
		<!--------- company visitors ------------>
        <div class="p_panel__rignt">
            <div class="p_panel_visitor">
                <span class="p_panel_visitor__name"> {{TransWord::getArabic('Visitors today')}}  -</span>
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
            <div class="news_shares__title"> {{TransWord::getArabic('Shares & news')}} <b>({{ $ar_blogs->count() }})</b> </div>
			<!--------- company add to blog ------------>
			<div class="news_shares__add">
				<form action="{{ action('BlogController@postAdd') }}" class="js-form-blog-main" method='post' enctype="multipart/form-data">
					<input type="text" class="news_shares__input" name='note'>
					<div class="news_shares__upload ">
						<input name='image' type="file" class='js-form-blog-file' style="display: none;">
						<input type='hidden' name='type_id' value='3'>
						<img src='/front/img/icons/ad_photo_blue.png' class="news_shares__upload__img js-form-blog-img" />
					</div>
					<input type="submit" class="news_shares__button" value=" {{ TransWord::getArabic('Send',false) }}">
				</form>
				<img src="/upload/article/1477393366_JEdQwiW.jpg" class="js_blog_photo_preview" style="display: none; margin: 10px auto; width: 50px;" />
            </div>
			<!--------- company blog list------------>
			<div class="c-posts__list">
				@foreach ($ar_blogs as $b)
					@include('front.blog.company_edit')
				@endforeach
			</div>
			
            <div class="p_news__pagination">
				{{ $ar_blogs->links() }}
            </div>
        </div>
		<!--------- company more_info ------------>
		<div class="about_us tab-content" id="tab-2">
			<h3 class='news_shares__title'> 
				{{TransWord::getArabic('About us',false)}}
				<span class="form_update_ok hide" data-id='more_info'>
					&#10004;
				</span>
				<span class="form_update_cancel hide" data-id='more_info'>
					&#10006;
				</span>
				<span class="form_update_pencil " data-id='more_info'>
					<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
				</span>
			</h3>
			<textarea class="form_update_input" name="more_info" data-id='more_info' data-type='company' data-before='' style=' width: 100%; min-height: 600px;'>{{$company->more_info}}</textarea>
		</div>
		<!--------- company goods_services ------------>
		<div class="goods_services tab-content" id="tab-3">
			<h3 class='news_shares__title'>{{TransWord::getArabic('Goods & Services',false)}}</h3>
			@include('front.company-vip.include.goods_services')
		</div>
		<!--------- company out_team_update ------------>
		<div class="team tab-content" id="tab-4">
			<h3 class='news_shares__title'>{{TransWord::getArabic('Our team',false)}}</h3>
			@include('front.company-vip.include.out_team_update')
		</div>
		<!--------- company license_update ------------>
		<div class="license tab-content" id="tab-5">
			<h3 class='news_shares__title'>{{TransWord::getArabic('License / Certificates',false)}}</h3>
			@include('front.company-vip.include.license_update')
		</div>
		<!--------- company callback ------------>
		<div class="callback tab-content" id="tab-7">
			<h3 class='news_shares__title'>{{TransWord::getArabic('Contact us',false)}} </h3>
			@include('front.company-vip.include.callback')
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
            <div class="p_v_c_accaunt_info__item">
                {{TransWord::getArabic('member since')}} - <b>{{ $company->created_at }}</b>
            </div>
            <div class="p_v_c_accaunt_info__item">
                {{TransWord::getArabic('visitors total')}} - <b class="green">{{ $company->total_views }}</b>
            </div>
        </div>
    </div>
</div>
<div class="m-right-bar_ico"></div>
<script type="text/javascript">
jQuery(function($){
	$.mask.definitions['9'] = '';
	$.mask.definitions['n'] = '[0-9]';
    $(".phone_uae").mask("+ (971) nn nnn-nnnn");
});
</script>

@include('front.company-vip.include.map')

@stop
