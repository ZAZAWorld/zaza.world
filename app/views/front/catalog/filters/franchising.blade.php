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
		<div class='ad_filter_row'>
            <div class='col-md-20 ad_filter_col price_filter'>
                <div class='ad_filter_col__title'>
                    <span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Price') }}
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
			<div class='col-md-20 ad_filter_col price_filter top43 m-top15'>
				<div class='ad_filter_col__body'>
					<div class='row'>
						{{ Form::checkbox('hot_deal', true, (Input::has('hot_deal') &&  Input::get('hot_deal') ? true : null), array('id'=>'Hotdeal')) }}
						<label for="{{'Hotdeal'}}">{{ TransWord::getArabic('Hot deal') }} &nbsp; <span></span></label>
						{{ Form::checkbox('negotiable', true, (Input::has('negotiable') &&  Input::get('negotiable') ? true : null), array('id'=>'negotiable')) }}
						<label for="{{'negotiable'}}">{{ TransWord::getArabic('Negotiable') }} &nbsp; <span></span></label>&nbsp;&nbsp;
					</div>

				</div>
			</div>
			</div>

			    <b class="spoiler-title">Show more search options <img src="/images/arrow-down-icon.png" /></b>
			    <div class="spoiler-body">
				<div class='col-md-20 ad_filter_col price_filter top43 m-top15'>
				<div class='ad_filter_col__body'>
					<div class='row'>
                        {{ Form::checkbox('hot_deal', true, (Input::has('hot_deal') &&  Input::get('hot_deal') ? true : null), array('id'=>'Hotdeal')) }}
                        <label for="{{'Hotdeal'}}">{{ TransWord::getArabic('Hot deal') }} &nbsp; <span></span></label>
                        {{ Form::checkbox('negotiable', true, (Input::has('negotiable') &&  Input::get('negotiable') ? true : null), array('id'=>'negotiable')) }}
                        <label for="{{'negotiable'}}">{{ TransWord::getArabic('Negotiable') }} &nbsp; <span></span></label>&nbsp;&nbsp;
                    </div>
					
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
