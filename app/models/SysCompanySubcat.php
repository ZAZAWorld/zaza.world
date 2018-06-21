<?php
class SysCompanySubcat extends Eloquent {
	protected $table = 'sys_company_subcats';
    public $timestamps = false;
    protected $fillable = array('name', 'parent_id');
	
}
