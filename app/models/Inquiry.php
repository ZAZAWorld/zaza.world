 <?php
class Inquiry extends Eloquent {
    protected $table = 'inquiry';
    protected $fillable = array('user_id', 'is_personal_account', 'type_id', 'cat_id', 'title', 'note', 'status', 'created_unix');
		
	static function getUserList(){
		if (!Auth::check()) 
			return Inquiry::orderBy('id', 'desc')->take(50)->get();
			
			
		$user = Auth::user();
		
		if (!in_array($user->user_type_id, array(3, 4)))
			return false;
			
		if ($user->user_type_id == 3)
			$items = Inquiry::where('is_personal_account', 1);
		else {
			$company = $user->relCompany;
			
			$where = array();
			foreach (CompanyCat::where('company_id', $company->id)->get() as $c) {
				$where[] = array(
					'type_id' => $c->type_id,
					'cat_id' => $c->cat_id
				);
			}
			
			$items = Inquiry::orderBy('id', 'desc');
			if (count($where) > 0){
				$items = $items->where(array_shift($where));
				foreach ($where as $w){
					$items = $items->orWhere($w);
				}
			}
			else 
				$items->where('id', '>', 0);
		}
			
		return $items->orderBy('id', 'desc')->take(12)->get();
	}
	
	static function getUserListCount(){
		if (!Auth::check()) 
			return 0;
			
		$user = Auth::user();
		
		if (!in_array($user->user_type_id, array(3, 4)))
			return 0;
			
		if ($user->user_type_id == 3)
			$items = Inquiry::where('is_personal_account', 1);
		else {
			$company = $user->relCompany;
			
			$where = array();
			foreach (CompanyCat::where('company_id', $company->id)->get() as $c) {
				$where[] = array(
					'type_id' => $c->type_id,
					'cat_id' => $c->cat_id
				);
			}
			
			$items = Inquiry::orderBy('id', 'desc');
			if (count($where) > 0){
				$items = $items->where(array_shift($where));
				foreach ($where as $w){
					$items = $items->orWhere($w);
				}
			}
			else 
				$items->where('id', '>', 0);
		}
		
		$time = time() - (60 * 10);
			
		return $items->where('created_unix', '>', $time)->count();
	}
	
	function relUser(){
		return $this->belongsTo('User', 'user_id');
	}
	
	function setNoteAttribute ($value) {
		$title = $value;
		$note = $value;
		
		if (mb_strlen($title) > 50)
			$title = mb_substr($title, 0, 49).'...';
		
		$this->attributes['title'] = $title;
		$this->attributes['note'] = $note;
		$this->attributes['created_unix'] = time();
	}
	
	public function getCreatedAtAttribute($value){
	   return ModelSnipet::formatDate($value, 'd.m.Y H:i');
	}
	
}