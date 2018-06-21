<?php
class CompanyCat extends Eloquent {
    protected $table = 'company_cats';
    protected $fillable = array('company_id', 'type_id', 'cat_id', 'subcat_id');
    public $timestamps = false;

}
