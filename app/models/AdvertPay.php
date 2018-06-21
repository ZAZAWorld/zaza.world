<?php
class AdvertPay extends Eloquent {
	protected $table = 'advert_pays';
    protected $fillable = array('advert_id', 'type_id', 'deleted_unix', 'is_close', 'created_unix');
    public $timestamps = false;
    
	static function getTypeAr () {
		return array(
			1 => 'green',
			2 => 'sale',
			3 => 'hot_deal',
			4 => 'urgent',
			5 => 'is_vip'
		);
	}
	
	static function getTypeCostAr () {
		return array(
			1 => 0,
			2 => 0,
			3 => 0,
			4 => 0,
			5 => 0.25
		);
	}
	
	function relAdvert() {
		return $this->belongsTo('Advert', 'advert_id');
	}
	
	function getDeletedDateAttribute () {
		return date("Y-m-d h:i:s", $this->deleted_unix);
	}
	
	function getStartDateAttribute () {
		return date("Y-m-d h:i:s", $this->created_unix);
	}
}
