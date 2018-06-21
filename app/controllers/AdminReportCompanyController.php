<?php
class AdminReportCompanyController extends BaseController {
    function getIndex () {
		$begin = null;
		if (Input::has('begin'))
			$begin = strtotime(Input::get('begin'));
			
		$end = null;
		if (Input::has('end'))
			$end = strtotime(Input::get('end'));
			
		$items = Company::where(function($q){
				$q->where('is_vip', 0)->orWhere('is_restorant', 0);
			})->orderBy('id', 'desc');
			
		if ($begin)
			$items = $items->where('created_unix', '>', $begin);
		if ($end)
			$items = $items->where('created_unix', '<', $end);
		
		$ar = array();
        $ar['title'] = 'Report of company';
		$ar['items'] = $items->with('relCat', 'relUser')->paginate(25);
		$ar['ar_type'] = SysCompanyType::lists('name', 'id');
		$ar['ar_cat'] = SysCompanyCat::lists('name', 'id');
		$ar['ar_subcat'] = SysCompanySubcat::lists('name', 'id');

		$ar['ar_modarators'] = Moderator::getArName();
		$ar['ar_status'] = Advert::getStatusAr();
		$ar['begin'] = ($begin ? date('Y-m-d', $begin) :null);
		$ar['end'] = ($end ? date('Y-m-d', $end) :null);
		
		return View::make('admin.report.company.index', $ar);
	}	
	
}