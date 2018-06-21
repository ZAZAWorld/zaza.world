<?php
class Company extends Eloquent {
    protected $table = 'companies';
    protected $fillable = array('title', 'web_site', 'user_id', 'is_vip', 'created_at', 'updated_at', 'status_id', 'deleted_at', 'is_restorant',
								'short_name', 'photo', 'activity', 'phone', 'mobile', 'location', 'branches', 'size_company', 'active_since',
								'more_info', 'auto_brand_id', 'auto_model_id', 'total_views', 'visitors_today', 'visitor_today_day', 'greeting', 
								'is_greeting', 'total_like', 'whosale', 'retail', 'moderator_id', 'gps_lan', 'gps_lat', 'is_callback',
								'onlain_index', 'created_unix', 'modarete_time', 'is_top', 'count_top');
								
	public static function boot() {
		$res = parent::boot();
		static::created(function($model){
			$model->sendMessageRegistration();
			$model->setStatCreated();
			
			$model->setCreatedUnixTime();
			
            return true;
        });

		return $res;
	}
	
	function setCreatedUnixTime (){
		$this->created_unix = time();
		$this->save();
	}
	
	public function getIdSpecAttribute(){
		$id = str_pad($this->id, 5, '0', STR_PAD_LEFT);
		
		if ($this->is_restorant)
			return 'DO'.$id;
			
		if (CompanyCat::where(array('company_id'=>$this->id, 'type_id'=>2))->count() > 0) 	
			return 'SP'.$id;
		
		return 'SH'.$id;
	}
	
	public function getCreatedTimeSpecAttribute(){
		if (!$this->created_unix)
			return null;
			
		return date('h:i:s', $this->created_unix);
	}
	
	public function getModareteTimeSpecAttribute(){
		if (!$this->modarete_time)
			return null;
			
		return date('d.m.Y h:i:s', $this->modarete_time);
	}

	function sendMessageRegistration () {
		$user = $this->relUser;
		if (!$user || !$user->email)
			return false;

		MailSend::sendMessageRegistration($user);
	}
	
	function setStatCreated(){
		$el = StatUserRegistration::where(array('user_id'=>$this->user_id))->first();
		if (!$el)
			return false;
			
		if ($this->is_restorant == 1)
			$user_type = 'restoran';
		else if ($this->is_restorant == 0 && $this->is_vip == 0)
			$user_type = 'simple_company';
		else 
			$user_type = 'vip_company';
		
		$el->user_type = $user_type;
		$el->save();
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

	function relRestoran () {
		return $this->hasOne('CompanyRestoran', 'company_id');
	}

	function setModerator() {
		$cats = CompanyCat::where(array('company_id'=>$this->id))->get();
		$first_moderator = Moderator::orderBy('id', 'asc')->first();
		if (!$cats){
			$this->moderator_id = $first_moderator->id;
			$this->save();
			return false;
		}

		$where = array();
		foreach ($cats as $c) {
			$ar_w = array();
			$ar_w['type_id'] = 1;

			if ($c->type_id > 0)
				$ar_w['cat1_id'] = $c->type_id;
			/*
			if ($c->cat_id > 0)
				$ar_w['cat2_id'] = $c->cat_id;
			if ($c->subcat_id > 0)
				$ar_w['cat3_id'] = $c->subcat_id;
			*/
			
			$where[] = $ar_w;
		}

        if (count($where) > 0){
			$this->moderator_id = $first_moderator->id;
			$this->save();
			return false;
		}

		$ar_moderators = ModeratorRight::where(array_shift($where));
		foreach ($where as $w) {
			$ar_moderators->orWhere($w);
		}
		$ar_moderators = $ar_moderators->lists('moderator_id');

		if (count($ar_moderators) == 0){
			$this->moderator_id = $first_moderator->id;
			$this->save();
			return false;
		}

		$min_count = 0;
		$moderator_id = 0;
		foreach ($ar_moderators as $m) {
			$count = Company::where(array('moderator_id' => $m, 'status_id'=>1))->count();

			if ($moderator_id == 0) {
				$moderator_id = $m;
				$min_count = $count;
			}
			else if ($count < $min_count) {
				$moderator_id = $m;
				$min_count = $count;
			}
		}

		$this->moderator_id = $moderator_id;
		$this->save();

		return true;
	}

	function relUser () {
		return $this->belongsTo('User', 'user_id');
	}

	function getPhotoAttribute ($value) {
		if (!$value)
			return '/images/no_name.png';

		return $value;
	}

	function relCat () {
		return $this->hasMany('CompanyCat', 'company_id');
	}

	function relOneCat () {
		return $this->hasOne('CompanyCat', 'company_id');
	}

    function getPhoneAttribute ($value) {
        $ar = json_decode($value, TRUE);
		$ar = (array)$ar;
		//echo '<pre>'; print_R($ar); echo '</pre>'; exit();

        return implode(',', $ar);
    }

	function getPhoneArAttribute () {
		$ar = explode(',', $this->phone);
		$ar = (array)$ar;
		return $ar;
	}

	function setPhoneArAttribute ($value) {
        $this->attributes['phone'] = json_encode($value);
    }

    function setPhoneAttribute ($value) {
		$ar = explode(',', $value);

		if (is_array($ar)) {
			$new_ar = array();
			foreach ($ar as $v) {
				$new_ar[] = trim($v);
			}
		}
		else
			$new_ar = $value;

        //echo '<pre>'; print_r($new_ar); echo '</pre>'; exit();


        $this->attributes['phone'] = json_encode($new_ar);
    }

    function getMobileAttribute ($value) {
        $ar = json_decode($value);
		$ar = (array)$ar;
        return implode(',', $ar);
    }

	function getMobileArAttribute () {
		$ar = explode(',', $this->mobile);
		$ar = (array)$ar;
		return $ar;
	}

    function setMobileAttribute ($value) {
		$ar = explode(',', $value);

		if (is_array($ar)) {
			$new_ar = array();
			foreach ($ar as $v) {
				$new_ar[] = trim($v);
			}
		}
		else
			$new_ar = $value;

        $this->attributes['mobile'] = json_encode($new_ar);
    }
    
    public $typeasdasd = false;
    
    function getLocationAttribute ($value) {
        $ar = json_decode($value);
		$ar = (array)$ar;
		
		if ($this->typeasdasd){
		   $this->typeasdasd = false; 
		   return $ar;
		}
		
        return implode('|', $ar);
    }
	
	function getLocationGovnoAttribute ($value) {
        $ar = $this->location;
		
		$ar =  explode('|', $ar);
		
        return implode(',', $ar);
    }

	function getLocationArAttribute () {
	    $this->typeasdasd = true;
	    return $this->location;
	}

    function setLocationAttribute ($value) {
		$ar = explode('|', $value);

        $address = urlencode($ar[0]);
		$url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address;
		$response = file_get_contents($url);
		$json = json_decode($response,true);
		if (isset($json['results'][0]['geometry']['location']['lat']) && isset($json['results'][0]['geometry']['location']['lng'])){
			$this->attributes['gps_lat'] = $json['results'][0]['geometry']['location']['lat'];
			$this->attributes['gps_lan'] = $json['results'][0]['geometry']['location']['lng'];
		}

		if (is_array($ar)) {
			$new_ar = array();
			foreach ($ar as $v) {
				$new_ar[] = trim($v);
			}
		}
		else
			$new_ar = $value;

        $this->attributes['location'] = json_encode($new_ar);
    }

	public function getCreatedAtAttribute($value){
	   return ModelSnipet::formatDate($value, 'd.m.Y');
	}

	public function getUpdatedAtAttribute($value){
	   return ModelSnipet::formatDate($value, 'd.m.Y');
	}

	function checkView () {
		if (!Auth::check())
			return false;

		$com_view = CompanyView::where(array('company_id'=>$this->id, 'user_id'=>Auth::user()->id))->first();
		if (!$com_view)
			return false;

		return true;
	}

	function setView(){
		$today = date("m.d.y");
		if ($this->visitor_today_day != $today){
			$this->visitor_today_day = $today;
			$this->visitors_today = 1;
		}
		else
			$this->visitors_today = $this->visitors_today + 1;

		$this->total_views = $this->total_views + 1;
		$this->save();

		if (!Auth::check())
			return false;

		$com_view = CompanyView::where(array('company_id'=>$this->id, 'user_id'=>Auth::user()->id))->first();
		if (!$com_view){
			$com_view = new CompanyView();
			$com_view->company_id = $this->id;
			$com_view->user_id = Auth::user()->id;
			$com_view->save();
		}

		return true;
	}

	function checkLike () {
		if (!Auth::check())
			return false;

		$com_like = CompanyLike::where(array('company_id'=>$this->id, 'user_id'=>Auth::user()->id))->first();
		if (!$com_like)
			return false;

		return true;
	}

	function setLike(){
		if (!Auth::check())
			return false;

		$com_like = CompanyLike::where(array('company_id'=>$this->id, 'user_id'=>Auth::user()->id))->first();
		if (!$com_like){
			$com_like = new CompanyLike();
			$com_like->company_id = $this->id;
			$com_like->user_id = Auth::user()->id;
			$com_like->save();

			$this->total_like = $this->total_like + 1;
			$this->save();
		}


		return true;
	}


}
