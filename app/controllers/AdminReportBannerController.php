<?php
class AdminReportBannerController extends BaseController {
    function getIndex () {
		$begin = null;
		if (Input::has('begin'))
			$begin = strtotime(Input::get('begin'));
			
		$end = null;
		if (Input::has('end'))
			$end = strtotime(Input::get('end'));
			
		$items = SysAdBannerPartners::orderBy('id', 'desc');
		if ($begin)
			$items = $items->where('created_unix', '>', $begin);
		if ($end)
			$items = $items->where('created_unix', '<', $end);
		
		$ar = array();
        $ar['title'] = 'Report of ad';
		$ar['items'] = $items->paginate(25);
		$ar['ar_modarators'] = Moderator::getArName();
		$ar['ar_status'] = SysAdBannerPartners::getStatusAr();
		$ar['begin'] = ($begin ? date('Y-m-d', $begin) :null);
		$ar['end'] = ($end ? date('Y-m-d', $end) :null);
		
		return View::make('admin.report.banner.index', $ar);
	}	
}