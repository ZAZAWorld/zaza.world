<div class='col-md-23 ad_filter_col top45 m-60 m-top15'>
	{{ Form::checkbox('negotiable', true, (Input::has('negotiable') &&  Input::get('negotiable') ? true : null), array('id'=>'negotiable')) }} 
	<label for="{{'negotiable'}}">{{ TransWord::getArabic('Negotiable',false) }} &nbsp; <span></span></label>&nbsp;&nbsp;
	{{ Form::checkbox('exchange', true, (Input::has('exchange') &&  Input::get('exchange') ? true : null), array('id'=>'Exchange')) }} 
	<label for="{{'Exchange'}}">{{ TransWord::getArabic('Exchange',false) }}  &nbsp; <span></span></label>&nbsp;&nbsp;
	{{ Form::checkbox('free', true, (Input::has('free') &&  Input::get('free') ? true : null), array('id'=>'Free')) }} 
	<label for="{{'Free'}}">{{ TransWord::getArabic('Free',false) }} &nbsp; <span></span></label>
</div>
<div class='col-md-20 ad_filter_col top30 m-40'>
	<div class='ad_filter_col_total_border'>
		{{ Form::checkbox('urgent', true, (Input::has('urgent') &&  Input::get('urgent') ? true : null), array('id'=>'Urgent')) }} 
		<label for="{{'Urgent'}}">{{ TransWord::getArabic('Urgent',false) }} &nbsp; <span></span></label> 
		{{ Form::checkbox('hot_deal', true, (Input::has('hot_deal') &&  Input::get('hot_deal') ? true : null), array('id'=>'Hotdeal')) }}
		<label for="{{'Hotdeal'}}">{{ TransWord::getArabic('Hot deal',false) }} &nbsp; <span></span></label>   
	</div>
</div>