{{ Form::open(array('url'=>action('CatalogCompanyController@getIndex', $cat->id), 'method' => 'get', 'role'=>'form')) }}
<script src="/front/js/jquery.multiselect.js" type="text/javascript"></script>
<link href="/front/css/jquery.multiselect.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(document).ready(function(){
   $("#cousine_id").multiselect({ noneSelectedText: 'Cousine'});
  
});
</script>

<div class='ad_filter  shadow open'>
	<h2 class='ad_filter_title'>{{TransWord::getArabic($parent_cat->name,false)}} / {{TransWord::getArabic($cat->name,false)}}</h2>
	<div class='ad_filter_body'>
		<div class='ad_filter_row'>
			<div class='col-md-33 ad_filter_col'>
				<select name="cousine_id[]" id="cousine_id" multiple="multiple" size="5" class="ad_filter_input">
					<!--<option >{{ TransWord::getArabic('Cousine', false) }}</option>-->
					@foreach ($ar_cousine as $k=>$v)
						@if (Input::has('cousine_id') && in_array($k, Input::get('cousine_id')))
							<option value='{{ $k }}' selected>{{ TransWord::getArabic($v, false) }}</option>
						@else 
							<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
						@endif
					@endforeach
				</select>
				
				<script type="text/javascript">
					$(function() {
						$('#cousine_id').searchableOptionList();
					});
				</script>
				
			</div>
			<div class='col-md-33 ad_filter_col'>
				{{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input location_ico', 'id'=>'txtPlaces', 'placeholder'=>TransWord::getArabic('Location',false))) }}
			</div>
			<div class='col-md-33 ad_filter_col m-width100'>
				{{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=> TransWord::getArabic('Keywords',false))) }}
			</div>
		</div>
		<div class='ad_filter_row' style="padding-top: 35px; height: 65px;">
			<div class='col-md-20 ad_filter_col price_filter' style="top: -44px;">
				<div class='ad_filter_col__title'>
					<span class='icon-38 ad_filter_col__icon'></span> {{TransWord::getArabic('Cost for 2 people',false)}}
				</div>
				<div class='ad_filter_col__body'>
					<div class='row'>
						<div class='col-md-45'> 
							{{ Form::text('min_price', (Input::has('min_price') ? Input::get('min_price') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Min',false), 'type'=>'number')) }}
						</div>
						<div class='col-md-10' style="text-align:center; margin-top: 4px;"> 
							—
						</div>
						<div class='col-md-45'> 
							{{ Form::text('max_price', (Input::has('max_price') ? Input::get('max_price') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Max',false), 'type'=>'number')) }}
						</div>
					</div>
				</div>
			</div>
			<?php $i = 1 ;?>
			@foreach ($option_ar as $k=>$v) 
				@if ($i == 6)
					<?php break;?>
				@endif
				<div class='col-md-16 ad_filter_col ' style="{{ (Input::has('option_'.$k) ? 'color: red' : null) }};">
					{{ Form::checkbox('option_'.$k, true, (Input::has('option_'.$k) ? true : null), array('id'=>'option_'.$k)) }}  &nbsp;&nbsp;
					<label for="{{'option_'.$k}}"><span></span><i class="c-png-icon {{ $v['icon'] }}"></i> &nbsp;&nbsp;
					{{TransWord::getArabic($v['name'],false)}} </label>
				</div>
				<?php 
					$i++; 
					unset($option_ar[$k]);
				?>
			@endforeach
			
			
		</div>
		<div class='ad_filter_row'>
			<div class='col-md-20 ad_filter_col ' style="{{ (Input::has('option_9') ? 'color: red' : null) }};">
				{{ Form::checkbox('option_9', true, (Input::has('option_9') ? true : null), array('id'=>'option_9')) }} &nbsp;&nbsp;
				<label for="{{'option_9'}}"><span></span><i class="c-png-icon {{ $option_romantic['icon'] }}"></i> 
				{{TransWord::getArabic($option_romantic['name'],false)}}
				</label>
			</div>
			<?php $i = 1 ;?>
			@foreach ($option_ar as $k=>$v) 
				@if ($i == 6)
					<?php break;?>
				@endif
				<div class='col-md-16 ad_filter_col ' style="{{ (Input::has('option_'.$k) ? 'color: red' : null) }};">
					{{ Form::checkbox('option_'.$k, true, (Input::has('option_'.$k) ? true : null), array('id'=>'option_'.$k)) }}  &nbsp;&nbsp;
					<label for="{{'option_'.$k}}"><span></span><i class="c-png-icon {{ $v['icon'] }}"></i> &nbsp;&nbsp;
					{{TransWord::getArabic($v['name'],false)}}
					</label>
				</div>
				<?php 
					$i++; 
					unset($option_ar[$k]);
				?>
			@endforeach
		</div>
		<div class='ad_filter_row'>
			<div class='col-md-20 ad_filter_col ' style="{{ (Input::has('option_10') ? 'color: red' : null) }};">
				{{ Form::checkbox('option_10', true, (Input::has('option_10') ? true : null), array('id'=>'option_10')) }} &nbsp;&nbsp;
				<label for="{{'option_10'}}"><span></span><i class="c-png-icon {{ $option_private['icon'] }}"></i> 
				{{TransWord::getArabic($option_private['name'],false)}} 
				</label>
			</div>
			<?php $i = 1 ;?>
			@foreach ($option_ar as $k=>$v) 
				@if ($i == 6)
					<?php break;?>
				@endif
				<div class='col-md-16 ad_filter_col ' style="{{ (Input::has('option_'.$k) ? 'color: red' : null) }};">
					{{ Form::checkbox('option_'.$k, true, (Input::has('option_'.$k) ? true : null), array('id'=>'option_'.$k)) }}  &nbsp;&nbsp;
					<label for="{{'option_'.$k}}"><span></span><i class="c-png-icon {{ $v['icon'] }}"></i> &nbsp;&nbsp;
					{{TransWord::getArabic($v['name'],false)}}
					</label>
				</div>
				<?php 
					$i++; 
					unset($option_ar[$k]);
				?>
			@endforeach
		</div>
		
		
		<div class='ad_filter_row' style="margin-top: 25px;">
			<div class='col-md-40 m-width100'>
				<div class='ad_filter_footer'>
					<strong>{{TransWord::getArabic('Sort by',false)}}:</strong>
					<a href='{{ $val_sort }}most_cheap' class='ad_filter_footer__link' style="margin:0 5px">{{TransWord::getArabic('Most cheapest',false)}}</a>
					<a href='{{ $val_sort }}most_expen' class='ad_filter_footer__link' style="margin:0 5px">{{TransWord::getArabic('Most expensive',false)}}</a>
					<a href='{{ $val_sort }}most_popul' class='ad_filter_footer__link' style="margin:0 5px">{{TransWord::getArabic('Most popular',false)}}</a>
				</div>
			</div>
			<div class='col-md-40 ad_filter_col filter_submit m-width100'>
				<button class='ad_filter_submit' /> 
					<span class='icon-6 ad_filter_submit__icon'></span> {{ TransWord::getArabic('Search',false) }}
				</button>
				
				<div class='ad_filter_result'> 
					{{TransWord::getArabic('Results',false)}} <strong>{{ (isset($total_count) ? $total_count : 0) }}</strong>
				</div>
			</div>
			<div class='col-md-15 ad_filter_col top5'>
				<span class="reset_filters_bg ">&nbsp;</span><a href='?reset=1' class='ad_filter_reset_link'>{{TransWord::getArabic('Reset filters',false)}} </a>
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