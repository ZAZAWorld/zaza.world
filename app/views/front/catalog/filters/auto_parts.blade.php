{{ Form::open(array('url'=>action('CatalogAdController@getIndex', $cat->id), 'method' => 'get', 'role'=>'form')) }}
<div class='ad_filter  shadow open'>
	@include('front.catalog.filters.include.head')
	<div class='ad_filter_body'>
		<div class='ad_filter_row'>
			<div class='col-md-20 ad_filter_col'>
				
				<select  name='sub_cat_id' class='ad_filter_input' id="sub_cat_part_id">
					<option >{{ TransWord::getArabic('Type', false) }}</option>
					@foreach ($sub_cats as $k=>$v)
						@if (Input::has('sub_cat_id') && Input::get('sub_cat_id') == $k)
							<option value='{{ $k }}' selected>{{ TransWord::getArabic($v, false) }}</option>
						@else 
							<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
						@endif
					@endforeach
				</select>
				
			</div>
            <div class='col-md-20 ad_filter_col'>
                {{  Form::select('sub_cat_2_id', array(Null=>TransWord::getArabic('Type part', false)) + $types_parts , (Input::has('sub_cat_2_id') ? Input::get('sub_cat_2_id') : null), array('class'=>'ad_filter_input', 'id'=>'type_part_id')) }}
            </div>
			<!--<div class='col-md-20 ad_filter_col'>
				{{  Form::select('auto_brand_id', array(Null=>TransWord::getArabic('Auto brand', false)) + $ar_brands, (Input::has('auto_brand_id') ? Input::get('auto_brand_id') : null), array('class'=>'ad_filter_input', 'id'=>'auto_brand_id')) }}
			</div>
			<div class='col-md-20 ad_filter_col'>
				{{  Form::select('auto_model_id', array(Null=>TransWord::getArabic('Auto model', false)) + $ar_models, (Input::has('auto_model_id') ? Input::get('auto_model_id') : null), array('class'=>'ad_filter_input', 'id'=>'auto_model_id')) }}
			</div> -->
			<div class='col-md-20 ad_filter_col'>
				{{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input location_ico', 'id'=>'txtPlaces', 'placeholder'=>TransWord::getArabic('Location', false))) }}
			</div>
			<div class='col-md-40 ad_filter_col m-width50'>
				{{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Keywords', false))) }}
			</div>
		</div>
		<div class='ad_filter_row'>
			
			<div class='col-md-20 ad_filter_col price_filter'>
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
			<div class='col-md-20 ad_filter_col ad_filter_col--border'>
				<div class='ad_filter_col__title'>
					{{ TransWord::getArabic('Year',false) }}
				</div>
				<div class='ad_filter_col__body'>
					<div class='row'>
						<div class='col-md-45 m-45'>
                            {{  Form::select('min_year', array(Null=>TransWord::getArabic('Min', false)) + $years, (Input::has('min_year') ? Input::get('min_year') : null), array('class'=>'ad_filter_input', 'id'=>'min_year')) }}
						</div>
						<div class='col-md-10 m-10' style="text-align:center; margin-top: 4px;"> 
							—
						</div>
						<div class='col-md-45 m-45'>
                            {{  Form::select('max_year', array(Null=>TransWord::getArabic('Max', false)) + $years, (Input::has('max_year') ? Input::get('max_year') : null), array('class'=>'ad_filter_input', 'id'=>'max_year')) }}
						</div>
					</div>
				</div>
			</div>
			{{--
			<div class='col-md-20 ad_filter_col'>
				<div class='ad_filter_col__title'>
					<span class='icon-88 ad_filter_col__icon'></span> {{ TransWord::getArabic('Body',false) }}
				</div>
				<div class='ad_filter_col__body'>
					
					<!--
					{{  Form::select('car_body_id', array(Null=>'') + $ar_body, (Input::has('car_body_id') ? Input::get('car_body_id') : null), array('class'=>'ad_filter_input')) }}
					-->
					
					<select name='car_body_id' class='ad_filter_input'>
						<option selected="" value=""></option>
						@foreach ($ar_body as $k=>$v)
								<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
						@endforeach
					</select>
					
				</div>
			</div>
			--}}
			<div class='col-md-10 ad_filter_col ad_filter_col--border'>
				<div class='ad_filter_col__title'>
					<span class='icon-72 ad_filter_col__icon'></span> {{ TransWord::getArabic('Condition',false) }}
				</div>
				<div class='ad_filter_col__body'>
					<!--
						{{  Form::select('car_condition_id', array(Null=>'') + $ar_condition, (Input::has('car_condition_id') ? Input::get('car_condition_id') : null), array('class'=>'ad_filter_input')) }}
					-->
					
					<select name='car_condition_id' class='ad_filter_input'>
						<option selected="" value=""></option>
						@foreach ($ar_condition as $k=>$v)
								<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
						@endforeach
					</select>
					
				</div>
			</div>
			
		</div>
		 
			@include('front.catalog.filters.include.NEF_UH')
		 
	</div>
	<div class='ad_filter_row'>
			<div class='col-md-50 filter_sort'> @include('front.catalog.filters.include.sort')</div>
			<div class='col-md-50 filter_submit'>@include('front.catalog.filters.include.submit_cols_50')</div>
		</div>
	@include('front.catalog.filters.include.switch')
	
</div>
{{ Form::hidden('filter', 1) }}
{{ Form::close() }}
