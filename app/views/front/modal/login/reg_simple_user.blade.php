
<div class='reg_simple_user'>
	<div class='reg_simple_user__content shadow'>
	<span class="reg_simple_user__close" style='z-index: 100;'></span>
		{{ Form::open(array('url'=>action("PersonController@postRegistration"), 'method' => 'post' , 'id'=>'reg_simple_user_form', 'class'=>'validate-form')) }}
		<h3>{{TransWord::getArabic('Create personal account',false)}}</h3>
		<div class="row">
			<!--
			<div class="col-md-35">
				<div class="youtube_block_img">
					<img src="/front/img/youtube_bg.png" class="youtube_block_img__bg">
					<img src="/front/img/icons/play_icon.png" class="youtube_block_img__play">
				</div>
				<a href="#link" class="link_yout_channel">
					Whatch all tutorial videos <br>
					in our youtube channel
					<img src="/front/img/icons/youtube_play.png">
				</a>
				<div class="upload_logo">
					<input type="hidden" class="upload_logo__hidden" name="logo">
					<input class="upload_logo__file" type="file" name="img">
					<div class="upload_logo__circle"> Upload company logo (jpg, bmp, png up to 1mb)</div>
				</div>
			</div>
			-->
			<div class="col-md-100">
				<div class="row">
					<div class="col-md-100">
						<input class="b_req_input normalValidate" required="required" type="text" placeholder="{{TransWord::getArabic('Full name',false)}}" name="full_name">
					</div>
				</div>
                <div class="row">
                    <div class="col-md-100">
                        <input class="b_req_input   js_check_user_isset_phone_2222" required="required" type="tel" placeholder="Mobile Number (ex. +971xxxxxxxxxx)" name="phone" pattern="[0-9]{12,}">
                    </div>
                </div>
				<div class="row">
					<div class="col-md-100">
						<input class="b_req_input   js_check_user_isset_mail_2222" type="email" placeholder="{{TransWord::getArabic('Email',false)}}" name="email">
					</div>
				</div>
				<div class="row">
					<div class="col-md-100">
						<input class="b_req_input text_blue min6symbolValidate" type="password" required="required" placeholder="{{TransWord::getArabic('Password',false)}}" name="password" id='password'>
					</div>
				</div>
				<div class="row">
					<div class="col-md-100">
						<input class="b_req_input text_blue min6symbolValidate" type="password" required="required" placeholder="{{TransWord::getArabic('Repeat password',false)}}" name="re_password">
					</div>
				</div>
                <div class="row" style="display: none;" id="activation_code_row">
                    <div class="col-md-100">
                        <input class="b_req_input text_blue" type="input" placeholder="Please enter confirmation code here" id="activation_code" name="activation_code">
						The confirmation code has been forwarded to your mobile number. 
                    </div>
                </div>
			</div>
		</div>

		<div class="req_com_modal__footer" style='position: relative;'>
			<div style='width: 100%; float: left;'>
				<p style='font-size: 11px; display: block;  width: 50%;  float: right;' required="required">
					<input type="checkbox" class='normalValidate js-check-regist-company-agree' name='agree' value='1'> 
					<span>{{TransWord::getArabic('I have read',false)}} <a href='#terms' class='js_call_modal_terms' style='color: #15499f;'>{{TransWord::getArabic('Terms & Conditions',false)}}</a> {{TransWord::getArabic('and agree to abide by them',false)}}.</span>
				</p>
			</div>
			
			<button class="b_com_back js-open-reg_simple_user_form" type='button'>{{TransWord::getArabic('Close',false)}}</button>
			
			
			<input class="b_com_next" type="submit" value="{{TransWord::getArabic('Create account',false)}}">
		</div>
		{{ Form::close() }}
	</div>
</div>
