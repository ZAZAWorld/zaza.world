<?php
class ManagerCommentController extends BaseController {
	function getIndex ($status_id = 1) {
		$user = Auth::user();
		$moderator = Moderator::where('user_id', $user->id)->first();
		if (!$moderator)
			App::abort(404);
		if (!$moderator->maderate_comment)
			App::abort(404);
			
		$ar = array();
		$ar['title'] = 'Moderate comment';
		$ar['ar_status'] = Advert::getStatusAr();
		$ar['items'] = SysAdComment::withTrashed()->where('status_id', $status_id)->with('relUser')->orderBy('id', 'desc')->paginate(25);
		$ar['status_id'] = $status_id;
		
		return View::make('manager.comment.index', $ar);
	}
	
	function getChangeStatus ($message_id, $status_id) {
		$user = Auth::user();
		$moderator = Moderator::where('user_id', $user->id)->first();
		if (!$moderator)
			App::abort(404);
		if (!$moderator->maderate_comment)
			App::abort(404);
			
		$advert = SysAdComment::withTrashed()->where(array('id'=>$message_id))->first();
		if (!$advert)
			App::abort(404);
		$advert->status_id = $status_id;
		$advert->moderator_id = $moderator->id;
		$advert->modarete_time = time();
		$advert->save();
		if ($status_id == 3){
			foreach (SysAdComment::where('parent_id', $advert->id)->get() as $i) {
				$i->status_id = $status_id;
				$i->save();
				
				$i->delete();
			}
			$advert->delete();
		}
			
		
		return Redirect::back()->with('success', 'Data saved successfully');
	}
}