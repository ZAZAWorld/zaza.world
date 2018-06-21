{{ Form::open(array('url'=>action('CatalogCompanyController@getIndex', $cat->id), 'method' => 'get', 'role'=>'form')) }}
<div class='ad_filter  open shadow '>
	<h2 class='ad_filter_title'>
		{{ TransWord::getArabic($parent_cat->name,false) }}
		/ {{ TransWord::getArabic($cat->name) }}
		{{ (isset($sub_cat) && $sub_cat ? ' / '.TransWord::getArabic($sub_cat->name,false) : null) }}
		{{ (isset($sub_cat_2) && $sub_cat_2 ? ' / '.TransWord::getArabic($sub_cat_2->name,false) : null) }}</h2>
	<div class='ad_filter_body'>
		<div class='ad_filter_row'>
			@if (count($sub_cats) > 0) 
				<div class='col-md-40 m-50 ad_filter_col'>
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
				<div class='col-md-30 m-50 ad_filter_col'>
					{{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input location_ico', 'id'=>'txtPlaces', 'placeholder'=>TransWord::getArabic('Location', false))) }}
				</div>
				<div class='col-md-30 m-100 ad_filter_col'>
					{{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Keywords', false))) }}
				</div>
			@else 
				<div class='col-md-50 m-50 ad_filter_col'>
					{{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input location_ico', 'id'=>'txtPlaces', 'placeholder'=>TransWord::getArabic('Location', false))) }}
				</div>
				<div class='col-md-50 m-50 ad_filter_col'>
					{{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Keywords', false))) }}
				</div>
			@endif
			
		</div>
		<div class='ad_filter_row'>
			@if ($cat->type_id != 2)
            <div class='col-md-8 ad_filter_col m-25'>
                <!--
                    {{ TransWord::getArabic('Wholesale')}} {{ Form::checkbox('wholesale', true, (Input::has('wholesale') &&  Input::get('wholesale') ? true : null)) }} &nbsp;&nbsp;
                    {{ TransWord::getArabic('Retail')}} {{ Form::checkbox('retail', true, (Input::has('retail') &&  Input::get('retail') ? true : null)) }}
                -->
                {{ Form::checkbox('retail', true, (Input::has('retail') &&  Input::get('retail') ? true : null), array('id'=>'retail')) }}
                <label for="{{'retail'}}">{{ TransWord::getArabic('Retail',false)}}  &nbsp; &nbsp;<span></span></label>
            </div>
            <div class='col-md-15 ad_filter_col m-25'>
                <!--
                    {{ TransWord::getArabic('Wholesale')}} {{ Form::checkbox('wholesale', true, (Input::has('wholesale') &&  Input::get('wholesale') ? true : null)) }} &nbsp;&nbsp;
                    {{ TransWord::getArabic('Retail')}} {{ Form::checkbox('retail', true, (Input::has('retail') &&  Input::get('retail') ? true : null)) }}
                -->
                {{ Form::checkbox('whosale', true, (Input::has('whosale') &&  Input::get('whosale') ? true : null), array('id'=>'whosale')) }}
                <label for="{{'whosale'}}">{{ TransWord::getArabic('Whosale',false)}}  &nbsp; &nbsp;<span></span></label>
            </div>
            @endif
			<div class='col-md-20 ad_filter_col m-50'>
			<!--
				{{ TransWord::getArabic('Wholesale')}} {{ Form::checkbox('wholesale', true, (Input::has('wholesale') &&  Input::get('wholesale') ? true : null)) }} &nbsp;&nbsp;
				{{ TransWord::getArabic('Retail')}} {{ Form::checkbox('retail', true, (Input::has('retail') &&  Input::get('retail') ? true : null)) }} 
			-->
				{{ Form::checkbox('special_offer', true, (Input::has('special_offer') &&  Input::get('special_offer') ? true : null), array('id'=>'special_offer')) }}
				<label for="{{'special_offer'}}">{{ TransWord::getArabic('Special offer',false)}}  &nbsp; &nbsp;<span></span></label>
			</div>
			
			<div class='col-md-40 ad_filter_col'>
				<button class='ad_filter_submit' /> 
					<span class='icon-6 ad_filter_submit__icon'></span> {{ TransWord::getArabic('Search',false)}}
				</button>
				
				<div class='ad_filter_result'> 
					{{ TransWord::getArabic('Results',false)}} <strong>{{ (isset($total_count) ? $total_count : 0) }}</strong>
				</div>
			</div>
			<div class='col-md-15 ad_filter_col top5 m-top5'>
				<span class="reset_filters_bg ">&nbsp;</span><a href='?reset=1' class='ad_filter_reset_link'>{{ TransWord::getArabic('Reset filters',false)}} </a>
			</div>
		</div>
	</div>
	<div class='ad_filter_switch'>
		<div class="ad_filter_switch_button">
			<i class="c-postmore__icon_up js-switch-filter"></i>
		</div>
	</div>
</div>
{{ Form::hidden('filter', 1) }}
{{ Form::close() }}

<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
        google.maps.event.addListener(places, 'place_changed', function () {

        });
    });
</script>