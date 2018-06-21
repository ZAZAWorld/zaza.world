@extends('front.layout')
@section('js')
	@parent
	{{ HTML::script('front/js/autoresize.jquery.js') }}
	{{ HTML::script('front/js/personal-cabinet.js') }}
@endsection

@section('content')
<div class="c-restourant__topstatus js-default-company-bar">
	<div class="c-topstatus">
		<div class="l-container">
			<div class="l-grid-noGutter-middle_sm-1 wrapper_header">
				<!---------- Company title update --------->
				<div class="" style="width:35%;">
					<div class="c-description">
						<div class="p_title__name">
							<input type="text" class="form_update_input" value="{{ $company->title }}" disabled='disabled'  name="title" data-id='title' data-type='company' data-before=''>
							<span class="form_update_ok hide" data-id='title'>
								&#10004;
							</span>
							<span class="form_update_cancel hide" data-id='title'>
								&#10006;
							</span>
							<span class="form_update_pencil " data-id='title'>
								<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
							</span>
						</div>
					</div>
				</div>
				<!---------- Save link--------->
				<div class="buttons_header_company_simple">
					<div class="c-online" style="float:right;">
						<div class="c-online__yes">
							 <a href="/company-simple/index"><div style="background:url('/front/img/icons/icon-ok.png') no-repeat 0 0; padding:0 0 5px 25px;">Save changes </div> </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>            
</div>

<div class="p_company">
    <div class="p_company__left">
        <div class="p_com">
            <div class="p_com_title">
                {{TransWord::getArabic('About company')}}
            </div>
			
			<!---------- Logo update block--------->
            <div class="p_com_logo_block">
                <div class="p_com_logo" style="background:url({{ $company->photo }}) no-repeat center center; background-size: 100%;">
                
				</div>
                <input class="p_com_logo_block__file" type="file" name="file"/>
                <img class='p_com_logo_block__upload' src="/front/img/icons/link_plus.png" />
            </div>

            <div class="p_com_list">
				<!---------- Company phone update block--------->
                <div class="p_com_list__item">
                    <img class="p_com_list__img" src="/front/img/icons/icon_phone.png" />
                    <span class="p_com_list__text">
                        <input type="text" class="form_update_input" value="{{ $company->phone }}" disabled='disabled'  name="phone" data-id='phone' data-type='company' data-before=''>
                        <span class="form_update_ok hide" data-id='phone'>
                            &#10004;
                        </span>
                        <span class="form_update_cancel hide" data-id='phone'>
                            &#10006;
                        </span>
                        <span class="form_update_pencil " data-id='phone'>
                            <img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
                        </span>
                    </span>
                </div>
				<!---------- Company mobile update block--------->
                <div class="p_com_list__item">
                    <img class="p_com_list__img" src="/front/img/icons/icon_mobile.png" />
                    <span class="p_com_list__text">
                        <input type="text" class="form_update_input" value="{{ $company->mobile }}" disabled='disabled'  name="mobile" data-id='mobile' data-type='company' data-before=''>
                        <span class="form_update_ok hide" data-id='mobile'>
                            &#10004;
                        </span>
                        <span class="form_update_cancel hide" data-id='mobile'>
                            &#10006;
                        </span>
                        <span class="form_update_pencil " data-id='mobile'>
                            <img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
                        </span>
                    </span>
                </div>
				<!---------- Company email update block--------->
                <div class="p_com_list__item">
                    <img class="p_com_list__img" src="/front/img/icons/icon_mail.png" />
                    <span class="p_com_list__text">
                        <input type="text" class="form_update_input" value="{{ $user->email }}" disabled='disabled'  name="email" data-id='email' data-type='user' data-before=''>
                        <span class="form_update_ok hide" data-id='email'>
                            &#10004;
                        </span>
                        <span class="form_update_cancel hide" data-id='email'>
                            &#10006;
                        </span>
                        <span class="form_update_pencil " data-id='email'>
                            <img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
                        </span>
                    </span>
                </div>
				<!---------- Company location update block--------->
                <div class="p_com_list__item">
                    <img class="p_com_list__img" src="/front/img/icons/icon_location.png" />
                    <span class="p_com_list__text">
                        <input type="text" class="form_update_input" value="{{ $company->location }}" disabled='disabled'  name="location" data-id='location' data-type='company' data-before=''>
                        <span class="form_update_ok hide" data-id='location'>
                            &#10004;
                        </span>
                        <span class="form_update_cancel hide" data-id='location'>
                            &#10006;
                        </span>
                        <span class="form_update_pencil " data-id='location'>
                            <img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="p_company__right">
        <div class="p_com_option">
			<!---------- Company title update block--------->
            <div class="p_com_option__item">
                <div class='p_com_option__name' > {{TransWord::getArabic('Register Name')}} </div>
                <div class='p_com_option__val' >
                    <input type="text" class="form_update_input" value="{{ $company->title }}" disabled='disabled'  name="title" data-id='r_title' data-type='company' data-before=''>
                    <span class="form_update_ok hide" data-id='r_title'>
                        &#10004;
                    </span>
                    <span class="form_update_cancel hide" data-id='r_title'>
                        &#10006;
                    </span>
                    <span class="form_update_pencil " data-id='r_title'>
                        <img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
                    </span>
                </div>
            </div>
			<!---------- Company activity update block--------->
            <div class="p_com_option__item">
                <div class='p_com_option__name' > {{TransWord::getArabic('Activity')}} </div>
                <div class='p_com_option__val' >
                    <input type="text" class="form_update_input" value="{{ $company->activity }}" disabled='disabled'  name="activity" data-id='activity' data-type='company' data-before=''>
                    <span class="form_update_ok hide" data-id='activity'>
                        &#10004;
                    </span>
                    <span class="form_update_cancel hide" data-id='activity'>
                        &#10006;
                    </span>
                    <span class="form_update_pencil " data-id='activity'>
                        <img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
                    </span>
                </div>
            </div>
			<!---------- Company city_id update block--------->
            <div class="p_com_option__item">
                <div class='p_com_option__name' > {{TransWord::getArabic('City')}}, {{TransWord::getArabic('Country')}} </div>
                <div class='p_com_option__val' >
                    {{  Form::select('city_id', SysCity::getCityAr(), $user->city_id , array('class'=>'form_update_input', 'id'=>'city_id', 'disabled'=>'disabled', 'data-id'=>'city_id', 'data-type'=>'user')) }}
                    <span class="form_update_ok hide" data-id='city_id'>
                        &#10004;
                    </span>
                    <span class="form_update_cancel hide" data-id='city_id'>
                        &#10006;
                    </span>
                    <span class="form_update_pencil " data-id='city_id'>
                        <img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
                    </span>
                </div>
            </div>
			<!---------- Company branches update block--------->
            <div class="p_com_option__item">
                <div class='p_com_option__name' > {{TransWord::getArabic('Branches')}} </div>
                <div class='p_com_option__val' >
                    <input type="text" class="form_update_input" value="{{ $company->branches }}" disabled='disabled'  name="branches" data-id='branches' data-type='company' data-before=''>
                    <span class="form_update_ok hide" data-id='branches'>
                        &#10004;
                    </span>
                    <span class="form_update_cancel hide" data-id='branches'>
                        &#10006;
                    </span>
                    <span class="form_update_pencil " data-id='branches'>
                        <img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
                    </span>
                </div>
            </div>
			<!---------- Company size_company update block--------->
            <div class="p_com_option__item">
                <div class='p_com_option__name' > {{TransWord::getArabic('Company size')}} </div>
                <div class='p_com_option__val' >
                    <input type="text" class="form_update_input" value="{{ $company->size_company }}" disabled='disabled'  name="size_company" data-id='size_company' data-type='company' data-before=''>
                    <span class="form_update_ok hide" data-id='size_company'>
                        &#10004;
                    </span>
                    <span class="form_update_cancel hide" data-id='size_company'>
                        &#10006;
                    </span>
                    <span class="form_update_pencil " data-id='size_company'>
                        <img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
                    </span>
                </div>
            </div>
			<!---------- Company active_since update block--------->
            <div class="p_com_option__item">
                <div class='p_com_option__name' > {{TransWord::getArabic('Active since')}} </div>
                <div class='p_com_option__val' >
                    <input type="text" class="form_update_input" value="{{ $company->active_since }}" disabled='disabled'  name="active_since" data-id='active_since' data-type='company' data-before=''>
                    <span class="form_update_ok hide" data-id='active_since'>
                        &#10004;
                    </span>
                    <span class="form_update_cancel hide" data-id='active_since'>
                        &#10006;
                    </span>
                    <span class="form_update_pencil " data-id='active_since'>
                        <img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
                    </span>
                </div>
            </div>
			<!---------- Company more_info update block--------->
            <div class="p_com_option__item">
                <div class='p_com_option__name' > {{TransWord::getArabic('More info')}} </div>
                <div class='p_com_option__val p_com_option__val-text' >
                   <textarea class="form_update_input" disabled='disabled'  name="more_info" data-id='more_info' data-type='company' data-before='' width="300" height="200">{{$company->more_info}}</textarea>
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
    </div>
</div>


@stop
