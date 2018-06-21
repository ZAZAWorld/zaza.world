<?php
class AdminReportManagerController extends BaseController {
    function getIndex () {
		$begin = null;
		if (Input::has('begin'))
			$begin = strtotime(Input::get('begin'));
			
		$end = null;
		if (Input::has('end'))
			$end = strtotime(Input::get('end'));
			
		
			
		$items = UserOnlianStat::orderBy('id', 'desc');
			
		if ($begin)
			$items = $items->where('created_unix', '>', $begin);
		if ($end)
			$items = $items->where('created_unix', '<', $end);
			
		$moderator_id = null;
		if (Input::has('moderator_id') && Input::get('moderator_id') > 0){
			$moderator_id = Input::get('moderator_id');
			$moderator = Moderator::findOrFail($moderator_id);
			
			$items = $items->where('user_id', $moderator->user_id);
		}
		else {
			$items = $items->whereIn('user_id', Moderator::lists('user_id'));
		}
		
		$ar = array();
        $ar['title'] = 'Report of manager';
		$ar['items'] = $items->paginate(25);

		$ar['ar_modarators'] = Moderator::getArName();
		$ar['ar_moderator_user'] = Moderator::lists('id', 'user_id'); 
		$ar['ar_moderator_phone'] = Moderator::lists('phones', 'user_id');
		$ar['ar_moderator_mobile'] = Moderator::lists('mobile', 'user_id');
		
		$ar['begin'] = ($begin ? date('Y-m-d', $begin) :null);
		$ar['end'] = ($end ? date('Y-m-d', $end) :null);
		$ar['moderator_id'] = $moderator_id;
		
		return View::make('admin.report.manager.index', $ar);
	}	
	
}