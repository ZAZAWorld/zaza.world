{{ Form::open(array('url'=>action('PersonController@postForgetPassword'), 'method' => 'post', 'role'=>'form', 'id'=>'js-forget_password_form')) }}
<div class="f_pass_modal">
    <div class="f_pass_modal__content shadow">
        <span class="f_pass_modal__close"></span>
        <div class="f_pass_modal__body ">
            <input class="b_req_input js-forget_password_email" required="required" type="email" name='email' placeholder="{{TransWord::getArabic('Please, type your email',false)}}" />
			<div class="g-recaptcha" data-sitekey="6LdjrhcUAAAAABXRNi_-J-QJgI7rcWPEazIjxyHV"></div>
            <button type='submit' class="b_f_password js-forget_password_submit">
                {{TransWord::getArabic('Send password')}}
            </button>
        </div>
    </div>
</div>
{{ Form::close() }}
