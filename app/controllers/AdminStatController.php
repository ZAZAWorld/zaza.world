<?php
class AdminStatController extends BaseController {
    function getIndex () {
		$begin = date('Y-m-d');
		if (Input::has('begin'))
			$begin = ModelSnipet::formatDate(Input::get('begin'), 'Y-m-d');
			
		$end = date('Y-m-d');
		if (Input::has('end'))
			$end = ModelSnipet::formatDate(Input::get('end'), 'Y-m-d');
		//echo $begin; exit();
			
		$stat_onlain = StatUserOnlain::where('id', '>', 0);
		if ($begin)
			$stat_onlain = $stat_onlain->where('created_date', '>=', $begin);
		if ($end)
			$stat_onlain = $stat_onlain->where('created_date', '<=', $end);
		$stat_onlain = $stat_onlain->get();
		
		$ar = array();
		foreach($stat_onlain as $s){
			if (!isset($ar[$s->user_type]))
				$ar[$s->user_type] = 1;
			else 
				$ar[$s->user_type] = $ar[$s->user_type] + 1;
		}
		$stat_onlain = $ar;
		
		$stat_user_created = StatUserRegistration::where('id', '>', 0);
		if ($begin)
			$stat_user_created = $stat_user_created->where('created_date', '>=', $begin);
		if ($end)
			$stat_user_created = $stat_user_created->where('created_date', '<=', $end);
		$stat_user_created = $stat_user_created->get();
		
		$ar = array();
		foreach($stat_user_created as $s){
			if (!isset($ar[$s->user_type]))
				$ar[$s->user_type] = 1;
			else 
				$ar[$s->user_type] = $ar[$s->user_type] + 1;
		}
		$stat_user_created = $ar;
		
		$stat_adv_created = StatAdCreated::where('id', '>', 0);
		if ($begin)
			$stat_adv_created = $stat_adv_created->where('created_date', '>=', $begin);
		if ($end)
			$stat_adv_created = $stat_adv_created->where('created_date', '<=', $end);
		$stat_adv_created = $stat_adv_created->get();
		
		$ar = array();
		foreach($stat_adv_created as $s){
			if (!isset($ar[$s->user_type]))
				$ar[$s->user_type] = 1;
			else 
				$ar[$s->user_type] = $ar[$s->user_type] + 1;
		}
		$stat_adv_created = $ar;
		
		$stat_adv_canceled = StatAdCreated::where('moderator_status', 3);
		if ($begin)
			$stat_adv_canceled = $stat_adv_canceled->where('created_date', '>=', $begin);
		if ($end)
			$stat_adv_canceled = $stat_adv_canceled->where('created_date', '<=', $end);
		$stat_adv_canceled = $stat_adv_canceled->get();
		
		$ar = array();
		foreach($stat_adv_canceled as $s){
			if (!isset($ar[$s->user_type]))
				$ar[$s->user_type] = 1;
			else 
				$ar[$s->user_type] = $ar[$s->user_type] + 1;
		}
		$stat_adv_canceled = $ar;
		
		
		$ar = array();
        $ar['title'] = 'Statistics';
		
		$ar['begin'] = $begin;
		$ar['end'] = $end;
		
		$ar['stat_onlain'] = $stat_onlain;
		$ar['stat_user_created'] = $stat_user_created;
		$ar['stat_adv_created'] = $stat_adv_created;
		$ar['stat_adv_canceled'] = $stat_adv_canceled;
		
		return View::make('admin.statistic.main.index', $ar);
	}	
}