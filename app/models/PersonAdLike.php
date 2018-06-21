<?php
class PersonAdLike extends Eloquent {
	protected $table = 'person_ad_likes';
    protected $fillable = array('person_id', 'ad_id');
    public $timestamps = false;
    

}
