<?php
class Weather extends Eloquent {
	protected $table = 'weather';
    protected $fillable = array('api_city_id', 'temper', 'type');
    static $api_key = '5eda7d04909f2c1f3d749112e6f4ebf9';
	static $ar_icons_day = array(
		'clear sky' => '01.png', 'few clouds' => '04.png', 'scattered clouds' => '08.png',
		'broken clouds' => '11.png', 'shower rain' => '12.png', 'rain' => '13.png',
		'thunderstorm' => '15.png', 'snow' => '22.png', 'mist' => '05.png'
	);
	static $ar_icons_night = array(
		'clear sky' => '33.png', 'few clouds' => '36.png', 'scattered clouds' => '08.png',
		'broken clouds' => '37.png', 'shower rain' => '12.png', 'rain' => '39.png',
		'thunderstorm' => '42.png', 'snow' => '44.png', 'mist' => '37.png'
	);

    static function setData($api_city_id) {
        $api = static::$api_key;
        $weather = file_get_contents('http://api.openweathermap.org/data/2.5/weather?id='.$api_city_id.'&units=metric&appid='.$api);
    	$weather = json_decode($weather);

        if ($weather->cod != 200)
            return static::where('api_city_id', $api_city_id)->orderBy('id', 'desc')->first();

        $text = $weather->weather;
    	$text = array_shift($text);

        $item = new Weather();
        $item->api_city_id = $api_city_id;
        $item->temper = $weather->main->temp;
        $item->type = $text->description;
        $item->save();

        return $item;

    }

    static function getData($api_city_id) {
        $item = Weather::where('api_city_id', $api_city_id)->where('created_at', 'like', date('Y-m-d').'%')->remember(60)->first();
        if (!$item)
            $item = static::setData($api_city_id);

        return $item;
    }

    static function setDataAll() {
        $ar_city = SysWeatherCity::where('api_city_id', '>', 0)->lists('api_city_id');

        foreach ($ar_city as $city_id) {
            static::getData($city_id);
        }

        return true;
    }

	static function gerArIcons () {
		$time = new DateTime();
		$time->setTimezone(new DateTimeZone('Asia/Dubai'));

		$hour =  $time->format('G');
		
		if ($hour > 6 && $hour < 19){			
			return static::$ar_icons_day;	
		}
		else{
			return static::$ar_icons_night;
			
		}

		
	}

	function getIconAttribute () {
		$ar_icons = static::gerArIcons();

		if (!isset($ar_icons[$this->type]))
			return $ar_icons['clear sky'];

		return $ar_icons[$this->type];
	}

	function getTemperAttribute ($value) {
		$value = round($value);
		$value = $value.'&deg;';

		if ($value == 0)
			return $value;

		if ($value < 0)
			return ' - '.$value;

		return ' + '.$value;
	}
}
