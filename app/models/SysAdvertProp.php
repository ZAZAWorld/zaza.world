<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class SysAdvertProp extends Eloquent {
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'sys_advert_props';
    protected $fillable = array('name', 'icon', 'type_id', 'is_many', 'is_option');
    public $timestamps = false;

	function getIsManyNameAttribute () {
		if ($this->is_many)
			return 'Many';

		return 'single';
	}
	
	function relPropCat () {
		return $this->hasMany('SysAdvertPropCat', 'prop_id');
	}
	
	function relPropOption () {
		return $this->hasMany('SysAdvertPropOption', 'prop_id');
	}

	function getIsOptionNameAttribute () {
		if ($this->is_option)
			return 'has option';

		return "hasn't option";
	}

	static function getArIcon () {
		return array('icon-1'=>'icon-1', 'icon-12'=>'icon-12', 'icon-122'=>'icon-122', 'icon-13'=>'icon-13', 'icon-14'=>'icon-14', 'icon-15'=>'icon-15', 'icon-2'=>'icon-2', 'icon-3'=>'icon-3',
			'icon-4'=>'icon-4', 'icon-5'=>'icon-5', 'icon-6'=>'icon-6', 'icon-10'=>'icon-10', 'icon-11'=>'icon-11', 'icon-1222'=>'icon-1222', 'icon-132'=>'icon-132', 'icon-142'=>'icon-142', 'icon-152'=>'icon-152',
			'icon-16'=>'icon-16', 'icon-17'=>'icon-17', 'icon-18'=>'icon-18', 'icon-19'=>'icon-19', 'icon-20'=>'icon-20', 'icon-21'=>'icon-21', 'icon-22'=>'icon-22', 'icon-23'=>'icon-23', 'icon-24'=>'icon-24',
			'icon-25'=>'icon-25', 'icon-26'=>'icon-26', 'icon-27'=>'icon-27', 'icon-28'=>'icon-28', 'icon-29'=>'icon-29', 'icon-30'=>'icon-30', 'icon-31'=>'icon-31', 'icon-32'=>'icon-32', 'icon-33'=>'icon-33',
			'icon-34'=>'icon-34', 'icon-35'=>'icon-35', 'icon-36'=>'icon-36', 'icon-37'=>'icon-37', 'icon-38'=>'icon-38', 'icon-39'=>'icon-39', 'icon-40'=>'icon-40', 'icon-41'=>'icon-41', 'icon-42'=>'icon-42',
			'icon-43'=>'icon-43', 'icon-44'=>'icon-44', 'icon-46'=>'icon-46', 'icon-47'=>'icon-47', 'icon-48'=>'icon-48', 'icon-49'=>'icon-49', 'icon-50'=>'icon-50', 'icon-51'=>'icon-51', 'icon-52'=>'icon-52', 'icon-53'=>'icon-53', 'icon-54'=>'icon-54',
			'icon-55'=>'icon-55', 'icon-56'=>'icon-56', 'icon-57'=>'icon-57', 'icon-58'=>'icon-58', 'icon-59'=>'icon-59', 'icon-61'=>'icon-61', 'icon-62'=>'icon-62', 'icon-63'=>'icon-63', 'icon-64'=>'icon-64', 'icon-65'=>'icon-65', 'icon-66'=>'icon-66',
			'icon-67'=>'icon-67', 'icon-68'=>'icon-68', 'icon-70'=>'icon-70', 'icon-71'=>'icon-71', 'icon-72'=>'icon-72', 'icon-73'=>'icon-73', 'icon-74'=>'icon-74', 'icon-75'=>'icon-75', 'icon-76'=>'icon-76', 'icon-77'=>'icon-77', 'icon-78'=>'icon-78',
			'icon-80'=>'icon-80', 'icon-81'=>'icon-81', 'icon-82'=>'icon-82', 'icon-84'=>'icon-84', 'icon-85'=>'icon-85', 'icon-86'=>'icon-86', 'icon-87'=>'icon-87', 'icon-88'=>'icon-88', 'icon-89'=>'icon-89', 'icon-90'=>'icon-90', 'icon-91'=>'icon-91',
			'icon-92'=>'icon-92', 'icon-110'=>'icon-110', 'icon-111'=>'icon-111', 'icon-112'=>'icon-112', 'icon-113'=>'icon-113', 'icon-114'=>'icon-114', 'icon-191'=>'icon-191', 'icon-192'=>'icon-192');
	}

	static function getArIconWithSpan () {
		$ar = array();
		$icons= static::getArIcon();
		foreach ($icons as $k=>$v) {
			$icons[$k] = "<span class='".$v."'> </span>";
		}

		return $icons;
	}
	
	function getOptionAr () {
		$ar = array();
		$options = $this->relPropOption;
		foreach ($options as $op) {
			$ar[$op->id] = $op->name;
		}
		
		return $ar;
	}
}
