<?php $waether = Weather::getData(SysWeatherCity::getApiCityID(SysCity::getCurrentCityID())); ?>
<div class="col-md-15 col-sm-12  m-weather">
    <image src="/front/img/weather-icons/{{ $waether->icon }}" class="m-weather__image" title='{{  $waether->type }}'/>
    &nbsp;&nbsp;<span class='m-weather__value'> {{TransWord::getArabic($waether->temper,false)}}</span>
</div>
