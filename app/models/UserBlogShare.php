<?php
class UserBlogShare extends Eloquent {
	protected $table = 'user_blog_shares';
	protected $fillable = array( 'user_id', 'blog_id');
	public $timestamps = false;

}
