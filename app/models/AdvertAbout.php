<?php
class AdvertAbout extends Eloquent {
	protected $table = 'advert_about';
    protected $fillable = array('advert_id', 'note');
    public $timestamps = false;
    
}
