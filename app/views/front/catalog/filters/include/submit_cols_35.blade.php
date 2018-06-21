<div class='col-md-35 top15 ad_filter_col filter_submit'>
	<button class='ad_filter_submit' /> 
		<span class='icon-6 ad_filter_submit__icon'></span> {{ TransWord::getArabic('Search',false) }}
	</button>
	
	<div class='ad_filter_result'> 
		{{ TransWord::getArabic('Results',false) }} <strong>{{ (isset($advert_count) ? $advert_count : 0) }}</strong>
	</div>
</div>
<div class='col-md-21 top15 ad_filter_col' style="float:right;">
	<span class="reset_filters_bg ">&nbsp;</span><a href='?reset=1' class='ad_filter_reset_link'>{{ TransWord::getArabic('Reset filters',false) }} </a>
</div>