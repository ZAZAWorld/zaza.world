<?php
class CompanyRestoran extends Eloquent {
	protected $table = 'company_restoran';
    protected $fillable = array('company_id', 'cost_for_2', 'score', 'cousine', 'greeting', 'timetable', 'options', 'created_at', 'updated_at', 'count_score', 'total_score', 'score_ar',
							'score_food', 'score_service', 'score_interior');
	
	static function getOptionsAr(){
		return array(
			1 => array('icon'=>'c-icon--parking', 'name'=>'valet parking', 'check'=>false),
			2 => array('icon'=>'c-icon--view', 'name'=>'view', 'check'=>false),
			3 => array('icon'=>'c-icon--outdoor', 'name'=>'outdoor', 'check'=>false),
			4 => array('icon'=>'c-icon--shisha', 'name'=>'shisha', 'check'=>false),
			5 => array('icon'=>'c-icon--wifi', 'name'=>'wifi', 'check'=>false),
			6 => array('icon'=>'c-icon--music', 'name'=>'live music', 'check'=>false),
			7 => array('icon'=>'c-icon--dj', 'name'=>'dj', 'check'=>false),
			8 => array('icon'=>'c-icon--karaoke', 'name'=>'karaoke', 'check'=>false),
			9 => array('icon'=>'c-icon--romantic', 'name'=>'romantic atmosphere', 'check'=>false),
			10 => array('icon'=>'c-icon--private', 'name'=>'private dining area', 'check'=>false),
			11 => array('icon'=>'c-icon--alcohol', 'name'=>'alcohol', 'check'=>false),
			12 => array('icon'=>'c-icon--live', 'name'=>'watch the game', 'check'=>false),
			13 => array('icon'=>'c-icon--brunch', 'name'=>'friday brunch', 'check'=>false),
			14 => array('icon'=>'c-icon--breakfast', 'name'=>'breakfast', 'check'=>false),
			15 => array('icon'=>'c-icon--businesslunch', 'name'=>'business lunch', 'check'=>false),
			16 => array('icon'=>'c-icon--buffet', 'name'=>' buffet', 'check'=>false),
			17 => array('icon'=>'c-icon--kidsarea', 'name'=>'kids area', 'check'=>false)
		);
	}
	
	static function getTimetableAr () {
		return array(
			'su' => array('name'=>'Su', 'value_1'=>'12AM', 'value_2'=>'12PM'),
			'mo' => array('name'=>'Mo', 'value_1'=>'12AM', 'value_2'=>'12PM'),
			'tu' => array('name'=>'Tu', 'value_1'=>'12AM', 'value_2'=>'12PM'),
			'we' => array('name'=>'We', 'value_1'=>'12AM', 'value_2'=>'12PM'),
			'th' => array('name'=>'Th', 'value_1'=>'12AM', 'value_2'=>'12PM'),
			'fr' => array('name'=>'Fr', 'value_1'=>'12AM', 'value_2'=>'12PM'),
			'st' => array('name'=>'St', 'value_1'=>'12AM', 'value_2'=>'12PM'),
		);
	}
	
	static function getCousineAr () {
		return SysAdRestoranCousine::lists('name', 'id');
		/*
		return array(
			1=>'Chinese',
			2=>'Thai',
			3=>'Russian',
			4=>'Normal',
		);
		*/
	}
	
	function getTotalScoreAttribute ($value) {
		return round($value, 1);
	}
	
	static function getTimeAMAr () {
		$ar = array();
		for($i = 1; $i <= 12; $i++) {
			$hour = str_pad($i, 2, '0', STR_PAD_LEFT);
			
			$ar[$hour.'AM'] = $hour.'AM';
		}
		
		return $ar;
	}
	
	static function getTimePMAr () {
		$ar = array();
		for($i = 1; $i <= 12; $i++) {
			$hour = str_pad($i, 2, '0', STR_PAD_LEFT);
			
			$ar[$hour.'PM'] = $hour.'PM';
		}
		$ar = $ar + static::getTimeAMAr();
		return $ar;
	}
	
	function getOptionsAttribute ($value) {
		if (!$value)
			return static::getOptionsAr();
			
		$ar = json_decode($value, TRUE);
		$ar = (array)$ar;
		
		return $ar;
	}
	
	function setOptionsAttribute ($value) {
		$this->attributes['options'] = json_encode($value);
	}
	
	
	function getTimetableAttribute ($value) {
		if (!$value)
			return static::getTimetableAr();
			
		$ar = json_decode($value, TRUE);
		$ar = (array)$ar;
		
		return $ar;
	}
	
	function setTimetableAttribute ($value) {
		$this->attributes['timetable'] = json_encode($value);
	}
	
	function getCousineAttribute ($value) {
		if (!$value)
			return array();
			
		$ar = json_decode($value, TRUE);
		$ar = (array)$ar;
		
		return $ar;
	}
	
	function setCousineAttribute ($value) {
		$this->attributes['cousine'] = json_encode($value);
	}
	
	function getStarViews($score) {
		$text = '<div class="c-stars">';
		for ($i = 1; $i < 6; $i++) {
			if ($i <= $score)
				$text = $text.' <div class="c-stars__item c-stars--full"></div>';
			else if ($i > $score && ($i - 1) < $score)
				$text = $text.' <div class="c-stars__item c-stars--half"></div>';
			else 
				$text = $text.' <div class="c-stars__item c-stars--empty"></div>';
		}

		$text = $text.'</div>';
		
		return $text;
	}
	
	function getScoreArAttribute ($value) {
		if (!$value)
			return array();
			
		$ar = json_decode($value, TRUE);
		$ar = (array)$ar;
		
		return $ar;
	}
	
	function setScoreArAttribute ($value) {
		$this->attributes['score_ar'] = json_encode($value);
	}
	
	
								
}
