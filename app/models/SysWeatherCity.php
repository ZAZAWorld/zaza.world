<?php
class SysWeatherCity extends Eloquent {
	protected $table = 'sys_weather_cities';
    protected $fillable = array('city_id', 'api_city_id');


	static function getApiCityID ($city_id) {
		$city = SysWeatherCity::where('city_id', $city_id)->first();
		return $city->api_city_id;
	}
}
