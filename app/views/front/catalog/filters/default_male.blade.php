{{ Form::open(array('url'=>action('CatalogAdController@getIndex', $cat->id), 'method' => 'get', 'role'=>'form')) }}
<div class='ad_filter  shadow open'>
	@include('front.catalog.filters.include.head')
	<div class='ad_filter_body'>
		<div class='ad_filter_row'>
			@if (count($sub_cats) > 0) 
				<div class='col-md-40 ad_filter_col m-50'>
										
					<select name='sub_cat_id' class='ad_filter_input'>
						<option selected="" value="">{{ TransWord::getArabic('Type', false) }}</option>
						@foreach ($sub_cats as $k=>$v)
								<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
						@endforeach
					</select>
					
				</div>
				<div class='col-md-30 ad_filter_col m-50'>
					{{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input location_ico','id'=>'addresspicker', 'placeholder'=>TransWord::getArabic('Location', false))) }}
				</div>
				<div class='col-md-30 ad_filter_col m-100'>
					{{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Keywords', false))) }}
				</div>
			@else 
				<div class='col-md-50 m-50 ad_filter_col'>
					{{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input location_ico', 'id'=>'txtPlaces','placeholder'=>TransWord::getArabic('Location', false))) }}
				</div>
				<div class='col-md-50 m-50 ad_filter_col'>
					{{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Keywords', false))) }}
				</div>
			@endif
			
		</div>
		<div class='ad_filter_row'>
			<div class='col-md-20 ad_filter_col price_filter m-50'>
				<div class='ad_filter_col__title'>
					<span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Price',false) }}
				</div>
				<div class='ad_filter_col__body'>
					<div class='row'>
						<div class='col-md-45 m-45'> 
							{{ Form::text('min_price', (Input::has('min_price') ? Input::get('min_price') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Min', false), 'type'=>'number')) }}
						</div>
						<div class='col-md-10 m-10' style="text-align:center; margin-top: 4px;"> 
							—
						</div>
						<div class='col-md-45 m-45'> 
							{{ Form::text('max_price', (Input::has('max_price') ? Input::get('max_price') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Max', false), 'type'=>'number')) }}
						</div>
					</div>
				</div>
			</div>

			<div class="show_desktop">
			<div class='col-md-15 ad_filter_col ad_filter_col--border'>
				<div class='ad_filter_col__title'>
					{{ TransWord::getArabic('Male',false) }}
				</div>
				<div class='ad_filter_col__body' style="padding-top:13px;">
					@foreach($ar_male as $k=>$v)
						{{TransWord::getArabic($v,false)}} {{ Form::checkbox('male_id[]', $k, (Input::has('male_id') && in_array($k, Input::get('male_id'))?  true : false), array('id'=>'Male_'.$k)) }}
						<label for="{{'Male_'.$k}}"><span></span></label>


					@endforeach
				</div>
			</div>
			@include('front.catalog.filters.include.NEF_UH')
			</div>

			<b class="spoiler-title">Show more search options <img src="/images/arrow-down-icon.png" /></b>
			<div class="spoiler-body">
			<div class='col-md-15 ad_filter_col ad_filter_col--border'>
				<div class='ad_filter_col__title'>
					{{ TransWord::getArabic('Male',false) }}
				</div>
				<div class='ad_filter_col__body' style="padding-top:13px;">
					@foreach($ar_male as $k=>$v)
						{{TransWord::getArabic($v,false)}} {{ Form::checkbox('male_id[]', $k, (Input::has('male_id') && in_array($k, Input::get('male_id'))?  true : false), array('id'=>'Male_'.$k)) }}
						<label for="{{'Male_'.$k}}"><span></span></label>
						
						
					@endforeach
				</div>
			</div>
			@include('front.catalog.filters.include.NEF_UH')
			</div>
		</div>
		 
	</div>
	<div class='ad_filter_row'>
		<div class='col-md-45 filter_sort'> @include('front.catalog.filters.include.sort')</div>
		<div class='col-md-50 filter_submit'>@include('front.catalog.filters.include.submit_cols_50')</div>
	</div>
	@include('front.catalog.filters.include.switch')
	
</div>
{{ Form::hidden('filter', 1) }}
{{ Form::close() }}