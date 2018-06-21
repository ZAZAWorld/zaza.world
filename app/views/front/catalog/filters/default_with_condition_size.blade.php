{{ Form::open(array('url'=>action('CatalogAdController@getIndex', $cat->id), 'method' => 'get', 'role'=>'form')) }}
<div class='ad_filter  shadow open'>
	@include('front.catalog.filters.include.head')
	<div class='ad_filter_body'>
		<div class='ad_filter_row'>
			@if (count($sub_cats) > 0) 
				<div class='col-md-15 ad_filter_col m-33'>
					
					
					<select name='sub_cat_id' class='ad_filter_input js-filtet_cat_3_id'>
						<option selected="" value="">{{ TransWord::getArabic('Type', false) }}</option>
						@foreach ($sub_cats as $k=>$v)
								<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
						@endforeach
					</select>
					
				</div>
				<div class='col-md-15 ad_filter_col m-33'>
					{{  Form::select('sub_cat_2_id', array(Null=>Null) + SysAdvertCat::where('parent_id', Input::get('sub_cat_id'))->orderBy('name', 'asc')->lists('name', 'id'), (Input::has('sub_cat_2_id') ? Input::get('sub_cat_2_id') : null), array('class'=>'ad_filter_input js-filtet_cat_4_id')) }}
				</div>
				<div class='col-md-35 ad_filter_col m-33'>
					{{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input location_ico','id'=>'txtPlaces', 'placeholder'=>TransWord::getArabic('Location', false))) }}
				</div>
				<div class='col-md-35 ad_filter_col m-100'>
					{{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Keywords', false))) }}
				</div>
			@else 
				<div class='col-md-50 ad_filter_col m-50'>
					{{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input location_ico', 'id'=>'txtPlaces', 'placeholder'=>TransWord::getArabic('Location', false))) }}
				</div>
				<div class='col-md-50 ad_filter_col m-50'>
					{{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Keywords', false))) }}
				</div>
			@endif
			
		</div>
		<div class='ad_filter_row'>
			<div class='col-md-20 ad_filter_col price_filter m-50'>
				<div class='ad_filter_col__title'>
					<span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Price') }}
				</div>
				<div class='ad_filter_col__body'>
					<div class='row'>
						<div class='col-md-45 m-45'> 
							{{ Form::text('min_price', (Input::has('min_price') ? Input::get('min_price') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Min', false), 'type'=>'number')) }}
						</div>
						<div class='col-md-10 m-10' style='text-align:center; margin-top: 4px;'> 
							—
						</div>
						<div class='col-md-45 m-45'> 
							{{ Form::text('max_price', (Input::has('max_price') ? Input::get('max_price') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Max', false), 'type'=>'number')) }}
						</div>
					</div>
				</div>
			</div>


			<div class="show_desktop">
            <div class='col-md-10 ad_filter_col ad_filter_col--border m-25'>
                <div class='ad_filter_col__title'>
                    <span class='icon-72 ad_filter_col__icon'></span> {{ TransWord::getArabic('Condition',false) }}
                </div>
                <div class='ad_filter_col__body'>
                    {{  Form::select('car_condition_id', array(Null=>'') + $ar_condition, (Input::has('car_condition_id') ? Input::get('car_condition_id') : null), array('class'=>'ad_filter_input', 'id'=>'car_condition_id')) }}
                </div>
            </div>
			<div class='col-md-10 ad_filter_col m-25'>
				<div class='ad_filter_col__title'>
					<span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Size') }}
				</div>
				<div class='ad_filter_col__body'>
					
					<select name='size_id' class='ad_filter_input'>
                        <option></option>
						@foreach ($ar_size as $k=>$v)
                            @if (Input::has('size_id') and Input::get('size_id')==$k)
                            <option value='{{ $k }}' selected>{{ TransWord::getArabic($v, false) }}</option>
                            @else
							<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
                            @endif
						@endforeach
					</select>
					
				</div>
			</div>
			@include('front.catalog.filters.include.NEF_UH')
			</div>

			<b class="spoiler-title">Show more search options <img src="/images/arrow-down-icon.png" /></b>
			<div class="spoiler-body">
			<div class='col-md-10 ad_filter_col ad_filter_col--border m-25'>
				<div class='ad_filter_col__title'>
					<span class='icon-72 ad_filter_col__icon'></span> {{ TransWord::getArabic('Condition',false) }}
				</div>
				<div class='ad_filter_col__body'>
					{{  Form::select('car_condition_id', array(Null=>'') + $ar_condition, (Input::has('car_condition_id') ? Input::get('car_condition_id') : null), array('class'=>'ad_filter_input', 'id'=>'car_condition_id')) }}
				</div>
			</div>
			<div class='col-md-10 ad_filter_col m-25'>
				<div class='ad_filter_col__title'>
					<span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Size') }}
				</div>
				<div class='ad_filter_col__body'>

					<select name='size_id' class='ad_filter_input'>
						<option></option>
						@foreach ($ar_size as $k=>$v)
							@if (Input::has('size_id') and Input::get('size_id')==$k)
								<option value='{{ $k }}' selected>{{ TransWord::getArabic($v, false) }}</option>
							@else
								<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
							@endif
						@endforeach
					</select>

				</div>
			</div>
			@include('front.catalog.filters.include.NEF_UH')
			</div>

		</div>
		<div class='ad_filter_row'>
			<div class='col-md-45 filter_sort'> @include('front.catalog.filters.include.sort')</div>
			<div class='col-md-50 filter_submit'>@include('front.catalog.filters.include.submit_cols_50')</div>
		</div>
	</div>
	
	@include('front.catalog.filters.include.switch')
	
</div>

{{ Form::hidden('filter', 1) }}
{{ Form::close() }}
