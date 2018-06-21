{{ Form::open(array('url'=>action('CompanyVipController@postImages'), 'method' => 'post', 'role'=>'form')) }}
<div class="p_v_c_settings shadow row js-company_photo_setting">
	<div class='col-md-30 col-md-offset-2'>
		<div class='company_vip_main_photo'>
			
				@if ($company->photo) 
					<div class='company_vip_main_photo_squery' style="background:url({{ $company->photo }}) no-repeat center center; background-size: contain; border: 1px solid #15499f !important;"></div>
				@else 
					<div class='company_vip_main_photo_squery'><span class='company_vip_main_photo_squery_link js-company_vip_main_photo_call'>+</span></div>
				@endif
			
			<input type='hidden' name='main_photo' class='js-company_vip_main_photo_input' value="{{ $company->photo }}" />
			<input type='file' class='js-company_vip_main_photo_file' style='display:none' />
			<span class='company_vip_main_photo_title js-company_vip_main_photo_call'>{{TransWord::getArabic('Add logo',false)}}</span>
		</div>
		<div class='company_vip_youtube'>
			<div class="row youtube" style="padding-left: 40px;"><span class='company_vip_youtube_title'>{{TransWord::getArabic('Youtube videos',false)}}</span></div>
			<div class='company_vip_youtube_list'>
				@foreach ($ar_youtube as $y) 
					<div class='company_vip_youtube_item'>
						<input type="text" class="form_update_input" value="https://youtu.be/{{ $y->path }}"  name="youtube_link[]" data-id='youtube_link_{{ $y->id }}' data-type='youtube_link' data-before=''>
						<span class="form_update_ok hide" data-id='youtube_link_{{ $y->id }}'>&#10004;</span>
						<span class="form_update_cancel hide" data-id='youtube_link_{{ $y->id }}'>&#10006;</span>
						<span class="form_update_pencil " data-id='youtube_link_{{ $y->id }}'><img src="/front/img/icons/pencil.png" class="form_update_pencil__image" /></span>
						<span class='js-del-youtube-asdasd'>
							<img src="/front/img/icons/link_minus.png"  style="cursor: pointer; width: 17px; height: 17px;">
						</span>
					</div>
				@endforeach
			</div>
			<div class='company_vip_youtube_bottom'>
				<span class='company_vip_youtube_bottom_icon'><img src="/front/img/icons/link_plus.png" width="15"></span> 
				{{TransWord::getArabic('Add link',false)}} (<span class='js-com_youtube_count'>{{ (2 - $youtube_links->count()) }}</span> {{TransWord::getArabic('left',false)}})
			</div>
		</div>
	</div>
	<div class='col-md-64 col-md-offset-2'>
		<div class='company_vip_photo_list row'>
		<span style="color: #15499f; font-size:14px; margin-left:5px;">Media gallery photos</span> <br />
			@foreach ($photos as $p)
				<div class='company_vip_photo_item js-company_vip_photo_item' style="width:110px; float: left;">
					<div class='company_vip_photo_squery' style="background:url({{ $p->path }}) no-repeat center center; background-size: contain;">
					</div>
					<div class='company_vip_photo_del'>
						✖
					</div>
					<input type='hidden' name='photo[]' class='js-value-company_vip_photo' value="{{ $p->path }}" />
				</div>
			@endforeach
			<div class='company_vip_photo_item' style="width:110px; float: left;">
				<div class='company_vip_photo_squery'>
					<span class='company_vip_photo_squery_span js-add-company_vip_photo'>+</span>
				</div>
				<div class='company_vip_photo_link js-add-company_vip_photo'>
					{{TransWord::getArabic('add more',false)}} (<span class='js-com_galerea_photo'>{{ (15 - $photos->count()) }}</span> {{TransWord::getArabic('left',false)}})
				</div>
				<input type='file' class='js-file-company_vip_photo' style='display:none' />
			</div>
		</div>
		
	</div>
	<div class='col-md-100'>
		<div class=" p_v_c_settings__buttons">
			<button type="button" class="c-button c-button--red js-company_photo_setting_open" style="margin-right: 25px;">{{TransWord::getArabic('Cancel',false)}}</button>
			<input type="submit" class="c-button c-button--green" value="{{TransWord::getArabic('Apply changes',false)}}">
		</div>
	</div>
</div>
{{ Form::close() }}