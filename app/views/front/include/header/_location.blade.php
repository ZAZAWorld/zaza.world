<div class="col-lg-10 col-md-15 col-sm-15 m-location js-tooltip-location"
		data-tooltip='@foreach (SysCity::lists('name', 'id') as $city_id=>$city_name) 
							<a href="/change-city/{{ $city_id }}">{{TransWord::getArabic($city_name)}} </a><br/> 
						@endforeach'>
    <a href="#location" class="m-location__link">
        <image src="/front/img/flag.png" class="m-location__image" />
        <span class='m-location__name'>{{ TransWord::getArabic(SysCity::getUserCity()) }}</span>
    </a>
</div>
