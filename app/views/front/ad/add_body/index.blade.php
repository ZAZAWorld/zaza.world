<div class="add_ad_line">
    <div class="add_ad_line__title">
        {{TransWord::getArabic('Property for sale/residentioal 222')}}
    </div>
    <div class="add_ad_line__stroke">&nbsp;</div>
    <div class="add_ad_line__ball_1 add_ad_line__ball-check"><span>&#10004;</span></div>
    <div class="add_ad_line__ball_2 add_ad_line__ball-red">&nbsp;</div>
    <div class="add_ad_line__ball_3">&nbsp;</div>
</div>

<div class="add_ad_feilds">
    <div class="add_ad_feilds__line">
        <input type="text" class="add_ad_field" placeholder="{{TransWord::getArabic('Short title of your ad',false)}}" />
    </div>
    <div class="add_ad_feilds__line">
        <div class="add_ad_feilds__left">
            <div class='add_ad_feilds__upload'>
                <input class='add_ad_feilds__upload_file' type="file" name="img" accept="image/*"  />
                <img class='add_ad_feilds__upload_img' src="/front/img/icons/foto_blue.png" />
                <div class="add_ad_feilds__upload_text">
                    {{TransWord::getArabic('Click here to upload photo')}}<br />
                    {{TransWord::getArabic('jpg, png, bmp up to 2 mb')}}
                </div>
            </div>
        </div>
        <div class="add_ad_feilds__right">
            <div class="add_ad_feilds__line">
                <img class='add_ad_feilds__youtube' src="/front/img/icons/youtube_play.png"> {{TransWord::getArabic('Paste a link to your video from Youtube, to display in the add')}}
            </div>
            <div class="add_ad_feilds__line">
                <input type="text" class="add_ad_field" placeholder="{{TransWord::getArabic('Video url',false)}}" />
            </div>
        </div>
    </div>
    <div class="add_ad_feilds__line">
        <textarea class='add_ad_field' value="Description" onfocus="if(this.value=='Description'){this.value=''}" onblur="if(this.value==''){this.value='Description'}"></textarea>
    </div>
</div>
<div class="add_ad_price">
    <div class="add_ad_price_field">
        <img class="add_ad_price_field__icon" src="/front/img/icons/price.png" />
        <input type="text" class="add_ad_price_field__input idiot_price_format" value="Price" onfocus="if(this.value=='Price'){this.value=''}" onblur="if(this.value==''){this.value='Price'}" />
    </div>
    <div class="add_ad_price_dop">
        <div class="add_ad_price_dop__title"> {{TransWord::getArabic('not mandotary')}} </div>
        <div class="add_ad_price_dop__block">
            <input type="checkbox" class="add_ad_price_dop__item"> {{TransWord::getArabic('Negotiable')}}
        </div>
        <div class="add_ad_price_dop__block">
            <input type="checkbox" class="add_ad_price_dop__item"> {{TransWord::getArabic('Exchange')}}
        </div>
    </div>
</div>
