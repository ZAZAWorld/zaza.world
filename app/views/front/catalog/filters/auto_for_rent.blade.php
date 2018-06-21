{{ Form::open(array('url'=>action('CatalogAdController@getIndex', $cat->id), 'method' => 'get', 'role'=>'form')) }}
<div class='ad_filter  shadow open'>
	@include('front.catalog.filters.include.head')
	<div class='ad_filter_body'>
		<div class='ad_filter_row'>
			<div class='col-md-25  m-50 ad_filter_col'>
				<select name='sub_cat_id' class='ad_filter_input'>
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
			<div class='col-md-37 m-50 ad_filter_col'>
				{{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input location_ico',  'id'=>'txtPlaces', 'placeholder'=>TransWord::getArabic('Location', false))) }}
			</div>
			<div class='col-md-37 m-100 ad_filter_col'>
				{{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Keywords', false))) }}
			</div>
		</div>
		<div class='ad_filter_row'>
			<div class='col-md-25 ad_filter_col price_filter m-50'>
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
				<div class='col-md-10 ad_filter_col ad_filter_col--border'>
					<div class='ad_filter_col__title'>
						<span class='icon-18 ad_filter_col__icon'></span> {{ TransWord::getArabic('Terms',false) }}
					</div>
					<div class='ad_filter_col__body'>

						<select name='term_id' class='ad_filter_input'>
							<option selected="" value=""></option>
							@foreach ($ar_terms as $k=>$v)
								<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
							@endforeach
						</select>

					</div>
				</div>
				<div class='col-md-12 ad_filter_col top43'>
					<div class='ad_filter_col__body'>
						{{ Form::checkbox('with_driver', true, (Input::has('with_driver') &&  Input::get('with_driver') ? true : null), array('id'=>'with_driver')) }}
						<label for="{{'with_driver'}}">{{ TransWord::getArabic('With driver',false) }} &nbsp; <span></span></label>
					</div>
				</div>

				<div class='col-md-50 m-100 ad_filter_col'>
					<div class='ad_filter_col_total_border top30'>
						{{ Form::checkbox('negotiable', true, (Input::has('negotiable') &&  Input::get('negotiable') ? true : null), array('id'=>'negotiable')) }}
						<label for="{{'negotiable'}}">{{ TransWord::getArabic('Negotiable',false) }} &nbsp; <span></span></label>&nbsp;&nbsp;
						{{ Form::checkbox('urgent', true, (Input::has('urgent') &&  Input::get('urgent') ? true : null), array('id'=>'Urgent')) }}
						<label for="{{'Urgent'}}">{{ TransWord::getArabic('Urgent',false) }} &nbsp; <span></span></label>  &nbsp;&nbsp;
						{{ Form::checkbox('hot_deal', true, (Input::has('hot_deal') &&  Input::get('hot_deal') ? true : null), array('id'=>'Hotdeal')) }}
						<label for="{{'Hotdeal'}}">{{ TransWord::getArabic('Hot deal',false) }} &nbsp; <span></span></label>
					</div>
				</div>
			</div>

			<b class="spoiler-title">Show more search options <img src="/images/arrow-down-icon.png" /></b>
			<div class="spoiler-body">
			<div class='col-md-10 ad_filter_col ad_filter_col--border'>
				<div class='ad_filter_col__title'>
					<span class='icon-18 ad_filter_col__icon'></span> {{ TransWord::getArabic('Terms',false) }}
				</div>
				<div class='ad_filter_col__body'>
				
					<select name='term_id' class='ad_filter_input'>
						<option selected="" value=""></option>
						@foreach ($ar_terms as $k=>$v)
								<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
						@endforeach
					</select>
					
				</div>
			</div>
			<div class='col-md-12 ad_filter_col top43'>
				<div class='ad_filter_col__body'>
					{{ Form::checkbox('with_driver', true, (Input::has('with_driver') &&  Input::get('with_driver') ? true : null), array('id'=>'with_driver')) }}
					<label for="{{'with_driver'}}">{{ TransWord::getArabic('With driver',false) }} &nbsp; <span></span></label>  
				</div>
			</div>
			
			<div class='col-md-50 m-100 ad_filter_col'>
				<div class='ad_filter_col_total_border top30'>
					{{ Form::checkbox('negotiable', true, (Input::has('negotiable') &&  Input::get('negotiable') ? true : null), array('id'=>'negotiable')) }} 
					<label for="{{'negotiable'}}">{{ TransWord::getArabic('Negotiable',false) }} &nbsp; <span></span></label>&nbsp;&nbsp;
					{{ Form::checkbox('urgent', true, (Input::has('urgent') &&  Input::get('urgent') ? true : null), array('id'=>'Urgent')) }} 
					<label for="{{'Urgent'}}">{{ TransWord::getArabic('Urgent',false) }} &nbsp; <span></span></label>  &nbsp;&nbsp;
					{{ Form::checkbox('hot_deal', true, (Input::has('hot_deal') &&  Input::get('hot_deal') ? true : null), array('id'=>'Hotdeal')) }}
					<label for="{{'Hotdeal'}}">{{ TransWord::getArabic('Hot deal',false) }} &nbsp; <span></span></label>  
				</div>
			</div>
		</div>
			
			
		</div>
		<div class='ad_filter_row'>
			<div class='col-md-50 filter_sort'> @include('front.catalog.filters.include.sort')</div>
			<div class='col-md-50 filter_submit'>@include('front.catalog.filters.include.submit_cols_50')</div>
		</div>
	</div>
	
	@include('front.catalog.filters.include.switch')
	
</div>
{{ Form::hidden('filter', 1) }}
{{ Form::close() }}
