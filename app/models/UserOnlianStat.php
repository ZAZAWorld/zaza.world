<?php
class UserOnlianStat extends Eloquent {
	protected $table = 'user_onlian_stat';
	protected $fillable = array( 'user_id', 'created_date', 'created_unix', 'closed_unix', 'duration', 'is_close');
	public $timestamps = false;
	
	static function setOnlain($user){
		$last_onlain = UserOnlianStat::where('user_id', $user->id)->where('is_close', 0)->orderBy('id', 'desc')->first();
		if (!$last_onlain){
			$onlain = new UserOnlianStat();
			$onlain->user_id = $user->id;
			$onlain->created_date = date('d-m-Y');
			$onlain->created_unix = time();
			$onlain->closed_unix = time();
			$onlain->is_close = 0;
			$onlain->save();
			
			return true;
		}
		
		$time = time() - (60 * 30);
		if ($last_onlain->closed_unix >= $time){
			$last_onlain->closed_unix = time();
			$last_onlain->save();
			return true;
		}
		
		$last_onlain->duration = $last_onlain->closed_unix - $last_onlain->created_unix;
		$last_onlain->is_close = 1;
		$last_onlain->save();
		
		$onlain = new UserOnlianStat();
		$onlain->user_id = $user->id;
		$onlain->created_date = date('d-m-Y');
		$onlain->created_unix = time();
		$onlain->closed_unix = time();
		$onlain->is_close = 0;
		$onlain->save();
		
		return true;
	}
}
