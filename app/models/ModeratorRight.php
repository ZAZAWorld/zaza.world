<?php
class ModeratorRight extends Eloquent {
	protected $table = 'moderator_right';
    public $timestamps = false;
    protected $fillable = array('moderator_id', 'type_id', 'cat1_id', 'cat2_id', 'cat3_id', 'cat4_id');
	
}
