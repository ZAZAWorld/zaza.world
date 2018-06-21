@extends('front.layout')
@section('content')

    @include('front.index.slider')

	@include('front.index.company-icons')
    @include('front.index.advert-icons')
    
    @include('front.index.footer-search')
    @include('front.include.right-buttons')
	
	
	{{ Form::open(array('url'=>action("PersonController@postRegistration"), 'method' => 'post', 'role'=>'form', 'id'=>'reg_simple_user_form')) }}
	<div class='reg_simple_user shadow open'>
		<h3>Create personal account</h3>
		<div class="row">
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
			<div class="col-md-60 col-md-offset-5">
				<div class="row">
					<div class="col-md-90">
						<input class="b_req_input" required="required" type="text" placeholder="Full name" name="full_name">
					</div>
				</div>
				<div class="row">
					<div class="col-md-90 ">
						<input class="b_req_input" required="required" type="text" placeholder="Location" name="location">
					</div>
				</div>
				<div class="row">
					<div class="col-md-90">
						<input class="b_req_input" required="required" type="tel" placeholder="Phone" name="phone">
					</div>
				</div>
				<div class="row">
					<div class="col-md-90">
						<input class="b_req_input" required="required" type="tel" placeholder="Mobile" name="mobile">
					</div>
				</div>
				<div class="row">
					<div class="col-md-90">
						<textarea class='b_req_input' required="required" placeholder="About me" name="about"> </textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-90">
						<input class="b_req_input" required="required" type="email" placeholder="Email" name="email">
					</div>
				</div>
				<div class="row">
					<div class="col-md-90">
						<input class="b_req_input text_blue" type="password" required="required" placeholder="Password" name="password">
					</div>
				</div>
				<div class="row">
					<div class="col-md-90">
						<input class="b_req_input text_blue" type="password" required="required" placeholder="Repeat password" name="re_password">
					</div>
				</div>
			</div>
		</div>

		<div class="req_com_modal__footer">
			<button class="b_com_back js-open-reg_simple_user_form">Close</button>
			
			<input class="b_com_next" type="submit" value="Send">
		</div>
	</div>
	{{ Form::close() }}
	
@stop
