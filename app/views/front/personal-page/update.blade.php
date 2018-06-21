@extends('front.layout')
@section('js')
	@parent
	{{ HTML::script('front/js/autoresize.jquery.js') }}
	{{ HTML::script('front/js/cabinet.js') }}
	{{ HTML::script('front/js/blog.js') }}
@endsection

@section('content')
<script>
    window.isFront = true;
</script>
<div class="c-restourant__topstatus ">
	<div class="c-topstatus">
		<div class="l-container">
			<div class="l-grid-noGutter_sm-1 wrapper_header">
				<!---- Person name update-------->
				<div>
					<div class="c-description p_title__name">
						<input type="text" class="form_update_input" value="{{ $personal->full_name }}" disabled='disabled'  name="full_name" data-id='full_name' data-type='person' data-before=''>
							<span class="form_update_ok hide" data-id='full_name'>
								&#10004;
							</span>
							<span class="form_update_cancel hide" data-id='full_name'>
								&#10006;
							</span>
							<span class="form_update_pencil " data-id='full_name'>
								<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
							</span>
 
					</div>
				</div>
				
				<!----- setting link --->
				<div class="buttons_header_personal_edit">
					<div class="l-grid-noGutter-middle_sm-12 person_l_grid">
						<div class="c-settings personal_page_settings">
							<a href="{{ action('PersonController@getCabinet') }}">
								<div style="background:url('/front/img/icons/icon-ok.png') no-repeat 0 0; padding:0 0 5px 25px;">{{TransWord::getArabic('Save changes',false)}}</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>       
</div>
<div class="p_personal">
	<div class="p_personal__left">
		<div class="p_personal__left_block">
			<!---- Person logo update.-------->
			@if( $personal->photo != '')
				<div class="p_p_logo js_logo" style="background:url('{{ $personal->photo }}') no-repeat center center; background-size:cover;">
                </div>
			@else 
				<div class="p_p_logo js_logo" style="background:url('/images/no_name.png') no-repeat center; background-size: cover;">
				</div>
			@endif
			
			<span class="logo_tooltip">
				<img src="/front/img/icons/pencil.png"  />
			</span>
			<div class='logo_tooltip_block'>
				<form id="logo_tooltip_block__form" method="post" enctype="multipart/form-data">
					<input type="hidden" name="type" value="photo" />
					<input type="hidden" name="name" value="photo" />
					<input class="logo_tooltip_block__file" type="file" name="value"/>
					<span class="logo_tooltip_block__update">{{TransWord::getArabic('Edit')}}</span>​ <br />
					<span class="logo_tooltip_block__delete">{{TransWord::getArabic('Delete')}}</span>​ <br />
				</form>
			</div>

			<!---- Person location update.-------->
			<div class="p_p_location">
				<img src="/front/img/icons/location_blue.png">
				<input type="text" class="form_update_input" value="{{ $user->location }}" disabled='disabled'  name="location" data-id='location' data-type='user' data-before='' placeholder="{{TransWord::getArabic('Add your location',false)}}">
				<span class="form_update_ok hide" data-id='location'>
					&#10004;
				</span>
				<span class="form_update_cancel hide" data-id='location'>
					&#10006;
				</span>
				<span class="form_update_pencil " data-id='location'>
					<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
				</span>
			</div>
		</div>
		
		<!---- Person about update.-------->
		<div class="p_personal__left_block">
			<div class="p_p_about">
				<span class="p_p_about__title"> {{TransWord::getArabic('About me')}}
					<span class="form_update_pencil " data-id='about'>
						<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
					</span>
				</span>
				<textarea class="form_update_input" disabled='disabled'  name="about" data-id='about' data-type='person' data-before=''>{{$personal->about}}</textarea>
				<span class="form_update_ok hide" data-id='about'>
					&#10004;
				</span>
				<span class="form_update_cancel hide" data-id='about'>
					&#10006;
				</span>
			</div>
		</div>
		
		<!---- Person phones update.-------->
		<div class="p_personal__left_block">
			<div class="p_p_phones">
				<img src='/front/img/icons/photo.png' />
					<input type="text" class="phone_uae form_update_input" value="{{ $personal->phone }}" placeholder="{{TransWord::getArabic('Add your phone',false)}}" disabled='disabled'  name="phone" data-id='phone' data-type='person' data-before=''>
					<span class="form_update_ok hide" data-id='phone'>
						&#10004;
					</span>
					<span class="form_update_cancel hide" data-id='phone'>
						&#10006;
					</span>
					<span class="form_update_pencil " data-id='phone'>
						<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
					</span>
				<br/>
				<img src='/front/img/icons/mobile.png' />
					<input type="text" class="phone_uae form_update_input" value="{{ $personal->mobile }}" placeholder="{{TransWord::getArabic('Add your mobile',false)}}" disabled='disabled'  name="mobile" data-id='mobile' data-type='person' data-before=''>
					<span class="form_update_ok hide" data-id='mobile'>
						&#10004;
					</span>
					<span class="form_update_cancel hide" data-id='mobile'>
						&#10006;
					</span>
					<span class="form_update_pencil " data-id='mobile'>
						<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
					</span>
				<br/>
				<img src='/front/images/c-sidebar__mail.png' width="12px" />
					<input type="email" class="form_update_input" value="{{ $user->email }}" placeholder="{{TransWord::getArabic('Add your email',false)}}" disabled='disabled'  name="email" data-id='email' data-type='user' data-before=''>
					<span class="form_update_ok hide" data-id='email'>
						&#10004;
					</span>
					<span class="form_update_cancel hide" data-id='email'>
						&#10006;
					</span>
					<span class="form_update_pencil " data-id='email'>
						<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
					</span>
				<br/>
			</div>
		</div>
		
		<!---- Person social update.-------->
		<div class="p_personal__left_block">
			<div class="p_p_social">
				<!---- Person facebook update.-------->
				<img src='/front/images/c-social-fb.png' />
					<span class="p_p_social__text">
						<input type="text" class="form_update_input" value="{{ $social->facebook }}" placeholder="{{TransWord::getArabic('Add your facebook',false)}}" disabled='disabled'  name="facebook" data-id='facebook' data-type='social' data-before=''>
						<span class="form_update_ok hide" data-id='facebook'>
							&#10004;
						</span>
						<span class="form_update_cancel hide" data-id='facebook'>
							&#10006;
						</span>
						<span class="form_update_pencil " data-id='facebook'>
							<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
						</span>
					</span>
				<br/>
				<!---- Person instagramm update.-------->
				<img src='/front/images/c-social-in.png' />
					<span class="p_p_social__text">
						<input type="text" class="form_update_input" value="{{ $social->instagram }}" placeholder="{{TransWord::getArabic('Add your instagram',false)}}" disabled='disabled'  name="instagram" data-id='instagram' data-type='social' data-before=''>
						<span class="form_update_ok hide" data-id='instagram'>
							&#10004;
						</span>
						<span class="form_update_cancel hide" data-id='instagram'>
							&#10006;
						</span>
						<span class="form_update_pencil " data-id='instagram'>
							<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
						</span>
					</span>
				<br/>
				<!---- Person twitter update.-------->
				<img src='/front/img/icons/skype.png' />
					<span class="p_p_social__text">
						<input type="text" class="form_update_input" value="{{ $social->skype }}" placeholder="{{TransWord::getArabic('Add your skype',false)}}" disabled='disabled'  name="skype" data-id='skype' data-type='social' data-before=''>
						<span class="form_update_ok hide" data-id='skype'>
							&#10004;
						</span>
						<span class="form_update_cancel hide" data-id='skype'>
							&#10006;
						</span>
						<span class="form_update_pencil " data-id='skype'>
							<img src="/front/img/icons/pencil.png" class="form_update_pencil__image" />
						</span>
					</span>
				<br/>
			</div>
		</div>
		
		<!---- Person change password block.-------->
		<div class="p_personal__left_block">
			<h3 class='person_change_pass_title'>{{TransWord::getArabic('Set new password')}}</h3>
			<form action='{{ action("PersonController@postChangePassword") }}' method='POST' class='person_change_pass_form'>
				<div class='row'>
					<input type='password' name='old_password' class='person_change_pass_input' required  placeholder="{{TransWord::getArabic('Enter old password',false)}}"/>
				</div>
				<div class='row'>
					<input type='password' name='new_password' class='person_change_pass_input' required placeholder="{{TransWord::getArabic('Enter new password',false)}}"/>
				</div>
				<div class='row'>
					<input type='password' name='repeat_new_password' class='person_change_pass_input' required placeholder="{{TransWord::getArabic('Repeat new password',false)}}"/>
				</div>
				<div class='row'>
					<button type='button' class='person_change_pass_cancel' >
						{{TransWord::getArabic('Cancel',false)}}
					</button>
					<button type='submit' class='person_change_pass_save'>
						{{TransWord::getArabic('Apply changes',false)}}
					</button>
				</div>
			</form>
		</div>
		
		<!---- Company likes.-------->
		<div class="p_personal__left_tab">
			@include('front.personal-page.include.company_likes')
		</div>
	</div>
	
	<!---- Blog.-------->
	<div class="p_personal__content">
	
		<!---- Blog interest. -------->
		<div class="p_p_interest_block">
			@include('front.personal-page.include.blog_interest_edit')
		</div>
		
		<!---- Blog add article. -------->
		@include('front.personal-page.include.blog_add_article')

		<!---- Blog articles. -------->
		<div class="p_p_contents">
			@forelse ($blogs as $b)
				@if ($b->user_id == Auth::user()->id)
					@include('front.personal-page.include.blog_edit')
				@else 
					@include('front.personal-page.include.blog')
				@endif
			@empty
				<p></p>
			@endforelse
		</div>
		
	</div>
</div>

<script type="text/javascript">
jQuery(function($){
	$.mask.definitions['9'] = '';
	$.mask.definitions['n'] = '[0-9]';
    $(".phone_uae").mask("+ (971) nn nnn-nnnn");
});
</script>

@stop
