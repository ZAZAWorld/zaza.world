<?php
class BudjetHistory extends Eloquent {
	protected $table = 'budjet_history';
    protected $fillable = array('user_id', 'budjet_id', 'is_spend', 'aed', 'note', 'type_id');
	
	static function getTypeAr(){
		return array(
			1 => 'created',
			2 => 'make ad green',
			3 => 'make ad sale',
			4 => 'make ad hot deal',
			5 => 'make ad urgent',
			6 => 'make ad vip',
			7 => 'top top company'
			
		);
	}
	
}