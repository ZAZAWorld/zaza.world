<?php
class StatUserRegistration extends Eloquent {
	protected $table = 'stat_user_registration';
    protected $fillable = array('user_type', 'user_id', 'created_date');
	public $timestamps = false;
	
	function relUser () {
		return $this->belongsTo('User', 'user_id');
	}
}
