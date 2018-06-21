<?php
class SysAdvertFileType extends Eloquent {
	protected $table = 'sys_advert_file_type';
    protected $fillable = array( 'name');
    public $timestamps = false;
    
}
