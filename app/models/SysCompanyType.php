<?php
class SysCompanyType extends Eloquent {
	protected $table = 'sys_company_types';
    public $timestamps = false;
    protected $fillable = array('name');

	//static $dining = 1;
	static $shop = 3;
	static $service = 2;

	function relChilds () {
		return $this->hasMany('SysCompanyCat', 'type_id');
	}

	//static function getDiningID () {
	//	return static::$dining;
	//}

	static function getShopID () {
		return static::$shop;
	}

	static function getServiceID () {
		return static::$service;
	}
}
