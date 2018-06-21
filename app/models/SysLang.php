<?php
class SysLang extends Eloquent {
	protected $table = 'sys_langs';
    protected $fillable = array('name', 'code', 'text_direction');

    static function getTextDirectionAr () {
        return array('ltr'=>'From left to right', 'rtl'=>'From right to left');
    }

}
