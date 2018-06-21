<?php
class StatUserOnlain extends Eloquent {
	protected $table = 'stat_user_onlain';
    protected $fillable = array('user_type', 'user_id', 'created_date');
	public $timestamps = false;
	
	function relUser () {
		return $this->belongsTo('User', 'user_id');
	}
}
