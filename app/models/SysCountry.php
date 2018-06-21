<?php
class SysCountry extends Eloquent {
	protected $table = 'sys_countries';
    protected $fillable = array('name', 'code');
    
}
