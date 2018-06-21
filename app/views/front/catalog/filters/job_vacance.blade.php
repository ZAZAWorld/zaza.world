{{ Form::open(array('url'=>action('CatalogAdController@getIndex', $cat->id), 'method' => 'get', 'role'=>'form')) }}
<script src="/front/js/jquery.multiselect.js" type="text/javascript"></script>
<link href="/front/css/jquery.multiselect.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(document).ready(function(){
   $("#type").multiselect();
});
</script>

<div class='ad_filter  shadow open'>
	@include('front.catalog.filters.include.head')
	<div class='ad_filter_body'>
		<div class='ad_filter_row'>
			@if (count($sub_cats) > 0) 
				<div class='col-md-40 m-50 ad_filter_col'>
					<select name='sub_cat_id[]' class='ad_filter_input' id="type" multiple="multiple">
						<!--<option >{{ TransWord::getArabic('Type', false) }}</option>-->
						@foreach ($sub_cats as $k=>$v)
							@if (Input::has('sub_cat_id') && in_array($k,Input::get('sub_cat_id')))
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
					{{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input', 'id'=>'txtPlaces', 'placeholder'=>TransWord::getArabic('Location', false))) }}
				</div>
				<div class='col-md-50 m-50 ad_filter_col'>
					{{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Keywords', false))) }}
				</div>
			@endif
			
		</div>
		<div class='ad_filter_row'>
			<div class='col-md-20 ad_filter_col '>
				<div class='ad_filter_col__title'>
					<span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Salary') }}
				</div>
				<div class='ad_filter_col__body'>
					<div class='row'>
						<div class='col-md-45 m-45'> 
							{{ Form::text('min_salary', (Input::has('min_salary') ? Input::get('min_salary') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Min', false), 'type'=>'number')) }}
						</div>
						<div class='col-md-10 m-10' style="text-align:center; margin-top: 4px;"> 
							—
						</div>
						<div class='col-md-45 m-45'> 
							{{ Form::text('max_salary', (Input::has('max_salary') ? Input::get('max_salary') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Max', false), 'type'=>'number')) }}
						</div>
					</div>
				</div>
			</div>
			
			<div class='col-md-20 ad_filter_col'>
				<div class='ad_filter_col__title'>
					<span class='icon-18 ad_filter_col__icon'></span> {{ TransWord::getArabic('Full time') }} / {{ TransWord::getArabic('Part time') }}
				</div>
				<div class='ad_filter_col__body'>
				
				<!--
					{{  Form::select('job_time_id', array(Null=>'') + $ar_times, (Input::has('job_time_id') ? Input::get('job_time_id') : null), array('class'=>'ad_filter_input')) }}
				-->	
					
					<select name='job_time_id' class='ad_filter_input'>
						<option selected="" value=""></option>
						@foreach ($ar_times as $k=>$v)
								<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
						@endforeach
					</select>
					
				</div>
			</div>
			<div class='col-md-10 ad_filter_col top5'>
				<div class='ad_filter_col__title'>
					{{ TransWord::getArabic('Company size') }}
				</div>
				<div class='ad_filter_col__body'>
				<!--
					{{  Form::select('job_company_size', array(Null=>'') + $ar_company_size, (Input::has('job_company_size') ? Input::get('job_company_size') : null), array('class'=>'ad_filter_input')) }}
				-->
					
					<select name='job_company_size' class='ad_filter_input'>
						<option selected="" value=""></option>
						@foreach ($ar_company_size as $k=>$v)
								<option value='{{ $k }}'>{{ TransWord::getArabic($v, false) }}</option>
						@endforeach
					</select>
					
				</div>
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
