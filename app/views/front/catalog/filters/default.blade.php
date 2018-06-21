{{ Form::open(array('url'=>action('CatalogAdController@getIndex', $cat->id), 'method' => 'get', 'role'=>'form')) }}
<div class='ad_filter shadow open'>
	@include('front.catalog.filters.include.head')
	<div class='ad_filter_body'>
		<div class='ad_filter_row'>
			@if (count($sub_cats) > 0) 
				<div class='col-md-30 m-50 ad_filter_col'>
					<?php
					#{{  Form::select('sub_cat_id', array(Null=>TransWord::getArabic('Type', false)) + $sub_cats, (Input::has('sub_cat_id') ? Input::get('sub_cat_id') : null), array('class'=>'ad_filter_input')) }}
					?>
					<select name='sub_cat_id' class='ad_filter_input'  @if ($cat->id == 79) id="sub_cat_part_id" @endif>
					<option >{{ TransWord::getArabic('Type', false) }}</option>
						@foreach ($sub_cats as $k=>$v)
                        @if (Input::get('sub_cat_id') == $k)
                        <option selected value='{{ $k }}' >{{ TransWord::getArabic($v, false) }}</option>
                        @else
                        <option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
                        @endif
						@endforeach
					</select>
					
				</div>
                @if ($cat->id == 79)
                <div class='col-md-20 ad_filter_col'>
                {{  Form::select('sub_cat_2_id', array(Null=>TransWord::getArabic('Type', false)) , (Input::has('sub_cat_2_id') ? Input::get('sub_cat_2_id') : null), array('class'=>'ad_filter_input', 'id'=>'type_part_id')) }}
                </div>
                @endif
				<div class='col-md-25 m-50 ad_filter_col'>
					{{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input location_ico', 'id'=>'addresspicker', 'placeholder'=>TransWord::getArabic('Location', false))) }}
				</div>
				<div class='col-md-25 m-50 ad_filter_col'>
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
		 @if($cat->id != 95)
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
		@endif
				 <div class="show_desktop">
				 @if ($cat->parent_id == 5)
					 <div class='col-md-10 ad_filter_col ad_filter_col--border m-25'>
						 <div class='ad_filter_col__title'>
							 <span class='icon-72 ad_filter_col__icon'></span> {{ TransWord::getArabic('Condition',false) }}
						 </div>
						 <div class='ad_filter_col__body'>
							 {{  Form::select('car_condition_id', array(Null=>'') + $ar_condition, (Input::has('car_condition_id') ? Input::get('car_condition_id') : null), array('class'=>'ad_filter_input', 'id'=>'car_condition_id')) }}
						 </div>
					 </div>
				 @endif
				 @if($cat->id == 95)
					 <div class='col-md-20 ad_filter_col price_filter'>
						 <div class='ad_filter_col__title'>
							 <span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Capital') }}
						 </div>
						 <div class='ad_filter_col__body'>
							 <div class='row'>
								 <div class='col-md-45 m-45'>
									 {{  Form::select('min_capital', array(Null=>TransWord::getArabic('Any', false)) + $ar_capital_list, (Input::has('min_capital') ? Input::get('min_capital') : null), array('class'=>'ad_filter_input', 'id'=>'min_capital')) }}
								 </div>
								 <div class='col-md-10 m-10' style="text-align:center; margin-top: 4px;">
									 —
								 </div>
								 <div class='col-md-45 m-45'>
									 {{  Form::select('max_capital', array(Null=>TransWord::getArabic('Any', false)) + $ar_capital_list, (Input::has('max_capital') ? Input::get('max_capital') : null), array('class'=>'ad_filter_input', 'id'=>'max_capital')) }}
								 </div>
							 </div>
						 </div>
					 </div>
				 @endif

				 @if ($cat->id !=32)
					 <div class='col-md-23 m-50 ad_filter_col top43 m-top15'>
						 {{ Form::checkbox('negotiable', true, (Input::has('negotiable') &&  Input::get('negotiable') ? true : null), array('id'=>'negotiable')) }}
						 <label for="{{'negotiable'}}">{{ TransWord::getArabic('Negotiable') }} &nbsp; <span></span></label>&nbsp;&nbsp;
						 @if ($cat->id!=18 && $cat->id != 95)
							 {{ Form::checkbox('exchange', true, (Input::has('exchange') &&  Input::get('exchange') ? true : null), array('id'=>'Exchange')) }}
							 <label for="{{'Exchange'}}">{{ TransWord::getArabic('Exchange') }}  &nbsp; <span></span></label>&nbsp;&nbsp;
						 @endif
						 @if ($cat->parent_id == 5)
							 {{ Form::checkbox('free', true, (Input::has('free') &&  Input::get('free') ? true : null), array('id'=>'Free')) }}
							 <label for="{{'Free'}}">{{ TransWord::getArabic('Free') }} &nbsp; <span></span></label>
						 @endif
					 </div>
					 <div class='col-md-20 m-50 ad_filter_col top30'>
						 <div class='ad_filter_col_total_border'>
							 {{ Form::checkbox('urgent', true, (Input::has('urgent') &&  Input::get('urgent') ? true : null), array('id'=>'Urgent')) }}
							 <label for="{{'Urgent'}}">{{ TransWord::getArabic('Urgent') }} &nbsp; <span></span></label>  &nbsp;&nbsp;
							 {{ Form::checkbox('hot_deal', true, (Input::has('hot_deal') &&  Input::get('hot_deal') ? true : null), array('id'=>'Hotdeal')) }}
							 <label for="{{'Hotdeal'}}">{{ TransWord::getArabic('Hot deal') }} &nbsp; <span></span></label>
						 </div>
					 </div>
				 @endif
				 </div>


			<b class="spoiler-title">Show more search options <img src="/images/arrow-down-icon.png" /></b>
			<div class="spoiler-body">
            @if ($cat->parent_id == 5)
                 <div class='col-md-10 ad_filter_col ad_filter_col--border m-25'>
                     <div class='ad_filter_col__title'>
                         <span class='icon-72 ad_filter_col__icon'></span> {{ TransWord::getArabic('Condition',false) }}
                     </div>
                     <div class='ad_filter_col__body'>
                         {{  Form::select('car_condition_id', array(Null=>'') + $ar_condition, (Input::has('car_condition_id') ? Input::get('car_condition_id') : null), array('class'=>'ad_filter_input', 'id'=>'car_condition_id')) }}
                     </div>
                 </div>
            @endif
            @if($cat->id == 95)
            <div class='col-md-20 ad_filter_col price_filter'>
                <div class='ad_filter_col__title'>
                    <span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Capital') }}
                </div>
                <div class='ad_filter_col__body'>
                    <div class='row'>
                        <div class='col-md-45 m-45'>
                            {{  Form::select('min_capital', array(Null=>TransWord::getArabic('Any', false)) + $ar_capital_list, (Input::has('min_capital') ? Input::get('min_capital') : null), array('class'=>'ad_filter_input', 'id'=>'min_capital')) }}
                        </div>
                        <div class='col-md-10 m-10' style="text-align:center; margin-top: 4px;">
                            —
                        </div>
                        <div class='col-md-45 m-45'>
                            {{  Form::select('max_capital', array(Null=>TransWord::getArabic('Any', false)) + $ar_capital_list, (Input::has('max_capital') ? Input::get('max_capital') : null), array('class'=>'ad_filter_input', 'id'=>'max_capital')) }}
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if ($cat->id !=32)
			<div class='col-md-23 m-50 ad_filter_col top43 m-top15'>
				{{ Form::checkbox('negotiable', true, (Input::has('negotiable') &&  Input::get('negotiable') ? true : null), array('id'=>'negotiable')) }} 
				<label for="{{'negotiable'}}">{{ TransWord::getArabic('Negotiable') }} &nbsp; <span></span></label>&nbsp;&nbsp;
				@if ($cat->id!=18 && $cat->id != 95)
					{{ Form::checkbox('exchange', true, (Input::has('exchange') &&  Input::get('exchange') ? true : null), array('id'=>'Exchange')) }}
					<label for="{{'Exchange'}}">{{ TransWord::getArabic('Exchange') }}  &nbsp; <span></span></label>&nbsp;&nbsp;
				@endif
                @if ($cat->parent_id == 5)
				{{ Form::checkbox('free', true, (Input::has('free') &&  Input::get('free') ? true : null), array('id'=>'Free')) }}
				<label for="{{'Free'}}">{{ TransWord::getArabic('Free') }} &nbsp; <span></span></label>
                @endif
			</div>
			<div class='col-md-20 m-50 ad_filter_col top30'>
				<div class='ad_filter_col_total_border'>
					{{ Form::checkbox('urgent', true, (Input::has('urgent') &&  Input::get('urgent') ? true : null), array('id'=>'Urgent')) }} 
					<label for="{{'Urgent'}}">{{ TransWord::getArabic('Urgent') }} &nbsp; <span></span></label>  &nbsp;&nbsp;
					{{ Form::checkbox('hot_deal', true, (Input::has('hot_deal') &&  Input::get('hot_deal') ? true : null), array('id'=>'Hotdeal')) }}
					<label for="{{'Hotdeal'}}">{{ TransWord::getArabic('Hot deal') }} &nbsp; <span></span></label>  
				</div>
			</div>
            @endif
			</div>

		</div>

	</div>
	<div class='ad_filter_row'>
			<div class='col-md-50 filter_sort'> @include('front.catalog.filters.include.sort')</div>
			<div class='col-md-50 filter_submit'>@include('front.catalog.filters.include.submit_cols_50')</div>
		</div>
	@include('front.catalog.filters.include.switch')
	
</div>
{{ Form::hidden('filter', 1) }}
{{ Form::close() }}
