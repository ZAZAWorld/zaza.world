<?php
class AdvertLike extends Eloquent {
	protected $table = 'advert_like';
    protected $fillable = array('advert_id', 'user_id');
    public $timestamps = false;
	
	
}