<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';
	protected $fillable = array( 'f_name', 'l_name', 'login', 'email', 'password', 'change_password','remember_token', 'active', 'country_id', 'city_id', 'lang_id', 
									'user_type_id', 'created_at', 'updated_at', 'last_visit', 'location', 'is_active', 'confirm_active');
	protected $hidden = array('password', 'remember_token');
	
	protected static $rules = [
		'email'=>'unique:users', 'password'=>'required|min:6', 'user_type_id'=>'required|numeric'
	];


    function setActiveChecker ($phone = '') {
        $this->confirm_active = rand(1000000,9999999);
        $this->is_active = 0;
        $this->save();
        if($this->user_type_id == 3) {
            $text = 'Activation code for zaza.ae:'.$this->confirm_active;
            MailSend::sendSms($phone, $text);
        }
        else {
            MailSend::send($this->email,
                'Activation of account with zaza.ae',                
'Follow <a href="https://zaza.ae/activate-account?user_id=' . $this->id . '&pass=' . $this->confirm_active . '">this link</a> to activate your account
						<div style="margin-top:40px"><img src="https://zaza.ae/images/logo.png" width="130" /></div>'
            );
        }
    }
	
	function checkActiveChecker($pass){
		/*echo $this->confirm_active. '<br />';
		echo $pass; exit();
		*/
		if ($this->is_active)
			return true;
		
		if ($pass != $this->confirm_active)
			return false;
		
		$this->is_active = 1;
		$this->save();
		
		return true;
	}
	
	public static function boot() {
		$res = parent::boot();
		static::created(function($model){
			$model->setCreatedUserStat();
			$model->setBudjet();
		
            return true;
        });

		return $res;
	}
	
	function setBudjet () {
		$user = $this;
		Budjet::createAndFill($user);
	}
	
	function setCreatedUserStat () {
		$user = $this;
		$created_date = date('Y-m-d');
		$el = StatUserRegistration::where(array('user_id'=>$this->id, 'created_date'=>$created_date))->first();
		if ($el)
			return true;
			
		$user_type = 'undefined';
		if ($this->user_type_id == 3)
			$user_type = 'person';
		else if ($this->user_type_id == 4){
			$company = $this->relCompany;
			if ($company){
				if ($company->is_restorant == 1)
					$user_type = 'restoran';
				else if ($company->is_restorant == 0 && $company->is_vip == 0)
					$user_type = 'simple_company';
				else if ($company->is_restorant == 0 && $company->is_vip != 0)
					$user_type = 'vip_company';
			}
			$user_type = 'company';
		}
		
		$el = new StatUserRegistration();
		$el->user_id = $user->id;
		$el->created_date = date('Y-m-d');
		$el->user_type = $user_type;
		$el->save();
	}
	
	function checkUserOnlain () {
		$user_last_time = strtotime($this->last_visit);
		$current_last_time = strtotime("now") - (60 * 5);
		if ($user_last_time < $current_last_time)
			return false;
		
		return true;
	}
	
	function relDialogs () {
        return $this->belongsToMany('MsgDialog', 'msg_dialog_users', 'user_id', 'dialog_id');
    }

	
	function getEmailAttribute ($value) {
		if (!$value)
			return 'no email';

		return $value;
	}

	public function getPhotoAttribute () {
		$photo = '';
		if ($this->user_type_id == 3)
			$photo = $this->relPerson->photo;

		if ($this->user_type_id == 4)
			$photo = $this->relCompany->photo;
		
		if (!$photo)
			$photo = '/images/no_name.png';
			
		return $photo;
	}
	
	public function getFullNameAttribute (){
		if ($this->user_type_id == 3)
			return $this->relPerson->full_name;

		if ($this->user_type_id == 4)
			return $this->relCompany->title;
	}

	public function relPerson () {
		return $this->hasOne('Person', 'user_id', 'id');
	}

	public function relCompany () {
		return $this->hasOne('Company', 'user_id', 'id');
	}
	
	function relModarator () {
		return $this->hasOne('Moderator', 'user_id', 'id');
	}
	
	static function setLastVizit () {
		if (!Auth::check())
			return false;
		

		$user = Auth::user();
		$user->last_visit = date('Y-m-d H:i');
		$user->save();
		
		
		UserOnlianStat::setOnlain($user);
		
		$date_key = date('Ymd');
		if (Session::has('onlain_counter.'.$date_key)) 
			return true;
			
		Session::put('onlain_counter.'.$date_key, 1);
		
		$created_date = date('Y-m-d');
		$el = StatUserOnlain::where(array('user_id'=>$user->id, 'created_date'=>$created_date))->first();
		if ($el)
			return true;
			
		$user_type = 'undefined';
		if ($user->user_type_id == 3)
			$user_type = 'person';
		else if ($user->user_type_id == 4){
			$company = Auth::user()->relCompany;

			if ($company->is_restorant == 1)
				$user_type = 'restoran';
			else if ($company->is_restorant == 0 && $company->is_vip == 0)
				$user_type = 'simple_company';
			else if ($company->is_restorant == 0 && $company->is_vip != 0)
				$user_type = 'vip_company';
		}
		
		$el = new StatUserOnlain();
		$el->user_id = $user->id;
		$el->created_date = date('Y-m-d');
		$el->user_type = $user_type;
		$el->save();
		
		return true;
	}
	
	static function getCurrentOnlainUser(){
		$date = new DateTime();
		
		if (Cache::has('onlain_users_time') && Cache::get('onlain_users_time') == $date->format('Y-m-d H:i'))
			return Cache::get('onlain_users_count') + 2;
		
		Cache::forever('onlain_users_time', $date->format('Y-m-d H:i'));
		
		$date->modify('-2 minutes');
		$count_users = User::where('last_visit', '>=', $date->format('Y-m-d H:i'))->count();
		
		Cache::forever('onlain_users_count', $count_users);
		
		return $count_users + 2;
	}

	function relSocials () {
		return $this->hasOne('Social', 'user_id');
	}

	function getLastVisitViewAttribute () {
		return ModelSnipet::formatDate($this->last_visit, 'd/m/y H:i');
	}

	function getLocationNameAttribute () {
		$country = SysCountry::find($this->country_id);
		$country = (!$country ? 'UAE' : $country->code);

		$city = SysCity::find($this->city_id);
		$city = (!$city ? 'UAE' : $city->name);

		return $city.','.$country;
	}
	/*
	function getLocationAttribute ($value) {
		if (!$value)
			return 'UAE, abu dabi';

		return $value;
	}
	*/

	function relSocial () {
		return $this->hasOne('Social', 'user_id');
	}

	function getPhoto () {
		return $this->photo;
	}

	function getContactNumber () {
		if ($this->user_type_id == 3) {
			return $this->relPerson->mobile;
		}

		if ($this->user_type_id == 4) {
			
			return $this->relCompany->mobile;
		}

		return null;
	}

	function getName () {
		if ($this->user_type_id == 3) {
			$name = $this->relPerson->full_name;
			$name = explode(" ", $name);
			$name = implode("<br/>", $name);
			return $name;
		}
	}
	
	function getPhoneAttribute ($value) {
		if ($this->user_type_id == 3)
			return $this->relPerson->phone;

		if ($this->user_type_id == 4)
			return $this->relCompany->phone;
	}
	
	function getIdSpecAttribute () {
		if ($this->user_type_id == 3)
			return $this->relPerson->id_spec;

		if ($this->user_type_id == 4)
			return $this->relCompany->id_spec;
	}
	
	
	function getMobileAttribute ($value) {
		if ($this->user_type_id == 3)
			return $this->relPerson->mobile;

		if ($this->user_type_id == 4)
			return $this->relCompany->mobile;
	}

	function relBudjet (){
		return $this->hasOne('Budjet', 'user_id');
	}

}
