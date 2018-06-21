<?php
class SysAdvertPriceType extends Eloquent {
	protected $table = 'sys_advert_price_types';
    protected $fillable = array( 'name');
    public $timestamps = false;

}
