@extends('front.layout')



@section('content')

    @include('front.index.slider')

	@include('front.index.company-icons')
    @include('front.index.advert-icons')
    
    @include('front.index.footer-search')
    @include('front.include.right-buttons')
	
	<div class='ad_filter open shadow '>
		<h2 class='ad_filter_title'>Property/Property for sale</h2>
		<div class='ad_filter_body'>
			<div class='ad_filter_row'>
				<div class='col-md-25 ad_filter_col'>
					{{  Form::select('category_id', array(Null=>''), (Input::has('category_id') ? Input::get('category_id') : null), array('class'=>'ad_filter_input')) }}
				</div>
				<div class='col-md-25 ad_filter_col'>
					{{  Form::select('property_type', array(Null=>''), (Input::has('property_type') ? Input::get('property_type') : null), array('class'=>'ad_filter_input')) }}
				</div>
				<div class='col-md-25 ad_filter_col'>
					{{ Form::text('name', (Input::has('property_type') ? Input::get('property_type') : null), array('class'=>'ad_filter_input')) }}
				</div>
				<div class='col-md-25 ad_filter_col'>
					{{ Form::text('name', (Input::has('property_type') ? Input::get('property_type') : null), array('class'=>'ad_filter_input')) }}
				</div>
			</div>
			<div class='ad_filter_row'>
				<div class='col-md-25 ad_filter_col '>
					<div class='ad_filter_col__title'>
						<span class='icon-38 ad_filter_col__icon'></span> Price
					</div>
					<div class='ad_filter_col__body'>
						<div class='row'>
							<div class='col-md-40'> 
								{{  Form::select('category_id', array(Null=>''), (Input::has('category_id') ? Input::get('category_id') : null), array('class'=>'ad_filter_input')) }}
							</div>
							<div class='col-md-20' style='text-align:center'> 
								-
							</div>
							<div class='col-md-40'> 
								{{  Form::select('category_id', array(Null=>''), (Input::has('category_id') ? Input::get('category_id') : null), array('class'=>'ad_filter_input')) }}
							</div>
						</div>
					</div>
				</div>
				<div class='col-md-20 ad_filter_col ad_filter_col--border'>
					<div class='ad_filter_col__title'>
						<span class='icon-38 ad_filter_col__icon'></span> Bedroom
					</div>
					<div class='ad_filter_col__body'>
						<div class='row'>
							<div class='col-md-40'> 
								{{  Form::select('category_id', array(Null=>''), (Input::has('category_id') ? Input::get('category_id') : null), array('class'=>'ad_filter_input')) }}
							</div>
							<div class='col-md-20' style='text-align:center'> 
								-
							</div>
							<div class='col-md-40'> 
								{{  Form::select('category_id', array(Null=>''), (Input::has('category_id') ? Input::get('category_id') : null), array('class'=>'ad_filter_input')) }}
							</div>
						</div>
					</div>
				</div>
				<div class='col-md-20 ad_filter_col '>
					<div class='ad_filter_col__title'>
						<span class='icon-38 ad_filter_col__icon'></span> Size
					</div>
					<div class='ad_filter_col__body'>
						<div class='row'>
							<div class='col-md-40'> 
								{{  Form::select('category_id', array(Null=>''), (Input::has('category_id') ? Input::get('category_id') : null), array('class'=>'ad_filter_input')) }}
							</div>
							<div class='col-md-20' style='text-align:center'> 
								-
							</div>
							<div class='col-md-40'> 
								{{  Form::select('category_id', array(Null=>''), (Input::has('category_id') ? Input::get('category_id') : null), array('class'=>'ad_filter_input')) }}
							</div>
						</div>
					</div>
				</div>
				<div class='col-md-10 ad_filter_col ad_filter_col--border'>
					<div class='ad_filter_col__title'>
						<span class='icon-38 ad_filter_col__icon'></span> Parking
					</div>
					<div class='ad_filter_col__body'>
						{{  Form::select('category_id', array(Null=>''), (Input::has('category_id') ? Input::get('category_id') : null), array('class'=>'ad_filter_input')) }}
					</div>
				</div>
				<div class='col-md-10 ad_filter_col'>
					<div class='ad_filter_col__title'>
						<span class='icon-38 ad_filter_col__icon'></span> Parking
					</div>
					<div class='ad_filter_col__body'>
						{{  Form::select('category_id', array(Null=>''), (Input::has('category_id') ? Input::get('category_id') : null), array('class'=>'ad_filter_input')) }}
					</div>
				</div>
				<div class='col-md-10 ad_filter_col ad_filter_col--border'>
					<div class='ad_filter_col__body'>
						<span class='icon-38 ad_filter_col__icon'></span> Parking {{ Form::checkbox('name', 'value', false) }}
					</div>
					<div class='ad_filter_col__body'>
						<span class='icon-38 ad_filter_col__icon'></span> Parking {{ Form::checkbox('name', 'value', false) }}
					</div>
				</div>
			</div>
			<div class='ad_filter_row'>
				<div class='col-md-25 ad_filter_col'>
					Negotiable {{ Form::checkbox('name', 'value', false) }} &nbsp;&nbsp;
					Exchange {{ Form::checkbox('name', 'value', false) }} 
				</div>
				<div class='col-md-25 ad_filter_col'>
					<div class='ad_filter_col_total_border'>
						Urgent {{ Form::checkbox('name', 'value', false) }} &nbsp;&nbsp;
						Hot deal {{ Form::checkbox('name', 'value', false) }} 
					</div>
				</div>
				<div class='col-md-25 ad_filter_col'>
					<button class='ad_filter_submit' /> 
						<span class='icon-6 ad_filter_submit__icon'></span> Submit
					</button>
					
					<div class='ad_filter_result'> 
						Results <strong>48</strong>
					</div>
				</div>
				<div class='col-md-25 ad_filter_col'>
					<a href='#link' class='ad_filter_reset_link'>Reset filters </a>
				</div>
			</div>
		</div>
		<div class='ad_filter_footer'>
			<strong>Sort by:</strong>
			<a href='#sort' class='ad_filter_footer__link' >Most cheapest</a>
			<a href='#sort' class='ad_filter_footer__link' >Most expensive</a>
			<a href='#sort' class='ad_filter_footer__link' >Most popular</a>
		</div>
		<div class='ad_filter_switch'>
			<div class="ad_filter_switch_button">
				<i class="c-postmore__icon_up js-switch-filter"></i>
			</div>
		</div>
	</div>
@stop
