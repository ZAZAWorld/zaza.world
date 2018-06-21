@if (!$errors->isEmpty())
	<div class='mess_block false shadow'>
		<div class='mess_title'>{{TransWord::getArabic('Error',false)}}</div>
		<div class='mess_body'>
			@foreach ($errors->all(':message') as $mess)
				<p>{{TransWord::getArabic($mess,false)}}</p>
			@endforeach
		</div>
		<div class='mess_footer'>
			<button class="mess_footer__button shadow">{{TransWord::getArabic('Close',false)}}</button>
		</div>
	</div>
@endif

@if (Session::has('error'))
	<div class='mess_block false shadow' style='{{ (Session::get('error') == 'Data saved successfully' ? 'display: none' : null) }}'>
		<div class='mess_title'>{{TransWord::getArabic('Error',false)}}</div>
		<div class='mess_body' >
			{{ Session::get('error') }}
		</div>
		<div class='mess_footer'>
			<button class="mess_footer__button shadow">{{TransWord::getArabic('Close',false)}}</button>
		</div>
	</div>
@endif

@if (Session::has('success'))
	<div class='mess_block ok shadow'>
		<div class='mess_title'></div>
		<div class='mess_body'>
			{{TransWord::getArabic(Session::get('success'),false)}}
		</div>
		<div class='mess_footer'>
			<button class="mess_footer__button shadow">{{TransWord::getArabic('Close',false)}}</button>
		</div>
	</div>
@endif

@if (Session::has('success2'))
	<div class='mess_block ok shadow'>
		<div class='mess_title'>{{TransWord::getArabic('Congratulations!',false)}}</div>
		<div class='mess_body'>
			{{TransWord::getArabic(Session::get('success2'),false)}}
		</div>
		<div class='mess_footer'>
			<button class="mess_footer__button shadow">{{TransWord::getArabic('Close',false)}}</button>
		</div>
	</div>
@endif

@if (Session::has('setmailfbook'))
	<div class='fbook_login_modal open'>
		<div class='mess_title_fbook'>{{TransWord::getArabic('Login with Facebook',false)}}</div>
		<div class="fbooklogin_modal__content shadow">
		<div class='mess_body_fbook'>
			{{TransWord::getArabic(Session::get('setmailfbook'),false)}}
		</div>
		<form method="post" class='b_req_login_form fbook validate-form' enctype="multipart/form-data" action="{{ action('PersonController@loginWithFacebookWithoutMail') }}">
			<input name='email' class="b_req_input fbook_email_input" required="required" type="email" placeholder="{{TransWord::getArabic('example@example.com',false)}}" />
		</form>
		<div class='mess_footer_fbook'>
			<button class="mess_footer__button_fbook_login shadow" type="submit">{{TransWord::getArabic('Log in',false)}}</button>
		</div>
		<button class="mess_footer__button_fbook_cancel shadow" type="submit" onclick="close()">{{TransWord::getArabic('Close',false)}}</button>
		</div>
	</div>
@endif