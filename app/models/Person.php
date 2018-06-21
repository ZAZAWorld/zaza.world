<?php
class Person extends Eloquent {
	protected $table = 'persons';
    protected $fillable = array('auth_id', 'auth_from', 'birzhday', 'photo', 'full_name', 'created_at', 'updated_at', 'about', 'f_name', 's_name', 'user_id', 'phone', 'mobile', 'status_id');

    static $facebook_from = 'facebook';
    static $google_from = 'google';
	
	public function getIdSpecAttribute(){
		$id = str_pad($this->id, 5, '0', STR_PAD_LEFT);
		
		return 'PА'.$id;
	}
	
	public static function boot() {
		$res = parent::boot();
		static::created(function($model){
			$model->sendMessageRegistration();
            return true;
        });
		
		return $res;
	}


	function sendMessageRegistration () {
        $user = $this->relUser;
        if ($user->email == "none")
            return false;
        else
            return  MailSend::sendMessageRegistration($user);
    }
	
	public function setStatusIdAttribute($status_id){
		$this->attributes['status_id'] = $status_id;
		
		$user = $this->relUser;
		if (!$user || !$user->email)
			return true;
			
		if ($status_id == 2) 
			MailSend::sendMessageModerateTrue($user);
		else if ($status_id == 3)
			MailSend::sendMessageModerateFalse($user);
	}
	
	function relUser () {
		return $this->belongsTo('User', 'user_id');
	}
	
    static function getFacebookFrom () {
        return static::$facebook_from;
    }

    static function getGoogleFrom () {
        return static::$google_from;
    }

	function relAdLike () {
		return $this->hasMany('PersonAdLike', 'person_id');
	}

	function relCompany () {
		return $this->hasMany('PersonCompany', 'person_id');
	}

	function relInterests () {
		return $this->hasMany('PersonInterest', 'person_id');
	}

	function getAboutAttribute ($value) {

		return $value;
	}

	function getPhoneAttribute ($value) {


		return $value;
	}

	function getMobileAttribute ($value) {


		return $value;
	}

	
}
