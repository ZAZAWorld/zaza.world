<div class="add_ad_feilds__left js-add-ad-upload_1">
	<div class='add_ad_feilds__upload'>
		<input class='add_ad_feilds__upload_file' type="file" name="img" accept="image/*" />
		<img class='add_ad_feilds__upload_img' src="/front/img/icons/foto_blue.png" />
		<div class="add_ad_feilds__upload_text">
			{{ TransWord::getArabic('Click here to upload') }}<br />
			{{ TransWord::getArabic('photo (max.20)') }}
		</div>
	</div>
</div>
<div class="add_ad_feilds__left js-add-ad-upload_other" style='display:none'>
	<div class='add_ad_feilds__upload '>
		<input class='add_ad_feilds__upload_file' type="file" name="img" accept="image/*" />
		<img class='add_ad_feilds__upload_img' src="/front/img/icons/foto_blue.png" />
		<div class="add_ad_feilds__upload_text">
			{{TransWord::getArabic('Add more photos') }}<br />
			(<span class='js-add-ad-upload_counter'>{{TransWord::getArabic('max. 20') }}</span>)
		</div>
	</div>
</div>