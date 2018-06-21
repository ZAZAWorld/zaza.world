<?php
class SysAdOurPartners extends Eloquent {
	protected $table = 'our_partners';
    protected $fillable = array( 'name', 'icon','active');

	function relUser () {
		return $this->belongsTo('User', 'user_id');
	}

	public function getCreatedAtAttribute($value){
	   return ModelSnipet::formatDate($value, 'd.m.Y');
	}
}
