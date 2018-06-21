<?php
class Social extends Eloquent {
	protected $table = 'socials';
    protected $fillable = array('user_id', 'facebook', 'instagram', 'youtube', 'google_plus', 'twitter', 'pinterest', 'skype');
    public $timestamps = false;



}
