<input type='hidden' name='cat_1' class="js_add_ad_select_cat_1">
<div class="add_ad_line">
	<div class="add_ad_line__title" style="text-align:left; font-size:14px;">
		{{TransWord::getArabic('Select type, category and subcategory of your ad')}}
	</div>
	<div class="add_ad_line__stroke">&nbsp;</div>
	<div class="add_ad_line__ball_1 add_ad_line__ball-blue">&nbsp;</div>
	<div class="add_ad_line__ball_2">&nbsp;</div>
	<div class="add_ad_line__ball_3">&nbsp;</div>
</div>

<div class="add_ad_type">
	<div class="add_ad_type__title">{{TransWord::getArabic('Select type of your ad')}}</div>
	<ul class="add_ad_type__list">
		@foreach (SysAdvertCat::where(function($q) { $q->where('id', 4)->orWhere('id', 5)->orWhere('id', 6)->orWhere('id', 7);})->get() as $cat_1)
			<li class="add_ad_type__item" data-id='{{ $cat_1->id }}'>
				<span class="{{ $cat_1->icon }} add_ad_type__img"></span>
				<div class="add_ad_type__text"> {{TransWord::getArabic($cat_1->name)}}</div>
			</li>
		@endforeach
	</ul>
</div>

<div class="add_ad_cats">
	<div class="add_ad_cats__item">
	
	<!--
		{{  Form::select('cat_2', array(Null=>'Category 1'), null, array('class'=>'add_ad_field js_add_ad_select_cat_2 normalValidate', 'required'=>'required')) }}
		-->
		
		<select name='cat_2' class='add_ad_field js_add_ad_select_cat_2 normalValidate' required>
			<option >{{ TransWord::getArabic('Category 1', false) }}</option>
		</select>
	</div>
	<div class="add_ad_cats__item">
	<!--
		{{  Form::select('cat_3', array(Null=>'Category 2'), null, array('class'=>'add_ad_field js_add_ad_select_cat_3 normalValidate')) }}
	-->
		
		<select name='cat_3' class='add_ad_field js_add_ad_select_cat_3 normalValidate'>
			<option >{{ TransWord::getArabic('Category 2', false) }}</option>
		</select>
	</div>
	<div class="add_ad_cats__item">
	<!--
		{{  Form::select('cat_4', array(Null=>'Subcategory'), null, array('class'=>'add_ad_field js_add_ad_select_cat_4 normalValidate')) }}
	-->
		<select name='cat_4' class='add_ad_field js_add_ad_select_cat_4 normalValidate'>
			<option >{{ TransWord::getArabic('Subcategory', false) }}</option>
		</select>
	</div>
	<div class="add_ad_cats__item">
	<!--
		{{  Form::select('city_id', array(Null=>'Emirate') + SysCity::where('country_id', 1)->lists('name', 'id'), null, array('class'=>'add_ad_field js_add_ad_select_city_id normalValidate', 'required'=>'required')) }}
	
	-->
		
		<select name='city_id' class='add_ad_field js_add_ad_select_city_id digitValidate' >
			<option >{{ TransWord::getArabic('Emirate', false) }}</option>
			@foreach (SysCity::where('country_id', 1)->lists('name', 'id') as $k=>$v)
				@if (Input::has('sub_cat_id') && Input::get('sub_cat_id') == $k)
					<option value='{{ $k }}' selected>{{ TransWord::getArabic($v, false) }}</option>
				@else 
					<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
				@endif
			@endforeach
		</select>
				
	</div>
</div>

<div class="add_ad_tutorial">
	<div class="add_ad_tutorial__left">
		<div class="add_ad_tutorial__title" style="margin-top: 50px;">
			{{TransWord::getArabic('About zaza.ae')}}
		</div>
		<div class="add_ad_tutorial__text">
		{{-- {{TransWord::getArabic('Need help?')}} <br /> --}}
			{{TransWord::getArabic('Watch this tutorial video')}}
		</div>
	</div>
	<div class="add_ad_tutorial__right">
		<div class="youtube_block_img">
			<img src="/front/img/youtube_bg.png" class="youtube_block_img__bg">
			 <a class="popup-youtube" href="https://www.youtube.com/watch?v=PBDZFv8oSd8?showinfo=0&enablejsapi=1&origin=https://zaza.ae"><img src="/front/img/icons/play_icon.png" class="youtube_block_img__play"></a>
		</div>
	</div>
</div>

<div class="add_ad_buttons ">
	<button class="add_ad_buttons__before js-add_ad_step" data-step='0' data-before-step='1' type='button'>
		<img src="/front/img/icons/link_before.png"  /> {{TransWord::getArabic('Cancel')}}
	</button>

	<button class="add_ad_buttons__next js-add_ad_step" data-step='2' data-before-step='1'  type='button'>
		 {{TransWord::getArabic('Next')}}
		 <img src="/front/img/icons/link_next.png" />
	</button>
</div>
