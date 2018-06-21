<?php
class SysAdvertPropCat extends Eloquent {
	protected $table = 'sys_advert_prop_cats';
    protected $fillable = array( 'prop_id', 'cat1_id', 'cat2_id', 'cat3_id', 'cat4_id');
    public $timestamps = false;
    
}
