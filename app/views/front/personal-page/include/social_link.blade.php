@if ($social->facebook)
	<div class="p_p_social">
		<img src='/front/images/c-social-fb.png' />
		<span class="p_p_social__text">
			<a href='https://www.facebook.com/{{ $social->facebook }}'>{{ ($social ? $social->facebook : 'no text' ) }} </a>
		</span>
	</div>
@endif

@if ($social->instagram)
	<div class="p_p_social">
		<img src='/front/img/icons/instagram.png' />
		<span class="p_p_social__text">
			<a href='https://www.instagram.com/{{ $social->instagram }}'>{{ ($social ? $social->instagram : 'no text' ) }}</a>
		</span>
	</div>
@endif
@if ($social->skype)
	<div class="p_p_social">
		<img src='/front/img/icons/skype.png' />
		<span class="p_p_social__text">
			<a href='skype:{{ $social->skype }}'>{{ ($social ? $social->skype : 'no text' ) }}</a>
		</span>
	</div>
@endif