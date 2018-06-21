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
				<div class='col-md-50 ad_filter_col'>
					{{ Form::text('location', (Input::has('location') ? Input::get('location') : null), array('class'=>'ad_filter_input',  'id'=>'txtPlaces', 'placeholder'=>TransWord::getArabic('Location', false))) }}
				</div>
				<div class='col-md-50 ad_filter_col'>
					{{ Form::text('keywords', (Input::has('keywords') ? Input::get('keywords') : null), array('class'=>'ad_filter_input', 'placeholder'=>TransWord::getArabic('Keywords', false))) }}
				</div>
			@endif
			
		</div>
		<div class='ad_filter_row'>
			<div class='col-md-20 ad_filter_col'>
				<div class='ad_filter_col__title'>
					<span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Full time') }} / {{ TransWord::getArabic('Part time') }}
				</div>
				<div class='ad_filter_col__body'>
					@foreach($ar_times as $k=>$v)
						{{TransWord::getArabic($v,false)}} {{ Form::checkbox('job_time_id[]', $k, (Input::has('job_time_id') && in_array($k, Input::get('job_time_id'))?  true : false), array('id'=>'job_time_id_'.$v)) }} 
						<label for="{{'job_time_id_'.$v}}">  <span></span></label>
					@endforeach
				</div>
			</div>
			<div class='col-md-15 ad_filter_col'>
				<div class='ad_filter_col__title'>
					<span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Experience') }}
				</div>
				<div class='ad_filter_col__body'>
                    {{  Form::select('job_exprience_id', array(Null=>'') + $experience_list, (Input::has('job_exprience_id') ? Input::get('job_exprience_id') : null), array('class'=>'ad_filter_input', 'id'=>'job_exprience_id')) }}
				</div>
			</div>
			<div class='col-md-20 ad_filter_col'>
				<div class='ad_filter_col__title'>
					<span class='icon-38 ad_filter_col__icon'></span> {{ TransWord::getArabic('Visa type') }}
				</div>
				<div class='ad_filter_col__body'>
					
					<!--
						{{  Form::select('job_visa_id', array(Null=>'') + $ar_visa, (Input::has('job_visa_id') ? Input::get('job_visa_id') : null), array('class'=>'ad_filter_input')) }}
					-->
					
					<select name='job_visa_id' class='ad_filter_input'>
						<option selected="" value=""></option>
						@foreach ($ar_visa as $k=>$v)
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
