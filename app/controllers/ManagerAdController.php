<?php
class ManagerAdController extends BaseController {
	
	function getIndex ($status_id = 1) {
		$user = Auth::user();
		$moderator = Moderator::where('user_id', $user->id)->first();
		if (!$moderator)
			App::abort(404);
			
		$ar = array();
		$ar['title'] = 'Moderate advert';
		$ar['ar_status'] = Advert::getStatusAr();
		$ar['items'] = Advert::where('status_id', $status_id)->where('moderator_id', $moderator->id)->paginate(25);
		$ar['status_id'] = $status_id;
		$ar['ar_ad_cat_1'] = SysAdvertCat::where('level', 1)->lists('name', 'id');
		$ar['ar_ad_cat_2'] = array(null=>'', 0=>'')+SysAdvertCat::where('level', 2)->lists('name', 'id');
		
		return View::make('manager.ad.index', $ar);
	}
	
	function getChangeStatus ($advert_id, $status_id) {
		$user = Auth::user();
		$moderator = Moderator::where('user_id', $user->id)->first();
		if (!$moderator)
			App::abort(404);
		$advert = Advert::where(array('id' => $advert_id, 'moderator_id' => $moderator->id))->first();
		if (!$advert)
			App::abort(404);
		$advert->status_id = $status_id;
		$advert->modarete_time = time();
		$advert->save();
		
		return Redirect::back()->with('success', 'Data saved successfully');
	}
	
}