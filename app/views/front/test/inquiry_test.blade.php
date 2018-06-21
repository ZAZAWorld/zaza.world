@extends('front.layout')



@section('content')

    @include('front.index.slider')

	@include('front.index.company-icons')
    @include('front.index.advert-icons')
    
    @include('front.index.footer-search')
    @include('front.include.right-buttons')

	<div class='inquiry_block active'>
		<div class='inquiry_body'>
			<div class='inquiry_item'>
				<h3 class='inquiry_item__title'>Some title bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla</h3>
				<div class='inquiry_item__toggle open'>
					<div class='inquiry_item__note'>
						Some text bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla 
						bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla
					</div>
					<div class='inquiry_item__footer'>
						<div class='inquiry_item__user_photo_block'>
							<img class='inquiry_item__user_photo' src='/upload/company/1474457037_Tulips.jpg' />
						</div>
						<div class='inquiry_item__user_contact_block'>
							<span class='icon-22 inquiry_item__icon'></span> +7 702 498 2488 <br/>
							<span class='icon-20 inquiry_item__icon'></span> hmurich@mail.ru
						</div>
					</div>
				</div>
				<div class='inquiry_item__button_block'>
					<span class='inquiry_item__button_icon'> 
						<img class='inquiry_item__button_icon_img' src='/images/c-post__more--icon.png'>
					</span>
				</div>
			</div>
			
			<div class='inquiry_item'>
				<h3 class='inquiry_item__title'>Some title bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla</h3>
				<div class='inquiry_item__toggle '>
					<div class='inquiry_item__note'>
						Some text bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla 
						bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla
					</div>
					<div class='inquiry_item__footer'>
						<div class='inquiry_item__user_photo_block'>
							<img class='inquiry_item__user_photo' src='/upload/company/1474457037_Tulips.jpg' />
						</div>
						<div class='inquiry_item__user_contact_block'>
							<span class='icon-22 inquiry_item__icon'></span> +7 702 498 2488 <br/>
							<span class='icon-20 inquiry_item__icon'></span> hmurich@mail.ru
						</div>
					</div>
				</div>
				<div class='inquiry_item__button_block'>
					<span class='inquiry_item__button_icon'> 
						<img class='inquiry_item__button_icon_img' src='/images/c-post__more--icon-up.png'>
					</span>
				</div>
			</div>
			
			<div class='inquiry_item'>
				<h3 class='inquiry_item__title'>Some title bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla</h3>
				<div class='inquiry_item__toggle '>
					<div class='inquiry_item__note'>
						Some text bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla 
						bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla bla bla bla vbla bla bla vbla bla bla vbla bla bla vbla bla
					</div>
					<div class='inquiry_item__footer'>
						<div class='inquiry_item__user_photo_block'>
							<img class='inquiry_item__user_photo' src='/upload/company/1474457037_Tulips.jpg' />
						</div>
						<div class='inquiry_item__user_contact_block'>
							<span class='icon-22 inquiry_item__icon'></span> +7 702 498 2488 <br/>
							<span class='icon-20 inquiry_item__icon'></span> hmurich@mail.ru
						</div>
					</div>
				</div>
				<div class='inquiry_item__button_block'>
					<span class='inquiry_item__button_icon'> 
						<img class='inquiry_item__button_icon_img' src='/images/c-post__more--icon-up.png'>
					</span>
				</div>
			</div>
			
		</div>
		
		<div class='inquiry_footer'>
			<div class='inquiry_footer_field'>
				<textarea name='note' class='inquiry__input' placeholder='Write your inquire here (max 120 symbols)'> </textarea>
			</div>
			<div class='inquiry_footer_field'>
				<span class='inquiry_footer_field__title'>Send to</span>
				<select name='some_name' class='inquiry__input'>
					<option>Val</option>
					<option>Val 2</option>
					<option>Val 3</option>
				</select>
				<select name='some_name' class='inquiry__input'>
					<option>Val</option>
					<option>Val 2</option>
					<option>Val 3</option>
				</select>
			</div>
		</div>
	</div>

@stop
