<?php
class AdvertFile extends Eloquent {
	protected $table = 'advert_files';
    protected $fillable = array('advert_id', 'name', 'file', 'file_format', 'type_id');
    public $timestamps = false;

}
