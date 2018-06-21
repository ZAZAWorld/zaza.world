<?php
class AdvertCat extends Eloquent {
	protected $table = 'advert_cats';
    protected $fillable = array('advert_id', 'cat1_id', 'cat2_id', 'cat3_id', 'cat4_id');
    public $timestamps = false;
	
}
