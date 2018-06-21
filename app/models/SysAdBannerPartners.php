<?php
class SysAdBannerPartners extends Eloquent {
	protected $table = 'banner_avder_with';
    protected $fillable = array( 'name', 'location', 'contact', 'email', 'person', 'license', 'banner', 'days', 'created_at', 'updated_at', 'status_id', 
								'publish_date', 'moderator_id', 'publish_unix', 'close_unix', 'created_unix', 'modarete_time', 'paid_date', 'paid_doc_number', 'paid_sum');
	
	static function getStatusAr () {
		return array(
			0 => 'created',
			1 => 'in process',
			2 => 'approved',
			3 => 'canceled',
			4 => 'at publish',
			5 => 'close publish'
		);
	}
	
	public static function boot() {
		$res = parent::boot();
		static::created(function($model){
			$model->setCreatedUnixTime();
			
            return true;
        });
		
		static::deleted(function($model){
			$model->setLetterForDelete();
		});
		
		
		
		return $res;
	}
	
	public function getPaidDateAttribute($value){
	   return ModelSnipet::formatDate($value, 'd.m.Y');
	}
	
	function setCreatedUnixTime (){
		$this->created_unix = time();
		$this->save();
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
	
	
	public function getIdSpecAttribute(){
		$id = str_pad($this->id, 5, '0', STR_PAD_LEFT);
		
		return 'BA'.$id;
	}
	
	function relUser () {
		return $this->belongsTo('User', 'user_id');
	}

	public function getCreatedAtAttribute($value){
	   return ModelSnipet::formatDate($value, 'd.m.Y');
	}
	
	public function getPublishDateAttribute($value){
	   return ModelSnipet::formatDate($value, 'd.m.Y');
	}
	
	public function setPublishDateAttribute($value){
		$this->attributes['publish_date'] =  ModelSnipet::formatDate($value, 'Y-m-d');
		$this->attributes['publish_unix'] = strtotime($value);
	}
	
	public function setStatusIdAttribute($status_id){
		$this->attributes['status_id'] = $status_id;
		
		if ($status_id == 4)
			MailSend::sendBannerModarateTrueMessage($this);
		if ($status_id == 3)
			MailSend::sendBannerModarateFalseMessage($this);
	}
	
	static function getWishDate () {
		$now = time();
		
		$active_elems = SysAdBannerPartners::where('status_id', 4)->get();
		
		$elem_count = 0;
		$result_ar_time = array();
		foreach ($active_elems as $el) {
			$elem_count = $elem_count + 1;
			$result_ar_time [] = $el->close_unix;
		}
		
		$res_unix = null;
		if ($elem_count <= 10)
			$res_unix = $now;
		else 
			$res_unix = min($result_ar_time);
			
		
		
		
		return date('d.m.Y', $res_unix);
	}
}
