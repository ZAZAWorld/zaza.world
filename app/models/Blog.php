<?php
//use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Blog extends Eloquent {
	//use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'blog';
    protected $fillable = array('user_type_id', 'user_id', 'type_id', 'title', 'note', 'tags', 'meta_title', 'meta_note', 'meta_tag', 'created_at', 
								'updated_at', 'status_id', 'interest_id', 'photo', 'element_id', 'moderator_id', 'created_unix', 'modarete_time');
	
	public static function boot() {
		$res = parent::boot();
		static::created(function($model){
			
			$model->setCreatedUnixTime();
			
            return true;
        });

		return $res;
	}
	
	function getBlogType () {
		if ($this->type_id == 1){
			$interest = SysBlogInterest::find($this->interest_id);
			if (!$interest)
				return null;
			
			return $interest->name;
		}
		
		return 'Business account **';
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
		
		return 'B'.$id;
	}
	
	function relUser () {
		return $this->belongsTo('User', 'user_id');
	}
	
	function getNoteShortAttribute () {
		$value = $this->note;
		
		if (mb_strlen($value) > 250)
			$value = substr($value, 0, 250).'...';
			
		return $value;
	}
	
	public function getCreatedAtAttribute($value){
	   return ModelSnipet::formatDate($value, 'd.m.Y');
	}
	
	function getCommentCount(){
		
		return 25;
	}
	
	function getComment(){
		
	}
	
	function relInterest (){
		return $this->belongsTo('SysBlogInterest', 'interest_id');
	}
	
	function checkShared () {
		$user = $this->relUser;

		$share = UserBlogShare::where(array('user_id'=>$user->id, 'blog_id'=>$this->id))->first();
		if (!$share)
			return 0;
		
		return 1;
		
	}
}
