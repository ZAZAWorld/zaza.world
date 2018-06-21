<div class="m-right-buttons">
    <button class="js-right-buttons js-open-inquiry inquiry shadow " 
			data-tooltip="{{TransWord::getArabic('Please',false)}} <a href='#login' class='js-login'>{{TransWord::getArabic('sign_in',false)}}</a> <br /> {{TransWord::getArabic('to use',false)}} <br /> 
							{{TransWord::getArabic('this function',false)}}">
        <span class="icon-33 inquiry__spec"> </span> <span class="inqtext">{{TransWord::getArabic('Inquiry',false)}}</span>
		@if (Inquiry::getUserListCount() > 0)
			<span class="inquiry__count">{{ Inquiry::getUserListCount() }}</span>
		@endif
    </button>
    <button class="js-right-buttons js_open_radio radio shadow">
        <span class="icon-41 radio__spec"> </span>
    </button>
    <button class="js-right-buttons adverts shadow {{ (Auth::check() && in_array(Auth::user()->user_type_id, array(2,3,4)) ?  'js-open-main-chat': 'js-tooltip-adverts' ) }}" data-tooltip="{{TransWord::getArabic('Please',false)}} <a href='#login' class='js-login'>{{TransWord::getArabic('sign_in',false)}}</a> <br /> {{TransWord::getArabic('to use',false)}} <br /> {{TransWord::getArabic('this function',false)}}">
        <span class="icon-11 adverts__spec"></span>
        @if (Auth::check() && in_array(Auth::user()->user_type_id, array(2,3,4)) && MsgDialog::getNewMessagesCount() > 0)
            <span class="adverts__count">{{ MsgDialog::getNewMessagesCount() }}</span>
        @endif
    </button>
    <button class="js-right-buttons js-open-maps maps shadow" data-tooltip="{{TransWord::getArabic('Please',false)}} <a href='#login' class='js-login'>{{TransWord::getArabic('sign_in',false)}}</a> <br /> {{TransWord::getArabic('to use',false)}} <br /> {{TransWord::getArabic('this function',false)}}">
        <span class="icon-39 maps__spec"> </span>
        <!--<span class="maps__count"> 6 </span>-->
    </button>
    <button class="js-right-buttons js-open-las-ad watchs shadow " data-tooltip="{{TransWord::getArabic('Please',false)}} <a href='#login' class='js-login'>{{TransWord::getArabic('sign_in',false)}}</a> <br /> {{TransWord::getArabic('to use',false)}} <br /> {{TransWord::getArabic('this function',false)}}">
        <span class="icon-10 watchs__spec"> </span>
        @if (AdvertView::getUserListCount() > 0)
            <span class="watchs__count">{{ AdvertView::getUserListCount() }} </span>
        @endif
    </button>
</div>

<div class="get_right_buttons">

</div>