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

@if (!empty($photos) && count($photos)>0)
<div class='row ad_dialog_edit__row'>
    <div class='col-md-100'>
        <div class='row ad_dialog_edit_photo__list'>
            @foreach ($photos as $p)
            <div class='ad_dialog_edit_photo__square'>
                <img src="{{ $p->file }}" class="ad_dialog_edit_photo__image">
                <input type='hidden' name='ad_img[]' value='{{ $p->file }}' accept="image/*">
                <i class='delete ad_dialog_edit_photo__del_link'></i>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<div class="add_ad_feilds__right">
	<div class="add_ad_feilds__line" style="font-size:12px;">
		<img class='add_ad_feilds__youtube' src="/front/img/icons/youtube_play.png"> {{TransWord::getArabic('Paste a link to your video from Youtube, <br />to display in the ad')}}
	</div>
	<div class="add_ad_feilds__line top27">
		<input name='youtube_href' value='{{ ((!empty($advert) && $advert->youtube) ? "https://youtu.be/".$advert->youtube : null) }}'  type="text" class="add_ad_field" placeholder="{{TransWord::getArabic('Video url',false)}}" />
	</div>
</div>