<?php
class SysAdAutoModel extends Eloquent {
	protected $table = 'sys_ad_auto_model';
    protected $fillable = array( 'name', 'brand_id');
    public $timestamps = false;
	
}
