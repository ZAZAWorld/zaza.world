<?php
class TransLib extends Eloquent {
	protected $table = 'trans_lib';
    protected $fillable = array('lang_id', 'word_id', 'trans_word');
	
	public $timestamps = false;

}
