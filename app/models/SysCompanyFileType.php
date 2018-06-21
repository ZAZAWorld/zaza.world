<?php
class SysCompanyFileType extends Eloquent {
    protected $table = 'sys_company_file_types';
    protected $fillable = array( 'name', 'note');
    public $timestamps = false;

}
