<?php
class PersonInterest extends Eloquent {
	protected $table = 'person_interests';
    protected $fillable = array('person_id', 'interest_id');
    public $timestamps = false;

	static function getInterestPersonKeys ($person_id) {
		$ar = array();
		$items = static::where('person_id', $person_id)->get();
		foreach ($items as $item) {
			$ar[] = $item->interest_id;
		}

		return $ar;
	}
}