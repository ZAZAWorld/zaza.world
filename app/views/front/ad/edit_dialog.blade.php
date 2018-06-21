<form action="{{ action('AdController@postUpdate') }}"  method='post' >

<div class="ad_dialog_edit open shadow">
    <div class="ad_dialog_edit__body">
	<span class="add_ad_modal__close"></span>
		<div>
		
		
		
			<h3 class='ad_dialog_edit__title'>{{ TransWord::getArabic('Edit advert') }}</h3>
		@if (!($advert->auto_brand_id > 0) || in_array('special_title', $cat_props))
			<div class='row ad_dialog_edit__row'>
				<div class='col-md-20 ad_dialog_edit__label'>{{ TransWord::getArabic('Title') }}</div>
				<div class='col-md-80'>
					<input name="title" type="text" class="ad_dialog_edit__text" placeholder="Video url" value='{{ $advert->title }}' />
				</div>
			</div>
		@endif
		@if (!in_array('youtube_false', $cat_props))
			<div class='row ad_dialog_edit__row'>
				<div class='col-md-20 ad_dialog_edit__label'>{{ TransWord::getArabic('Youtube link') }}</div>
				<div class='col-md-80'>
					<input name="youtube" type="text" class="ad_dialog_edit__text" placeholder="Video url" value='{{ ($advert->youtube ? "https://youtu.be/".$advert->youtube : null) }}' />
				</div>
			</div>
		@endif
		@if (!in_array('galarea_false', $cat_props))
			<div class='row ad_dialog_edit__row'>
				<div class='col-md-100'>
					<div class='row ad_dialog_edit_photo__list'>
						<div class='ad_dialog_edit_photo__square ad_dialog_edit_photo__square-add'>
							<img class="ad_dialog_edit_photo__square__upload_img" src="/front/img/icons/foto_blue.png">
							<div class="ad_dialog_edit_photo__square__upload_text">
								{{ TransWord::getArabic('Click here to upload') }}<br />
								{{ TransWord::getArabic('photo (max.20)') }}
							</div>
						</div>
						@foreach ($photos as $p)
							<div class='ad_dialog_edit_photo__square'>
								<img src="{{ $p->file }}" class="ad_dialog_edit_photo__image">
								<input type='hidden' name='ar_img[]' value='{{ $p->file }}' accept="image/*">
								<i class='delete ad_dialog_edit_photo__del_link'></i>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		@endif
		@if (!in_array('about_false', $cat_props))
			<div class='row ad_dialog_edit__row'>
				{{ TransWord::getArabic('About text') }}
				
					<textarea class="add_ad_field" rows="7" name='note'>{{ $about->note }}</textarea>
				
			</div>
		@endif
		@if (!in_array('price_false', $cat_props))
			<div class='row ad_dialog_edit__row'>
				
				<div class="add_ad_price_field">
					<span class="icon-38 add_ad_price_field__img"></span>
					<input name="price" type="text" class="add_ad_price_field__input idiot_price_format js-add-ad-price-value" value='{{ $advert->price }}' />
				</div>
				<div class="add_ad_price_dop">
					@if ($price_option['negotiable'])
						<div class="add_ad_price_dop__block">
							<input name="negotiable" type="checkbox" class="add_ad_price_dop__item js-add-ad-price-negotiable" value="1" {{ ( $advert->negotiable ? 'checked': null) }}>{{ TransWord::getArabic('Negotiable') }} &nbsp;&nbsp;
						</div>
					@endif
					@if ($price_option['exchange'])
						<div class="add_ad_price_dop__block">
							<input name="exchange" type="checkbox" class="add_ad_price_dop__item js-add-ad-price-exchange" value="1" {{ ( $advert->exchange ? 'checked': null) }}>{{ TransWord::getArabic('Exchange') }} &nbsp;&nbsp;
						</div>
					@endif
					@if ($price_option['free'])
						<div class="add_ad_price_dop__block">
							<input name="free" type="checkbox" class="add_ad_price_dop__item js-add-ad-price-free" value="1" {{ ( $advert->free ? 'checked': null) }}>{{ TransWord::getArabic('Free') }}
						</div>
					@endif
				</div>
			</div>
		@endif
		@if ($advert->auto_brand_id > 0 && $advert->auto_model_id > 0)
			<div class='row ad_dialog_edit__row'>
				<div class='col-md-20 ad_dialog_edit__label'>{{ TransWord::getArabic('Brand') }}</div>
				<div class='col-md-80'>
					{{  Form::select('auto_brand_id', $ar_brand, $advert->auto_brand_id, array('class'=>'ad_dialog_edit__text', 'required'=>'required', 'id'=>'auto_brand_id')) }}
				</div>
			</div>
			<div class='row ad_dialog_edit__row'>
				<div class='col-md-20 ad_dialog_edit__label'>{{ TransWord::getArabic('Model') }}</div>
				<div class='col-md-80'>
					{{  Form::select('auto_model_id', $ar_model, $advert->auto_model_id, array('class'=>'ad_dialog_edit__text', 'required'=>'required', 'id'=>'auto_model_id')) }}
				</div>
			</div>
			<div class='row ad_dialog_edit__row'>
				<div class='col-md-20 ad_dialog_edit__label'>{{ TransWord::getArabic('Year') }}</div>
				<div class='col-md-80'>
					{{  Form::select('prop[17]', $ar_city, $advert->city_id, array('class'=>'ad_dialog_edit__text', 'required'=>'required')) }}
				</div>
			</div>
		@elseif ($advert->auto_brand_id > 0)
			<div class='row ad_dialog_edit__row'>
				<div class='col-md-20 ad_dialog_edit__label'>{{ TransWord::getArabic('Brand') }}</div>
				<div class='col-md-80'>
					{{  Form::select('auto_brand_id', $ar_brand, $advert->auto_brand_id, array('class'=>'ad_dialog_edit__text', 'required'=>'required', 'id'=>'auto_brand_id')) }}
				</div>
			</div>
		@endif
		@foreach ($sys_props as $prop) 
			@if (!in_array($prop->id, $cat_props))
				<?php continue;?>
			@endif
			<div class='row ad_dialog_edit__row'>
				<div class='col-md-20 ad_dialog_edit__label'>{{ TransWord::getArabic($prop->name) }}</div>
				<div class='col-md-80'>
					@if ($prop->type_id == 4)
						<!------ radio button ------->
						@foreach ($prop->getOptionAr() as $option_id=>$option_name) 
							<input name="prop[{{ $prop->id }}]" type="radio" value="{{ $option_id }}" {{ (isset($adv_props[$prop->id]) && $adv_props[$prop->id] == $option_id ? 'checked': null) }} > {{ $option_name }}&nbsp;&nbsp;
						@endforeach
						
					@elseif ($prop->type_id == 3)
						<!------ checkbox ------->
						<input name="prop[{{ $prop->id }}]" type="checkbox" value="1" {{ (isset($adv_props[$prop->id]) ? 'checked': null) }}>
					@elseif ($prop->type_id == 2)
						<!------ select box ------->
						{{  Form::select('prop['.$prop->id.']', $prop->getOptionAr(), (isset($adv_props[$prop->id]) ? $adv_props[$prop->id] : null), array('class'=>'ad_dialog_edit__text', 'required'=>'required')) }}
					@else 
						@if ($prop->id == 45)
							<!------ resume file ------->
							<input type="file" class='edit_ad_resume_file'>
							<input type='hidden' name = 'prop[45]' class='edit_ad_resume_value' value='{{ (isset($adv_props[$prop->id]) ? $adv_props[$prop->id] : null) }}'>
						@elseif ($prop->id == 51)
							<!------ date ------->
							<input name='prop[51]' type="date" class="ad_dialog_edit__text" value='{{ (isset($adv_props[$prop->id]) ? $adv_props[$prop->id] : null) }}'>
						@elseif ($prop->id == 25)
							<!------ date ------->
							<input name='prop[25]' type="date" class="ad_dialog_edit__text" value='{{ (isset($adv_props[$prop->id]) ? $adv_props[$prop->id] : null) }}'>
						@else
							<!------ text ------->
							<input name="prop[{{ $prop->id }}]" type="text" class="ad_dialog_edit__text" value='{{ (isset($adv_props[$prop->id]) ? $adv_props[$prop->id] : null) }}' required/>
						@endif
					@endif
				</div>
			</div>
		@endforeach
		
		<div class='row ad_dialog_edit__row'>
			<div class='col-md-20 ad_dialog_edit__label'>{{ TransWord::getArabic('City') }}</div>
			<div class='col-md-80'>
				{{  Form::select('city_id', $ar_city, $advert->city_id, array('class'=>'ad_dialog_edit__text', 'required'=>'required')) }}
			</div>
		</div>
		<div class='row ad_dialog_edit__row'>
			<div class='col-md-20 ad_dialog_edit__label'>{{ TransWord::getArabic('Address') }}</div>
			<div class='col-md-80'>
				<input name="address" type="text" class="ad_dialog_edit__text" value='{{ $advert->address }}' />
			</div>
		</div>	
		<div class='ad_dialog_edit_bottom'>
			<button class="ad_dialog_edit__cancel" type="button">{{ TransWord::getArabic('Cancel') }}</button>
			<button class="ad_dialog_edit__submit" type="submit">{{ TransWord::getArabic('Save') }}</button>
		</div>
		
		<input class="ad_dialog_edit_photo__file" type="file" >
		<input type='hidden' name='advert_id' value='{{ $advert->id }}'>

        </div>
	</div>
</div>
</form>