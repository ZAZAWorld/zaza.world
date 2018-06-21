<?php
class CompanyView extends Eloquent {
	protected $table = 'company_view';
    protected $fillable = array('company_id', 'user_id');
    public $timestamps = false;
	
	
}
