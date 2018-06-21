<div class="add_ad_line">
    <div class="add_ad_line__title">
        {{TransWord::getArabic('Auto')}} / {{TransWord::getArabic('Auto Sale')}} / {{TransWord::getArabic('Trucks')}}
    </div>

    <div class="add_ad_line__stroke">&nbsp;</div>
    <div class="add_ad_line__ball_1 add_ad_line__ball-check"><span>&#10004;</span></div>
    <div class="add_ad_line__ball_2 add_ad_line__ball-red">&nbsp;</div>
    <div class="add_ad_line__ball_3">&nbsp;</div>
</div>


<div class="add_ad_feilds">
	<div class="add_ad_feilds__line">
		<div class="col-md-15">
            <img class="add_ad_car_icon" src="/front/img/car-icon/chevrolet.jpg" />
		</div>
        <div class="col-md-85">
            <select name='car_type' class="add_ad_field">
                <option value="">{{TransWord::getArabic('Chevrolet')}}</option>
                <option value="">{{TransWord::getArabic('Wlkswagen')}}</option>
            </select>
		</div>
	</div>
    <div class="add_ad_feilds__line">
        <div class="col-md-75">
            <select name='car_type' class="add_ad_field">
                <option value="">{{TransWord::getArabic('Chevrolet')}}</option>
                <option value="">{{TransWord::getArabic('Wlkswagen')}}</option>
            </select>
        </div>
        <div class="col-md-25">
            <select name='car_type' class="add_ad_field">
                <option value="">{{TransWord::getArabic('Chevrolet')}}</option>
                <option value="">{{TransWord::getArabic('Wlkswagen')}}</option>
            </select>
        </div>
    </div>
    <div class="add_ad_feilds__line">
        <div class="add_ad_feilds__left">
            <div class='add_ad_feilds__upload'>
                <input class='add_ad_feilds__upload_file' type="file" name="img"  />
                <img class='add_ad_feilds__upload_img' src="/front/img/icons/foto_blue.png" />
                <div class="add_ad_feilds__upload_text">
                    {{TransWord::getArabic('Click here to upload photo')}}<br />
                    {{TransWord::getArabic('jpg, png, bmp, pdf up to 2 mb')}}
                </div>
            </div>
        </div>
        <div class="add_ad_feilds__right">
            <div class="add_ad_feilds__line">
                <img class='add_ad_feilds__youtube' src="/front/img/icons/youtube_play.png"> {{TransWord::getArabic('Paste a link to your video from youtube. to display in the add')}}
            </div>
            <div class="add_ad_feilds__line">
                <input type="text" class="add_ad_field" placeholder="{{TransWord::getArabic('Video url',false)}}" />
            </div>
        </div>
    </div>
    <div class="add_ad_feilds__line">
        <textarea class='add_ad_field' rows="5" placeholder="{{TransWord::getArabic('Description',false)}}"> </textarea>
    </div>
</div>

<div class="add_ad_price">
    <div class="add_ad_price_field">
        <span class="icon-38 add_ad_price_field__img"></span>
        <input type="text" class="add_ad_price_field__input"   />
    </div>
    <div class="add_ad_price_dop">
        <div class="add_ad_price_dop__block">
            <input type="checkbox" class="add_ad_price_dop__item"> {{TransWord::getArabic('Negotiable')}}
            <input type="checkbox" class="add_ad_price_dop__item"> {{TransWord::getArabic('Exchange')}}
            <input type="checkbox" class="add_ad_price_dop__item"> {{TransWord::getArabic('Free')}}
        </div>
    </div>
</div>

<div class="add_ad_option add_ad_option_all-border">
    <div class="add_ad_option__line">
        <div class="col-md-45">
            <span class="icon-88 add_ad_option__icon"></span>
            <select name='car_type' class="add_ad_option__inline">
                <option value="">{{TransWord::getArabic('Chevrolet')}}</option>
                <option value="">{{TransWord::getArabic('Wlkswagen')}}</option>
            </select>
        </div>
        <div class="col-md-45 col-md-offset-10">
            <span class="icon-51 add_ad_option__icon"></span>
            <input type="text" class="add_ad_option__inline" name='hourse_forse' />
        </div>
    </div>
    <div class="add_ad_option__line">
        <div class="col-md-45">
            <span class="icon-46 add_ad_option__icon"></span>
            <select name='car_type' class="add_ad_option__inline">
                <option value="">{{TransWord::getArabic('Chevrolet')}}</option>
                <option value="">{{TransWord::getArabic('Wlkswagen')}}</option>
            </select>
        </div>
        <div class="col-md-45 col-md-offset-10">
            <span class="icon-47 add_ad_option__icon"></span>
            <input type="text" class="add_ad_option__inline" name='hourse_forse' />
        </div>
    </div>
    <div class="add_ad_option__line">
        <div class="col-md-45">
            <span class="icon-13 add_ad_option__icon"></span>
            <input name='adf' type="radio" > <label class='add_ad_option__label' for='adf'> {{TransWord::getArabic('4WD')}} </label>
            <input name='adf' type="radio" > <label class='add_ad_option__label' for='adf'> {{TransWord::getArabic('RWD')}} </label>
            <input name='adf' type="radio" > <label class='add_ad_option__label' for='adf'> {{TransWord::getArabic('FWD')}}</label>
        </div>
        <div class="col-md-45 col-md-offset-10">
            <span class="icon-50 add_ad_option__icon"></span>
            <input type="text" class="add_ad_option__inline" name='hourse_forse' />
        </div>
    </div>
    <div class="add_ad_option__line">
        <div class="col-md-45">
            <span class="icon-68 add_ad_option__icon"></span>
            <select name='car_type' class="add_ad_option__inline">
                <option value="">{{TransWord::getArabic('Chevrolet')}}</option>
                <option value="">{{TransWord::getArabic('Wlkswagen')}}</option>
            </select>
        </div>
        <div class="col-md-45 col-md-offset-10">
            <span class="icon-72 add_ad_option__icon"></span>
            <input type="text" class="add_ad_option__inline" name='hourse_forse' />
        </div>
    </div>
    <div class="add_ad_option__line">
        <div class="col-md-45">
            <span class="icon-70 add_ad_option__icon"></span>
            <select name='car_type' class="add_ad_option__inline">
                <option value="">{{TransWord::getArabic('Chevrolet')}}</option>
                <option value="">{{TransWord::getArabic('Wlkswagen')}}</option>
            </select>
        </div>
        <div class="col-md-45 col-md-offset-10">
            <span class="icon-71 add_ad_option__icon"></span>
            <input type="text" class="add_ad_option__inline" name='hourse_forse' />
        </div>
    </div>


</div>

<div class="add_ad_bottom">
    <div class="row add_ad_bottom__row">
        {{  Form::select('bilding_area', array(Null=>'') + SysCity::where('country_id', 1)->lists('name', 'id'), null, array('class'=>'add_ad_field')) }}
    </div>
    <div class="row add_ad_bottom__row">
        <div class="col-md-50 add_ad_bottom__col">
            {{TransWord::getArabic('Contact number')}} <br />
            <input type="text" class="add_ad_field"  />
        </div>
        <div class="col-md-50 ">
            {{TransWord::getArabic('Email')}} <br />
            <input type="text" class="add_ad_field"  />
        </div>
    </div>
</div>

<div class="add_ad_buttons add_ad_buttons_full">
    <button class="add_ad_buttons__before js-add_ad_step" data-step='1' data-before-step='2'>
        <img src="/front/img/icons/link_before.png"  /> {{TransWord::getArabic('Back')}}
    </button>

    <button class="add_ad_buttons__next js-add_ad_step" data-step='3' data-before-step='2'>
         {{TransWord::getArabic('Next')}}
         <img src="/front/img/icons/link_next.png" />
    </button>
</div>

<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
        google.maps.event.addListener(places, 'place_changed', function () {

        });
    });
</script>