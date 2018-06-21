<?php
class SysCompanyCat extends Eloquent {
	
	protected $table = 'sys_company_cats';
    public $timestamps = false;
    protected $fillable = array('name', 'type_id');

	function relChilds () {
		return $this->hasMany('SysCompanyCat', 'parent_id');
	}
}
