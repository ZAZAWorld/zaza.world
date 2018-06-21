<?php
class SysAdvertPropOption extends Eloquent {
	protected $table = 'sys_advert_prop_options';
    protected $fillable = array( 'prop_id', 'name', 'icon');
    public $timestamps = false;

}
