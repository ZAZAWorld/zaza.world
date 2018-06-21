<?php
class PersonCompany extends Eloquent {
	protected $table = 'person_companies';
    protected $fillable = array('company_type_id', 'company_id', 'person_id');
    public $timestamps = false;
    

}
