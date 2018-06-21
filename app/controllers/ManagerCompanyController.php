<?php
class ManagerCompanyController extends BaseController {
	function getIndex ($status_id = 1) {
		$user = Auth::user();
		$moderator = Moderator::where('user_id', $user->id)->first();
		if (!$moderator)
			App::abort(404);
			
		$ar = array();
		$ar['title'] = 'Moderate comment';
		$ar['ar_status'] = Advert::getStatusAr();
		$ar['items'] = Company::where('status_id', $status_id)->where('moderator_id', $moderator->id)->with('relUser')->orderBy('id', 'desc')->paginate(25);
		$ar['status_id'] = $status_id;
		
		$ar['ar_types'] = SysCompanyType::lists('name', 'id');
		$ar['ar_cats'] = SysCompanyCat::lists('name', 'id');
		$ar['ar_subcats'] = SysCompanySubcat::lists('name', 'id');
		
		return View::make('manager.company.index', $ar);
	}
	
	function getChangeStatus ($company_id, $status_id) {
		$user = Auth::user();
		$moderator = Moderator::where('user_id', $user->id)->first();
		if (!$moderator)
			App::abort(404);
			
		$company = Company::where(array('id'=>$company_id, 'moderator_id'=>$moderator->id))->first();
		if (!$company)
			App::abort(404);
		$company->status_id = $status_id;
		$company->modarete_time = time();
		$company->save();
			
		return Redirect::back()->with('success', 'Data saved successfully');
	}
}