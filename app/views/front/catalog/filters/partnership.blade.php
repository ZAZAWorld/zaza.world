{{ Form::open(array('url'=>action('CatalogAdController@getIndex', $cat->id), 'method' => 'get', 'role'=>'form')) }}
<div class='ad_filter  shadow open'>
	@include('front.catalog.filters.include.head')
	<div class='ad_filter_body'>
		<div class='ad_filter_row'>
			@if (count($sub_cats) > 0) 
				<div class='col-md-40 m-50 ad_filter_col'>
										
					<select name='sub_cat_id' class='ad_filter_input'>
						<option selected="" value="">{{ TransWord::getArabic('Type', false) }}</option>
						@foreach ($sub_cats as $k=>$v)
								<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
						@endforeach
					</select>
					
				</div>
				<div class='col-md-30 m-50 ad_filter_col'>
					{{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input location_ico', 'placeholder'=>TransWord::getArabic('Location', false))) }}
				</div>
				<div class='col-md-30 m-100 ad_filter_col'>
					{{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Keywords', false))) }}
				</div>
			@else 
				<div class='col-md-50 m-50 ad_filter_col'>
					{{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input location_ico', 'placeholder'=>TransWord::getArabic('Location', false))) }}
				</div>
				<div class='col-md-50 m-50 ad_filter_col'>
					{{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Keywords', false))) }}
				</div>
			@endif
			
		</div>

		<div class="show_desktop">
		<div class='ad_filter_row'>
			<div class='col-md-20 ad_filter_col price_filter'>
				<div class='ad_filter_col__title'>
					<span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Capital',false) }}
				</div>
				<div class='ad_filter_col__body'>
					<div class='row'>
						<div class='col-md-45 m-45'>
							{{  Form::select('min_price', array(Null=>TransWord::getArabic('Min', false)) + $capital, (Input::has('min_price') ? Input::get('min_price') : null), array('class'=>'ad_filter_input', 'id'=>'min_price')) }}
						</div>
						<div class='col-md-10 m-10' style="text-align:center; margin-top: 4px;">
							—
						</div>
						<div class='col-md-45 m-45'>
							{{  Form::select('max_price', array(Null=>TransWord::getArabic('Max', false)) + $capital, (Input::has('max_price') ? Input::get('max_price') : null), array('class'=>'ad_filter_input', 'id'=>'max_price')) }}
						</div>
					</div>
				</div>
			</div>

			<div class='col-md-23 ad_filter_col top45 m-60 m-top15'>
				{{ Form::checkbox('free', true, (Input::has('free') &&  Input::get('free') ? true : null), array('id'=>'Free')) }}
				<label for="{{'Free'}}">{{ TransWord::getArabic('Free',false) }} &nbsp; <span></span></label>
			</div>
			<div class='col-md-20 ad_filter_col top30 m-40'>
				<div class='ad_filter_col_total_border'>
					{{ Form::checkbox('urgent', true, (Input::has('urgent') &&  Input::get('urgent') ? true : null), array('id'=>'Urgent')) }}
					<label for="{{'Urgent'}}">{{ TransWord::getArabic('Urgent',false) }} &nbsp; <span></span></label>
				</div>
			</div>
		</div>
		</div>

		<b class="spoiler-title">Show more search options<img src="/images/arrow-down-icon.png" /></b>
		<div class="spoiler-body">
		<div class='ad_filter_row'>
			<div class='col-md-20 ad_filter_col price_filter'>
				<div class='ad_filter_col__title'>
					<span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Capital',false) }}
				</div>
				<div class='ad_filter_col__body'>
					<div class='row'>
						<div class='col-md-45 m-45'>
                            {{  Form::select('min_price', array(Null=>TransWord::getArabic('Min', false)) + $capital, (Input::has('min_price') ? Input::get('min_price') : null), array('class'=>'ad_filter_input', 'id'=>'min_price')) }}
						</div>
						<div class='col-md-10 m-10' style="text-align:center; margin-top: 4px;"> 
							—
						</div>
						<div class='col-md-45 m-45'>
                            {{  Form::select('max_price', array(Null=>TransWord::getArabic('Max', false)) + $capital, (Input::has('max_price') ? Input::get('max_price') : null), array('class'=>'ad_filter_input', 'id'=>'max_price')) }}
						</div>
					</div>
				</div>
			</div>

            <div class='col-md-23 ad_filter_col top45 m-60 m-top15'>
                {{ Form::checkbox('free', true, (Input::has('free') &&  Input::get('free') ? true : null), array('id'=>'Free')) }}
                <label for="{{'Free'}}">{{ TransWord::getArabic('Free',false) }} &nbsp; <span></span></label>
            </div>
            <div class='col-md-20 ad_filter_col top30 m-40'>
                <div class='ad_filter_col_total_border'>
                    {{ Form::checkbox('urgent', true, (Input::has('urgent') &&  Input::get('urgent') ? true : null), array('id'=>'Urgent')) }}
                    <label for="{{'Urgent'}}">{{ TransWord::getArabic('Urgent',false) }} &nbsp; <span></span></label>
                </div>
            </div>
		</div>
		</div>

	</div>


	<div class='ad_filter_row'>
		<div class='col-md-40 filter_sort m-100'> @include('front.catalog.filters.include.sort')</div>
		<div class='col-md-50 filter_submit'>@include('front.catalog.filters.include.submit_cols_50')</div>
	</div>
	@include('front.catalog.filters.include.switch')
	
</div>
{{ Form::hidden('filter', 1) }}
{{ Form::close() }}
