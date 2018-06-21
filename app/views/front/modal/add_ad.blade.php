@section('js')
	@parent
	{{ HTML::script('front/js/add_ad.js') }}
@endsection

{{ Form::open(array('url'=>action("AdController@postAdd"), 'method' => 'post', 'role'=>'form', 'id'=>'form_send_ad', 'files'=>true)) }}
<div class="add_ad_modal">
    <div class="add_ad_modal__content shadow">
		<!-------- add ad steps titles------>
        <span class="add_ad_modal__steps">
            <span class="step_1 active js-add-ad-step" data-id='1'> {{TransWord::getArabic('Step 1')}}</span>
            <span class="step_2 js-add-ad-step" data-id='2'> {{TransWord::getArabic('Step 2')}}</span>
            <span class="step_3 js-add-ad-step" data-id='3'> {{TransWord::getArabic('Step 3')}}</span>
        </span>
        <span class="add_ad_modal__close"></span>
		
		<!--------- step 1 -------->
        <div class="add_ad_modal__body active" id='add_ad_tab_1'>
			@include('front.modal.add_ad.step_1')
        </div>
		
		<!--------- step 2 (generate from ajax) -------->
        <div class="add_ad_modal__body" id='add_ad_tab_2'>

        </div>
		
		<!--------- step 3 -------->
        <div class="add_ad_modal__body" id='add_ad_tab_3'>
			@include('front.modal.add_ad.step_3')
        </div>
    </div>
</div>

{{ Form::close() }}
