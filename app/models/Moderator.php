<?php
class Moderator extends Eloquent {
	protected $table = 'moderators';
    protected $fillable = array('f_name', 'l_name', 'p_name', 'user_id', 'phones', 'mobile', 'address', 'created_at', 'updated_at', 'moderate_blog', 'maderate_comment', 'moderate_banner');
    protected static $rules = [
		'f_name'=>'required', 'l_name'=>'required', 'user_id'=>'required|numeric'
	];
	
	static function getArName () {
		$items = Moderator::all();
		$ar = array();
		foreach ($items as $i) {
			$ar[$i->id] = $i->full_name;
		}
		
		return $ar;
	}

	function relUser () {
		return $this->belongsTo('User', 'user_id');
	}

	function getFullNameAttribute () {
		return $this->l_name.' '.mb_substr($this->f_name,0,1,'UTF-8').' '.mb_substr($this->p_name,0,1,'UTF-8');
	}
	
	function relRights (){
		return $this->hasMany('ModeratorRight', 'moderator_id');
	}
	
	function getCompanyRight () {
		return $this->relRights()->where('type_id', 1)->get();	
	}
	
	function getAdRight () {
		return $this->relRights()->where('type_id', 2)->get();
	}
	
	function getCommentRight (){
		return $this->relRights()->where('type_id', 3)->get();
	}
	
	function getModerateBlogNameAttribute () {
		if (!$this->moderate_blog)
			return 'off';
		
		return 'on';
	}
	
	function getModerateCommentNameAttribute () {
		if (!$this->maderate_comment)
			return 'off';
		
		return 'on';
	}
	
	function getModerateBannerNameAttribute () {
		if (!$this->moderate_banner)
			return 'off';
		
		return 'on';
	}

}
