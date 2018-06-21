@if (Auth::check())
	<div class='inquiry_block shadow'>
		<div class='inquiry_body js-reviews-scroll'>
			@if(Inquiry::getUserList())
				@foreach (Inquiry::getUserList() as $i) 
					<div class='inquiry_item'>
						<h3 class='inquiry_item__title'>{{ $i->title }}</h3>
						<div class='inquiry_item__toggle'>
							<div class='inquiry_item__note'>{{ $i->note }}</div>
							<div class='inquiry_item__footer'>
								<div class='inquiry_item__user_photo_block'>
									<a href='{{ action("PersonController@getView",  $i->relUser->id) }}'>
										<img class="inquiry_item__user_photo" src="{{ $i->relUser->photo }}" />
									</a>
								</div>
								<div class='inquiry_item__user_contact_block'>
									<span class='icon-22 inquiry_item__icon'></span> {{ $i->relUser->phone }} <br/>
									<span class='icon-20 inquiry_item__icon'></span> {{ $i->relUser->email }} <br/>
									{{ $i->created_at }}
								</div>
							</div>
						</div>
						<div class='inquiry_item__button_block'>
							<span class='inquiry_item__button_icon'> 
								<img class='inquiry_item__button_icon_img' src='/images/c-post__more--icon.png'>
							</span>
						</div>
					</div>
				@endforeach
			@else 
				<p>{{TransWord::getArabic('Note have any results',false)}}</p>
			@endif 
		</div>
		<div class='inquiry_footer'>
			{{ Form::open(array('url'=>action('InquiryController@postAdd'), 'method' => 'post', 'role'=>'form')) }}
				<div class='inquiry_footer_field'>
					<textarea name='note' class='inquiry__input' placeholder="{{TransWord::getArabic('Post your inquiry here (max 120 symbols)',false)}}" required></textarea>
				</div>
				<div class='inquiry_footer_field'>
					<span class='inquiry_footer_field__title'>{{TransWord::getArabic('Send to',false)}}</span>
					
					
					{{ Form::select('type_id', array(9999=>'Personal Account') + SysCompanyType::lists('name', 'id'), null, array('class'=>'inquiry__input', 'id'=>'inquery_type_id', 'required'=>'required')) }}
					
					
					{{ Form::select('cat_id', array(0=>''), 0, array('class'=>'inquiry__input', 'id'=>'inquery_cat_id', 'required'=>'required')) }}
				</div>
				<div class='inquiry_footer_field'>
					<button type="submit" class="c-button-ad c-button-blue">{{TransWord::getArabic('Submit',false)}}</button>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@else 
	<div class='inquiry_block shadow'>
		<div class='inquiry_body js-reviews-scroll'>
			@if(Inquiry::getUserList())
				@foreach (Inquiry::getUserList() as $i) 
					<div class='inquiry_item'>
						<h3 class='inquiry_item__title'>{{ $i->title }}</h3>
						<div class='inquiry_item__toggle'>
							<div class='inquiry_item__note'>{{ $i->note }}</div>
							<div class='inquiry_item__footer'>
								<div class='inquiry_item__user_photo_block'>
									<a href='{{ action("PersonController@getView",  $i->relUser->id) }}'>
										<img class="inquiry_item__user_photo" src="{{ $i->relUser->photo }}" />
									</a>
								</div>
								<div class='inquiry_item__user_contact_block'>
									<span class='icon-22 inquiry_item__icon'></span> {{ $i->relUser->phone }} <br/>
									<span class='icon-20 inquiry_item__icon'></span> {{ $i->relUser->email }} <br/>
									{{ $i->created_at }}
								</div>
							</div>
						</div>
						<div class='inquiry_item__button_block'>
							<span class='inquiry_item__button_icon'> 
								<img class='inquiry_item__button_icon_img' src='/images/c-post__more--icon.png'>
							</span>
						</div>
					</div>
				@endforeach
			@else 
				<p>{{TransWord::getArabic('Note have any results',false)}}</p>
			@endif 
		</div>
	</div>
@endif