<?php
class CompanyPage extends Eloquent {
    protected $table = 'company_pages';
    protected $fillable = array( 'company_id', 'title', 'note', 'page_type_id', 'created_at', 'updated_at');

}
