<?php
class CompanyLike extends Eloquent {
	protected $table = 'company_like';
    protected $fillable = array('company_id', 'user_id');
    public $timestamps = false;
	
	
}
