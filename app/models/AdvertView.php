<?php
class AdvertView extends Eloquent {
	protected $table = 'advert_view';
    protected $fillable = array('advert_id', 'user_id', 'created_unix');
    public $timestamps = false;
	
	static function getUserList(){
		if (!Auth::check()){
			$ar_view = AdvertView::getNoteAuthView();
			krsort($ar_view);
			
			$ar_view = array_chunk($ar_view, 12);
			if (isset($ar_view[0]))
				$ar_view = $ar_view[0];
			else 
				$ar_view = array();
			$res = Advert::whereIn('id', array_values($ar_view))->get()->keyBy('id');
            $ar = array();
			foreach ($ar_view as $k=>$advert_id) {
                if(isset($res[$advert_id])) {
                    $ar[$advert_id] = $res[$advert_id];
                }
			}
			return $ar;
		}
			
		
		$user = Auth::user();
		
		if (!in_array($user->user_type_id, array(3, 4)))
			return false;
		
		/*
		$ar_advert_id = AdvertView::where('user_id', $user->id)->take(12)->lists('advert_id');		
		
		return Advert::whereIn('id', $ar_advert_id)->orderBy('id', 'desc')->get();
		*/
		$time = time() - (60 * 60 * 24);
		
		return AdvertView::where('user_id', $user->id)->where('created_unix', '>', $time)->with('relAdvert')->orderBy('id', 'desc')->take(12)->get();
	}
	static function getUserListCount(){
		if (!Auth::check()) {
			$ar_view = AdvertView::getNoteAuthView();
			krsort($ar_view);
			
			//echo '<pre>'; print_r($ar_view); echo '</pre>';
			
			$ar_view = array_chunk($ar_view, 12);
			if (isset($ar_view[0]))
				$ar_view = $ar_view[0];
			else 
				$ar_view = array();
			
			//echo '<pre>'; print_r($ar_view); echo '</pre>';
			return count($ar_view);
		}
			
		
		$user = Auth::user();
		
		if (!in_array($user->user_type_id, array(3, 4)))
			return 0;
			
		$time = time() - (60 * 60 * 24);
		
		return AdvertView::where('user_id', $user->id)->where('created_unix', '>', $time)->take(12)->count();
	}
	
	function setUserIdAttribute ($value) {
		$this->attributes['user_id'] = $value;
		$this->attributes['created_unix'] = time();
	}
	
	function relAdvert () {
		return $this->belongsTo('Advert', 'advert_id');
	}
	
	static function setNoteAuthView ($advert_id) {
		$ar_view = array();
		if (Session::has('adver_view')){
			$ar_view = Session::get('adver_view');
			$ar_view = (array)json_decode($ar_view, true);
		}
		
		if(($key = array_search($advert_id, $ar_view)) !== false) {
			unset($ar_view[$key]);
		}
		
		$ar_view[] = $advert_id;
		$ar_view = json_encode($ar_view);
		Session::put('adver_view', $ar_view);
	}
	
	static function getNoteAuthView () {
		$ar_view = array();
		if (Session::has('adver_view')){
			$ar_view = Session::get('adver_view');
			$ar_view = (array)json_decode($ar_view, true);
		}
		
		return $ar_view;
	}
}