<?php
class Budjet extends Eloquent {
	protected $table = 'budjet';
    protected $fillable = array('user_id', 'total_aed');
	
	static function createAndFill($user) {
		$budjet = new Budjet();
		$budjet->user_id = $user->id;
		
		if ($user->user_type_id == 3)
			$budjet->total_aed = 222;
		else if ($user->user_type_id == 4)
			$budjet->total_aed = 555;
		else
			$budjet->total_aed = 0;
			
		$budjet->save();
		
		$history = new BudjetHistory();
		$history->user_id = $budjet->user_id;
		$history->budjet_id = $budjet->id;
		$history->is_spend = 0;
		$history->aed = $budjet->total_aed;
		$history->note = 'Created';
		$history->type_id = 1;
		$history->save();
		
		return $budjet;
	}
	
	static function getBalans ($user) {
		$budjet = Budjet::where('user_id', $user->id)->first();
		if (!$budjet)
			$budjet = Budjet::createAndFill($user);
		
		return $budjet->total_aed;
	}
	
	static function getBudjet ($user) {
		$budjet = Budjet::where('user_id', $user->id)->first();
		if (!$budjet)
			$budjet = Budjet::createAndFill($user);
		
		return $budjet;
	}
	
}