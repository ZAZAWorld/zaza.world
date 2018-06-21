<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class SysAdComment extends Eloquent {
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	protected $table = 'comments';
    protected $fillable = array( 'email', 'name', 'title', 'note', 'element_type_id', 'element_id', 'parent_id', 'user_id', 
								'created_at', 'updated_at', 'status_id', 'deleted_at', 'moderator_id', 'created_unix', 'modarete_time');
	
	public static function boot() {
		$res = parent::boot();
		static::created(function($model){
			
			$model->setCreatedUnixTime();
			
            return true;
        });

		return $res;
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
		
		return 'C'.$id;
	}
	
	function getType() {
		
	}
	
	function relUser () {
		return $this->belongsTo('User', 'user_id');
	}

	public function getCreatedAtAttribute($value){
	   return ModelSnipet::formatDate($value, 'd.m.Y');
	}
	
	
	function getNoteShortAttribute () {
		$value = $this->note;
		
		if (mb_strlen($value) > 100)
			$value = substr($value, 0, 100).'...';
			
		return $value;
	}
	
	function relParent(){
		return $this->belongsTo('SysAdComment', 'parent_id');
	}
	
	function relChilds () {
		return $this->hasMany('SysAdComment', 'parent_id', 'id');
	}
	
}
