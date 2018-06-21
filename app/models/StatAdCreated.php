<?php
class StatAdCreated extends Eloquent {
	protected $table = 'stat_ad_created';
    protected $fillable = array('user_id', 'user_type', 'advert_id', 'created_date', 'moderator_status');
	public $timestamps = false;
	
	function relUser () {
		return $this->belongsTo('User', 'user_id');
	}
}
