@extends('front.layout')
@section('content')

    @include('front.index.slider')

	@include('front.index.company-icons')
    @include('front.index.advert-icons')
    
    @include('front.index.footer-search')
    @include('front.include.right-buttons')
	
	<div class='last_ad_block shadow active'>
		<div class='last_ad_item'>
			<a href='#add' class='last_ad_item__link'>
				<h3 class='last_ad_item__title'>Some title bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla</h3>
			</a>
			<div class='last_ad_item__toggle'>
				<div class='last_ad_item__note'>
					Some text bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla 
					bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla
				</div>
				<div class='last_ad_item__footer'>
					<div class='last_ad_item__user_photo_block'>
						<img class='last_ad_item__user_photo' src='/upload/company/1474457037_Tulips.jpg' />
					</div>
					<div class='last_ad_item__user_contact_block'>
						<span class='icon-22 last_ad_item__icon'></span> +7 702 498 2488 <br/>
						<span class='icon-20 last_ad_item__icon'></span> hmurich@mail.ru
					</div>
				</div>
			</div>
			<div class="last_ad_item__button_block">
				<span class="last_ad_item__button_icon"> 
					<img class="last_ad_item__button_icon_img" src="/images/c-post__more--icon.png">
				</span>
			</div>
		</div>
		
	</div>
	
@stop
