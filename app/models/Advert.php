<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Advert extends Eloquent {
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'adverts';
    protected $fillable = array('title', 'user_type_id', 'user_id', 'photo', 'price', 'discount_price', 'discount_was_price','discout_date', 'urgent', 
								'hot_price', 'price_type_id', 'order_number', 'vip', 'vip_views', 'updated_at', 'created_at', 'gps', 'status_id', 'deleted_at', 
								'negotiable', 'exchange', 'free', 'auto_brand_id', 'auto_model_id', 'moderator_id', 'count_likes', 'to_be_discuss',
								'address', 'gps_lan', 'gps_lat', 'youtube', 'city_id', 'created_unix', 'is_vip_counter', 'is_green', 'is_sale', 'modarete_time', 'is_renew');
	
	public function getIdSpecAttribute(){
		$id = str_pad($this->id, 5, '0', STR_PAD_LEFT);
		
		return 'A'.$id;
	}
	
	function setPriceAttribute ($value){
		$value = str_replace(",", "", $value);
		$this->attributes['price'] = intval($value);
	}
	
	public function getDiscountWasPriceNameAttribute ($value) {
		return  number_format($this->discount_was_price);
	}
	
	public function getDiscountPriceNameAttribute ($value) {
		return  number_format($this->discount_price);
	}
	
	function setDiscountWasPriceAttribute ($value){
		$value = str_replace(",", "", $value);
		$this->attributes['discount_was_price'] = intval($value);
	}
	
	function setDiscountPriceAttribute ($value){
		$value = str_replace(",", "", $value);
		$this->attributes['discount_price'] = intval($value);
	}
	
	public static function boot() {
		$res = parent::boot();
		static::created(function($model){
			$model->sendMessageAdvertAdd();
			$model->setCreatedStat();
			$model->setCreatedUnixTime();
			
            return true;
        });
		
		static::deleted(function($model){
			$model->setLetterForDelete();
		});
		
		
		
		return $res;
	}
	
	function getTimeEndSale() {
		$pay = AdvertPay::where('advert_id', $this->id)->where('type_id', 3)->first();
		$pay_2 = AdvertPay::where('advert_id', $this->id)->where('type_id', 4)->first();
		if (!$pay && !$pay_2)
			return 0;
		
		if ($pay)
			return $pay->deleted_unix;
		if ($pay_2)
			return $pay_2->deleted_unix;
	}
	
	function getTimeStartSale() {
		$pay = AdvertPay::where('advert_id', $this->id)->where('type_id', 3)->first();
		$pay_2 = AdvertPay::where('advert_id', $this->id)->where('type_id', 4)->first();
		if (!$pay && !$pay_2)
			return 0;
		
		if ($pay)
			return $pay->start_date;
		if ($pay_2)
			return $pay_2->start_date;
	}
	
	function setLetterForDelete () {
		MailSend::sendMessageAdvertModerateFalse($this);
	}
	
	function setCreatedUnixTime (){
		$this->created_unix = time();
		$this->save();
	}
	
	function sendMessageAdvertAdd () {
		$user = $this->relUser;
		if (!$user || !$user->email)
			return false;
			
		MailSend::sendMessageAdvertAdd($this);
	}
	
	function setCreatedStat () {
		$user = $this->relUser;
		
		$created_date = date('Y-m-d');
		$el = StatAdCreated::where(array('user_id'=>$user->id, 'created_date'=>$created_date, 'advert_id'=>$this->id))->first();
		if ($el)
			return true;
			
		$user_type = 'undefined';
		if ($user->user_type_id == 3)
			$user_type = 'person';
		else if ($user->user_type_id == 4){
			$company = $user->relCompany;

			if ($company->is_restorant == 1)
				$user_type = 'restoran';
			else if ($company->is_restorant == 0 && $company->is_vip == 0)
				$user_type = 'simple_company';
			else if ($company->is_restorant == 0 && $company->is_vip != 0)
				$user_type = 'vip_company';
		}
		
		$el = new StatAdCreated();
		$el->user_id = $user->id;
		$el->created_date = date('Y-m-d');
		$el->user_type = $user_type;
		$el->advert_id = $this->id;
		$el->moderator_status = 1;
		$el->save();
	}
	
	public function setStatusIdAttribute($status_id){
		$this->attributes['status_id'] = $status_id;
		
		$user = $this->relUser;
		if (!$user || !$user->email)
			return true;
			
		if ($status_id == 2) 
			MailSend::sendMessageAdvertModerateTrue($this);
		else if ($status_id == 3)
			MailSend::sendMessageAdvertModerateFalse($this);
			
		$el_stat = StatAdCreated::where(array('advert_id'=>$this->id))->first();
		if ($el_stat){
			$el_stat->moderator_status = $status_id;
			$el_stat->save();
		}
	}
	
	function getPhotoAttribute ($value) {
		if (!$value)
			return '/images/no_name.png';
			
		return $value;
	}
	
	function relAbout () {
		return $this->hasOne('AdvertAbout', 'advert_id');
	}
	
	static function getStatusAr () {
		return array(
			null => 'Note have status', 
			0 => 'Note have status', 
			1 => 'Created',
			2 => 'Approved',
			3 => 'Canceled'
		);
	}
	
	function relCat () {
		return $this->hasMany('AdvertCat', 'advert_id');
	}
	
	function relOneCat () {
		return $this->hasOne('AdvertCat', 'advert_id');
	}
	
	function relUser () {
		return $this->belongsTo('User', 'user_id');
	}

	public function getCreatedAtAttribute($value){
	   return ModelSnipet::formatDate($value, 'd.m.Y');
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
	
	function getPriceAttribute ($price) {
		
		
		return $price;
	}
	
	public function getPriceNameAttribute () {
		if (!$this->price){
			$cat = $this->relOneCat;
			if ($cat->cat1_id == 3) {
				$prop = AdvertProp::where(array('advert_id'=>$this->id ,'prop_id'=>46))->first();
				if ($prop){
					$option_val = str_replace(",", "", $prop->option_val);
					$this->price = intval($option_val);
					$this->save();
				}
			}
		}
		
		return  number_format($this->price);
	}
	
	function getSpecPriceNameAttribute () {
		if (!$this->price){
			$cat = $this->relOneCat;
			if ($cat->cat1_id == 3) {
				$prop = AdvertProp::where(array('advert_id'=>$this->id ,'prop_id'=>46))->first();
				if ($prop){
					$option_val = str_replace(",", "", $prop->option_val);
					$this->price = intval($option_val);
					$this->save();
				}
			}
		}
		
		if (!$this->is_sale)
			return number_format($this->price);
			
		return '<s>'.$this->discount_was_price_name.' </s>&nbsp;&nbsp;&nbsp;'.$this->discount_price_name;
	}
	
	function getSpecPriceTwoNameAttribute () {
		if (!$this->price){
			$cat = $this->relOneCat;
			if ($cat->cat1_id == 3) {
				$prop = AdvertProp::where(array('advert_id'=>$this->id ,'prop_id'=>46))->first();
				if ($prop){
					$option_val = str_replace(",", "", $prop->option_val);
					$this->price = intval($option_val);
					$this->save();
				}
			}
		}
		
		if (!$this->is_sale)
			return number_format($this->price);
			
		return '<s>'.$this->discount_was_price_name.' </s>&nbsp;&nbsp;&nbsp;<span style="color:green">'.$this->discount_price_name.'</span>';
	}
	
	function setModerator() {
		$cat = AdvertCat::where(array('advert_id'=>$this->id))->first();
		$first_moderator = Moderator::orderBy('id', 'asc')->first();
		if (!$cat){
			$this->moderator_id = $first_moderator->id;
			$this->save();
			return false;
		}
			
		
		//$ar_moderators = ModeratorRight::where(array('type_id'=>2, 'cat1_id'=>$cat->cat1_id, 'cat2_id'=>$cat->cat2_id))->lists('moderator_id');
		$ar_moderators = ModeratorRight::where(array('type_id'=>2, 'cat1_id'=>$cat->cat1_id))->lists('moderator_id');
		
		if (count($ar_moderators) == 0){
			$this->moderator_id = $first_moderator->id;
			$this->save();
			return false;
		}
		
		$min_count = 0;
		$moderator_id = 0;
		foreach ($ar_moderators as $m) {
			$count = Advert::where(array('moderator_id' => $m, 'status_id'=>1))->count();
			
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
	
	function checkView () {
		if (!Auth::check()) 
			return false;
		
		$advert_view = AdvertView::where(array('advert_id'=>$this->id, 'user_id'=>Auth::user()->id))->first();
		if (!$advert_view)
			return false;
			
		return true;
	}
	
	function setView(){
		$this->vip_views = $this->vip_views + 1;
		$this->save();
		
		
		if (!Auth::check()) {
			AdvertView::setNoteAuthView($this->id);
			return true;
		}
		
		$time = time() - (60 * 60 * 24);
		$advert_view = AdvertView::where(array('advert_id'=>$this->id, 'user_id'=>Auth::user()->id))->where('created_unix', '>', $time)->first();
		if (!$advert_view){
			$advert_view = new AdvertView();
			$advert_view->advert_id = $this->id;
			$advert_view->user_id = Auth::user()->id;
			$advert_view->save();
		}
		
		
		return true;	
	}
	
	function checkLike () {
		if (!Auth::check()) 
			return false;
		
		$advert_like = AdvertLike::where(array('advert_id'=>$this->id, 'user_id'=>Auth::user()->id))->first();
		if (!$advert_like)
			return false;
			
		return true;
	}
	
	function setLike(){
		if (!Auth::check()) 
			return false;
			
		$advert_like = AdvertLike::where(array('advert_id'=>$this->id, 'user_id'=>Auth::user()->id))->first();
		if (!$advert_like){
			$advert_like = new AdvertLike();
			$advert_like->advert_id = $this->id;
			$advert_like->user_id = Auth::user()->id;
			$advert_like->save();
			
			$this->count_likes = $this->count_likes + 1;
			$this->save();
		}
		else 
			$this->deleteLike();
		
		
		return true;	
	}
	
	function deleteLike(){
		if (!Auth::check()) 
			return false;
			
		$advert_like = AdvertLike::where(array('advert_id'=>$this->id, 'user_id'=>Auth::user()->id))->first();
		$advert_like->delete();
		
		$this->count_likes = $this->count_likes - 1;
		$this->save();
		
		return true;	
	}
	
	function setAddressAttribute ($value){
		$this->attributes['address'] = strtolower($value);
		
		$address = urlencode($value);
		$url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address;
		$response = file_get_contents($url);
		$json = json_decode($response,true);
		if (isset($json['results'][0]['geometry']['location']['lat']) && isset($json['results'][0]['geometry']['location']['lng'])){
			$this->attributes['gps_lat'] = $json['results'][0]['geometry']['location']['lat'];
			$this->attributes['gps_lan'] = $json['results'][0]['geometry']['location']['lng'];
		}
		
	}
	
	function setYoutubeAttribute ($value){
		if (!$value){
			$this->attributes['youtube'] = $value;
			return false;
		}
		
		if (strpos($value, 'youtu') == false){
			$this->attributes['youtube'] = $value;
			return false;
		}
		
		$value = explode("/", $value);
		$value = end($value);
		
		if (strpos($value, 'atch?') == true){
			$value = substr($value, 8, strlen($value));
		}
		
		$this->attributes['youtube'] = $value;
	}

	function relLike () {
		return $this->hasMany('AdvertLike', 'advert_id');
	}
	
	
	function sendLetterRemenderForRenew () {
		MailSend::sendAdRenewAdvert($this);
		$this->ololo_for_ololo_very_important_note_delete = 1;
		$this->save();
	}
}
