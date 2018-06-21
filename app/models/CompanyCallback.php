<?php
class CompanyCallback extends Eloquent {
    protected $table = 'company_callback';
    protected $fillable = array( 'company_id', 'user_id');

}
