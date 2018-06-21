<div class="add_ad_feilds__left js-add-ad-upload_1">
	<div class='add_ad_feilds__upload'>
		<input class='add_ad_feilds__upload_file' type="file" name="img" accept="image/*" />
		<img class='add_ad_feilds__upload_img' src="/front/img/icons/foto_blue.png" />
		<div class="add_ad_feilds__upload_text">
			{{ TransWord::getArabic('Click here to upload') }}<br />
			{{ TransWord::getArabic('your photo') }}
		</div>
	</div>
	<span style="font-size: 9px; line-height: 12px !important; display: block;">Photo increases your chances for 7 times
</span>
</div>


@if (!empty($photos) && count($photos)>0)
<div class='row ad_dialog_edit__row'>
    <div class='col-md-100'>
        <div class='row ad_dialog_edit_photo__list'>
            @foreach ($photos as $p)
            <div class='ad_dialog_edit_photo__square'>
                <img src="{{ $p->file }}" class="ad_dialog_edit_photo__image">
                <input type='hidden' name='ar_img[]' value='{{ $p->file }}' accept="image/*">
                <i class='delete ad_dialog_edit_photo__del_link'></i>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="add_ad_feild add_ad_feilds__left" style="height:142px">
	<div class='add_cv_feilds__upload'>
		<input class='add_ad_resume_file' type="file" name="prop[45]" class="normalValidate"  style='position: absolute;
																				top: 0;
																				left: 0;
																				height: 69px;
																				z-index: 9999;
																				opacity: 0;
																				-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
																				filter: alpha(opacity=0);
																				cursor: pointer;'/>
		<img class='add_ad_feilds__upload_img' src="/front/images/cv_add_ico.gif" />
		<div class="add_ad_feilds__upload_text">
			{{ TransWord::getArabic('Click here to upload') }}<br />
			{{ TransWord::getArabic('CV (PDF, MS Word)') }}
		</div>
	</div>
</div>

<!--
<div class="col-md-25">
			<!-- Resume 
			{{TransWord::getArabic($props->get(45)->name)}}
			<input type="file" class='add_ad_resume_file'>
			<input type='hidden' name = 'prop[45]' class='add_ad_resume_value'>
		</div>
		-->