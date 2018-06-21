<div class="add_ad_bottom">
    <div class="row add_ad_bottom__row">
        @if (isset($advert->address))
            <input required	type="text"
                   class="add_ad_field validate_check_val normalValidate js-add-ad-area"
                   name="address"
                   value="{{ $advert->address }}"  placeholder="{{ TransWord::getArabic('Building, Area', false) }}"/>
        @else
		     <input required	type="text"
			       class="add_ad_field validate_check_val normalValidate js-add-ad-area"
				   name="address"
				   placeholder="{{ TransWord::getArabic('Building, Area', false) }}"/>
        @endif
    </div>
    <div class="row add_ad_bottom__row">
        <div class="col-md-50 add_ad_bottom__col">
            {{ TransWord::getArabic('Contact number') }}<br />
            @if (isset($advert->order_number))
                @if ( $advert->order_number )
                    <input type="text" class="phone_uae add_ad_field validate_check_val normalValidate" value="{{ $advert->order_number }}" name='contact_number' />
                @elseif( $personal->phone )
                    <input type="text" class="phone_uae add_ad_field validate_check_val normalValidate" value="{{ $personal->phone }}" name='contact_number' />
                @endif
            @else
                <input type="text" class="phone_uae add_ad_field validate_check_val normalValidate" value="" name='contact_number' />
            @endif
        </div>
        <div class="col-md-50 ">
            {{ TransWord::getArabic('Email') }} <br />
            <input type="text" class="add_ad_field validate_check_val normalValidate" value="{{ Auth::user()->email }}" />
        </div>
    </div>
</div>
<br />
@if (Input::has('is_personal_cabinet'))
</div>

    <div class="add_ad_modal__body save_edit_step">

           @include('front.modal.add_edit.step_3')

        </div>



<!--<div  class='ad_dialog_edit_bottom save_edit_step' style="display: none;">

   <button class="ad_dialog_edit__cancel" type="button">{{ TransWord::getArabic('Cancel') }}</button>

  <button class="ad_dialog_edit__submit" type="submit">{{ TransWord::getArabic('Post your ad') }}</button>

</div>-->



<div class="row ad_dialog_edit_bottom save_edit_step" style="display: none;">
    <div class="col-md-45">
        <button class="add_ad_buttons__before js-edit_ad_step" data-step='2' data-before-step='3' type='button' style='    margin-top: 10px !important;'>
            <img src="/front/img/icons/link_before.png"  /> {{ TransWord::getArabic('Back') }}
        </button>
    </div>
    <div class="col-md-10">&nbsp;
    </div>
    <div class="col-md-45">
        <button class="add_ad_vip_block__submit close" type='submit'>
            <span class="icon-53" style="font-size: 17px; line-height: 1; position: relative; top: 0px; right: 11px;"></span> {{TransWord::getArabic('Post your ad')}}
        </button>
    </div>
</div>

<div class="add_ad_buttons add_ad_buttons_full first_edit_step">

    <button class="add_ad_buttons__next js-edit_ad_step" data-step='3' data-before-step='2'  type='button'>

        {{ TransWord::getArabic('Next') }}
        <img src="/front/img/icons/link_next.png" />
    </button>
</div>
</div>
<input class="ad_dialog_edit_photo__file" type="file" >
<input type='hidden' name='advert_id' value='{{ $advert->id }}'>
@else
<div class="add_ad_buttons add_ad_buttons_full">
    <button class="add_ad_buttons__before js-add_ad_step" data-step='1' data-before-step='2' type='button'>
        <img src="/front/img/icons/link_before.png"  /> {{ TransWord::getArabic('Back') }}
    </button>

    <button class="add_ad_buttons__next js-add_ad_step" data-step='3' data-before-step='2'  type='button'>
         {{ TransWord::getArabic('Next') }}
         <img src="/front/img/icons/link_next.png" />
    </button>
</div>
@endif
<input type='hidden' name='ad_main_photo' id='ad_main_photo' />

<script type="text/javascript">
jQuery(function($){
	$.mask.definitions['9'] = '';
	$.mask.definitions['n'] = '[0-9]';
   $(".phone_uae").mask("+ (971) nn nnn-nnnn");
});
</script>

@if (Input::has('is_personal_cabinet'))
</div>
</div>
</div>
</form>
@endif