{{ Form::open(array('url'=>action('CompanyVipController@postMainSetting'), 'method' => 'post', 'role'=>'form')) }}
<div class="p_v_c_settings  shadow js-company_vip_main_setting">
	<div class="p_v_c_settings__left">
		<div class="row specail_input_c_vip">
			<input type="text" class="form_update_input" value="{{ $company->title }}" name="title" data-id='title' data-type='company' maxlength="40" data-before='' style="width:85%; font-size: 14px;">
			<span class="form_update_ok hide" data-id='title'>&#10004;</span>
			<span class="form_update_cancel hide" data-id='title'>&#10006;</span>
			<span class="form_update_pencil " data-id='title'><img src="/front/img/icons/pencil.png" class="form_update_pencil__image" /></span>
		</div>
		<div class="row specail_input_c_vip">
			<input type="text" class="form_update_input" value="{{ $company->activity }}"  name="activity" data-id='activity' data-type='company' maxlength="60" data-before='' style="width:85%; font-size: 14px;">
			<span class="form_update_ok hide" data-id='activity'>&#10004;</span>
			<span class="form_update_cancel hide" data-id='activity'>&#10006;</span>
			<span class="form_update_pencil " data-id='activity'><img src="/front/img/icons/pencil.png" class="form_update_pencil__image" /></span>
		</div>
		<div class="row" style="font-weight: 600;">
			{{TransWord::getArabic('Greetings')}} <span style="font-size:11px;">{{TransWord::getArabic('(30 symbols only)')}}</span>
			<div class="onoffswitch" style="float: right;">
				<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox js_is_greeting_call" id="myonoffswitch" {{ ($company->is_greeting ? 'checked' : null) }}>
				<label class="onoffswitch-label" for="myonoffswitch">
					<span class="onoffswitch-inner"></span>
					<span class="onoffswitch-switch"></span>
				</label>
			</div>
			<input type='hidden' name='is_greeting' value='{{ $company->is_greeting }}' class='js_is_greeting_input' />
		</div>
		<div class="row specail_input_c_vip">
			<input type="text" class="form_update_input" value="{{ $company->greeting }}"   name="greeting" data-id='greeting' maxlength='30' data-type='company' data-before='' style="width:100%; font-size: 14px;" placeholder="{{TransWord::getArabic('Write your greeting here',false)}}" />
			<!--<span class="form_update_ok hide" data-id='greeting'>&#10004;</span>
			<span class="form_update_cancel hide" data-id='greeting'>&#10006;</span>
			<span class="form_update_pencil " data-id='greeting'><img src="/front/img/icons/pencil.png" class="form_update_pencil__image" /></span>-->
		</div>
		<div class="p_v_c_settings_cats">
			<?php $i = 1; ?>
			@foreach ($company->relCat as $cat) 
				<div class='p_v_c_settings_cat shadow'>
					<div class="p_v_c_settings_cat_row">
						<span class='p_v_c_settings_cat_title'> {{TransWord::getArabic('Status',false)}} </span>
						 {{  Form::select('type_id[]', array(Null=>'') + $ar_type, $cat->type_id, array('class'=>'p_v_c_settings_cat_input js-company_type', 'id'=>'type_id', 'required'=>'required')) }}
					</div>
					<div class="p_v_c_settings_cat_row">
						<span class='p_v_c_settings_cat_title'> {{TransWord::getArabic('Category',false)}} </span>
						 {{  Form::select('cat_id[]', array(Null=>'') + $ar_cat, $cat->cat_id, array('class'=>'p_v_c_settings_cat_input js-company_cat')) }}
					</div>
					<div class="p_v_c_settings_cat_row">
						<span class='p_v_c_settings_cat_title'> {{TransWord::getArabic('Subcategory',false)}} </span>
						 {{  Form::select('subcat_id[]', array(Null=>'') + $ar_subcat, $cat->subcat_id, array('class'=>'p_v_c_settings_cat_input js-company_subcat')) }}
					</div>
					@if ($i == 1)
						<div class="p_v_c_settings_cat_row">
							 <input type="checkbox" name="whosale" value="1" {{ ($company->whosale ? 'checked' : null) }}> <span class='p_v_c_settings_cat_title'>{{TransWord::getArabic('Wholesale',false)}}</span> 
							 <input type="checkbox" name="retail" value="1" {{ ($company->retail ? 'checked' : null) }}> <span class='p_v_c_settings_cat_title'>{{TransWord::getArabic('Retail',false)}}</span>
						</div>
						<div class='p_v_c_settings_cat_add js-p_v_c_settings_cat_add'><img src="/front/img/icons/link_plus.png" width="15"></div>
					@else 
						<div class="p_v_c_settings_cat_add js-p_v_c_settings_cat_delete"><img src="/front/img/icons/link_minus.png" width="15"></div>
					@endif
				</div>
				<?php $i++; ?>
			@endforeach
			

		</div>
		
		Your login: <input type="text" class="form_update_input" value="{{ $user->email }}" style="font-size: 14px;" name="email" data-id='aasds' data-type='user' data-before='' placeholder="{{TransWord::getArabic('Enter your skype',false)}}"> <span class="form_update_ok hide" data-id='aasds'>&#10004;</span>
			<span class="form_update_cancel hide" data-id='aasds'>&#10006;</span> <span class="form_update_pencil " data-id='aasds'><img src="/front/img/icons/pencil.png" class="form_update_pencil__image" /></span> <br />
	</div>
	<div class="p_v_c_settings__right">
		<div class="row skype">
			 
			<input type="text" class="form_update_input" value="{{ $social->skype }}" style="font-size: 14px;" name="skype" data-id='skype' data-type='social' data-before='' placeholder="{{TransWord::getArabic('Enter your skype',false)}}">
			<span class="form_update_ok hide" data-id='skype'>&#10004;</span>
			<span class="form_update_cancel hide" data-id='skype'>&#10006;</span>
			<span class="form_update_pencil " data-id='skype'><img src="/front/img/icons/pencil.png" class="form_update_pencil__image" /></span>
		</div>
		<div class="row fb">
			<input type="text" class="form_update_input" value="{{ $social->facebook }}" style="font-size: 14px;" name="facebook" data-id='facebook' data-type='social' data-before='' placeholder="{{TransWord::getArabic('Enter your facebook',false)}}">
			<span class="form_update_ok hide" data-id='facebook'>&#10004;</span>
			<span class="form_update_cancel hide" data-id='facebook'>&#10006;</span>
			<span class="form_update_pencil " data-id='facebook'><img src="/front/img/icons/pencil.png" class="form_update_pencil__image" /></span>
		</div>
		<div class="row insta">
			 
			<input type="text" class="form_update_input" value="{{ $social->instagram }}" style="font-size: 14px;" name="instagram" data-id='instagram' data-type='social' data-before='' placeholder="{{TransWord::getArabic('Enter your instagram',false)}}">
			<span class="form_update_ok hide" data-id='instagram'>&#10004;</span>
			<span class="form_update_cancel hide" data-id='instagram'>&#10006;</span>
			<span class="form_update_pencil " data-id='instagram'><img src="/front/img/icons/pencil.png" class="form_update_pencil__image" /></span>
		</div>
		<div class="row youtube">
			<input type="text" class="form_update_input" value="{{ $social->youtube }}" style="font-size: 14px;" name="youtube" data-id='youtube' data-type='social' data-before='' placeholder="{{TransWord::getArabic('Enter your youtube',false)}}">
			<span class="form_update_ok hide" data-id='youtube'>&#10004;</span>
			<span class="form_update_cancel hide" data-id='youtube'>&#10006;</span>
			<span class="form_update_pencil " data-id='youtube'><img src="/front/img/icons/pencil.png" class="form_update_pencil__image" /></span>
		</div>
		<div class="row">
			<span style="font-weight:600; padding-right:20px;">{{TransWord::getArabic('Callback')}}</span>
			<div class="onoffswitch">
				<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox js_is_callback_call" id="switcher" {{ ($company->is_callback ? 'checked' : null) }}>
				<label class="onoffswitch-label" for="switcher">
					<span class="onoffswitch-inner"></span>
					<span class="onoffswitch-switch"></span>
				</label>
			</div>
			<input type='hidden' name='is_callback' value='{{ $company->is_callback }}' class='js_is_callback_input'>
		</div>
		<br />
		<div class="row">
			<div class='p_v_c_settings_orange_title'>{{TransWord::getArabic('Set New Password',false)}}</div>
			<div class="row">
				<div class='col-md-48 specail_input_c_vip'>
					<input type="password" class="form_update_input" name='old_password' placeholder="{{TransWord::getArabic('Enter old password',false)}}">
				</div>
			</div>
			<div class="row">
				<div class='col-md-48 col-sm-48 specail_input_c_vip'>
					<input type="password" class="form_update_input" name='password'  placeholder="{{TransWord::getArabic('Set new password',false)}}">
				</div>
				<div class='col-md-48 col-sm-48 specail_input_c_vip' style="margin-left:10px;">
					<input type="password" class="form_update_input" name='re_password' placeholder="{{TransWord::getArabic('Repeat new password',false)}}">
				</div>
			</div>
		</div>
		<div class=" p_v_c_settings__buttons">
			<button  type="button" class="c-button c-button--red js-company_vip_main_setting_open">{{TransWord::getArabic('Cancel',false)}}</button>
			<input type="submit" class="c-button c-button--green" value="{{TransWord::getArabic('Apply changes',false)}}">
		</div>
	</div>
</div>
{{ Form::close() }}