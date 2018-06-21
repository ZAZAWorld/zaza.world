<?php
class SysCity extends Eloquent {
	protected $table = 'sys_city';
    protected $fillable = array('name', 'country_id');

	static function getCurrentCityID () {
		if (Auth::check()){
			$user = Auth::user();
			$city = SysCity::find($user->city_id);
			return $city->id;
	    }else{
            if (Session::has('def_city_id')){
                $city = SysCity::find(Session::get('def_city_id'));
                return $city->id;
            }else{
                return static::getDefoultUserCityId();
            }
        }
    }

	static function getCityAr() {
		$ar = array();
		$items = static::with('relCountry')->orderBy('name', 'asc')->get();
		foreach ($items as $item) {
			$ar[$item->id] =  $item->name;
		}

		return $ar;
	}

 	function relCountry () {
		return $this->belongsTo('SysCountry', 'country_id');
	}
	
	static function getUserCity () {
		if (!Auth::check()){
			if (Session::has('def_city_id')){
				$city = SysCity::find(Session::get('def_city_id'));
				if (!$city)
					return static::getDefoultUserCityId();
				
				return $city->id;
			}
			else
				return static::getDefoultUserCityId();
		} 
			
			
		$user = Auth::user();
		if (!($user->city_id) > 0)
			return static::getDefoultUserCityId();
		
		$city = SysCity::find($user->city_id);
		if (!$city)
			return static::getDefoultUserCityId();
		
		return $city->id;
	}
	
	static function getDefoultUserCity() {
		return SysCity::where('id', 1)->first()->id;
	}

	static function getDefoultUserCityId() {
		return SysCity::where('id', 1)->first()->id;
	}
}
