<?php
class CompanyRestoranController extends BaseController {

	function getIndex() {
		$user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
		$restoran = CompanyRestoran::where('company_id', $company->id)->first();
		if (!$restoran){
			$restoran = new CompanyRestoran();
			$restoran->company_id = $company->id;
			$restoran->save();
		}
		$social = Social::where('user_id', $user->id)->first();
		if (!$social){
			$social = new Social();
			$social->user_id = $user->id;
			$social->save();
		}
		
        $ar = array();
        $ar['title'] = $company->title;
        $ar['user'] = $user;
        $ar['company'] = $company;
		$ar['restoran'] = $restoran;
		$ar['social'] = $social;
		$ar['blog'] = Blog::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(6);
		
		$ar['ar_youtube'] = CompanyFile::where(array('file_type_id'=>3, 'company_id'=>$company->id))->get();
		$ar['ar_cats'] = SysCompanyCat::where('type_id', 1)->lists('name', 'id');
		$ar['ar_cousine'] = CompanyRestoran::getCousineAr();
		$ar['ar_time_am'] = CompanyRestoran::getTimeAMAr();
		$ar['ar_time_pm'] = CompanyRestoran::getTimePMAr();
		$ar['ar_cat'] = CompanyCat::where('company_id', $company->id)->lists('cat_id');
		$ar['ar_cat_names'] = SysCompanyCat::where('type_id', 1)->lists('name', 'id');
		
		$ar['photo_galerea'] = CompanyFile::where(array('file_type_id'=>2 , 'company_id'=>$company->id))->get();
		$ar['photo_menu'] = CompanyFile::where(array('file_type_id'=>6 , 'company_id'=>$company->id))->get();
		$ar['photo_melas'] = CompanyFile::where(array('file_type_id'=>4 , 'company_id'=>$company->id))->get();
		$ar['photo_guests'] = CompanyFile::where(array('file_type_id'=>5 , 'company_id'=>$company->id))->get();
		$ar['photo_team'] = CompanyFile::where(array('file_type_id'=>7 , 'company_id'=>$company->id))->get();
		
		//echo '<pre>'; print_r( CompanyFile::where(array('file_type_id'=>2 , 'company_id'=>$company->id))->get()->toArray()); echo '</pre>'; exit();
		
        return View::make('front.restoran.update', $ar);
	}
	
	function postEditAjax(){
		if (!Input::has('type') || !Input::has('data'))
			return '0';
			
		$user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
		$restoran = CompanyRestoran::where('company_id', $company->id)->first();
		$social = Social::where('user_id', $user->id)->first();
		if (!$social){
			$social = new Social();
			$social->user_id = $user->id;
			$social->save();
		}
			
		$type = Input::get('type');
		$data = Input::get('data');
		
		if ($type == 'option') {
			if (!isset($data['id']) || !isset($data['check']))
				return '0';
			
			$options = $restoran->options;
			
			if (!isset($options[$data['id']]))
				return '0';
				
			$options[$data['id']]['check'] = ($data['check'] ? 0 : 1);
			
			$restoran->options = $options;
			$restoran->save();
			
			return '1';
		}
		else if ($type == 'timetable') {
			if (!isset($data['id']) || !isset($data['type_value']) || !isset($data['value']))
				return '0';
			
			$timetable = $restoran->timetable;		
			if (!isset($timetable[$data['id']]))
				return '0';
			
			if ($data['type_value'] == 1)
				$timetable[$data['id']]['value_1'] = $data['value'];
			else 
				$timetable[$data['id']]['value_2'] = $data['value'];
			
			$restoran->timetable = $timetable;
			$restoran->save();
			
			return '1';
		}
		else if ($type == 'company'){
			if (!isset($data['id']) || !isset($data['value']))
				return '0';
			
			if (!in_array($data['id'], array('more_info', 'web_site')))
				return '0';
				
			$company->$data['id'] = $data['value'];
			$company->save();
			
			return '1';
		}
		else if ($type == 'user'){
			if (!isset($data['id']) || !isset($data['value']))
				return '0';
			
			if (!in_array($data['id'], array('email')))
				return '0';
				
			if ($data['id'] == 'email' and $user->email != $data['value']){
				$check_user = User::where('email', $data['value'])->first();
				if ($check_user)
					return '0';
			}	
			
			$user->$data['id'] = $data['value'];
			$user->save();
			
			return '1';
		}
		else if ($type == 'social'){
			if (!isset($data['id']) || !isset($data['value']))
				return '0';
			
			if (!in_array($data['id'], array('facebook', 'instagram', 'youtube')))
				return '0';
				
			$social->$data['id'] = $data['value'];
			$social->save();
			
			return '1';
			
		}
		
		return '0';
		
		
		echo '<pre>'; print_r(Input::all()); echo '</pre>';
	}
	
	function postMainSetting(){
		$data = $this->trimData(Input::all());
		
		$user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
		$restoran = CompanyRestoran::where('company_id', $company->id)->first();
		$social = Social::where('user_id', $user->id)->first();
		if (!$social){
			$social = new Social();
			$social->user_id = $user->id;
			$social->save();
		}
		
		CompanyCat::where('company_id', $company->id)->delete();
		
		if (isset($data['cat']) && count($data['cat']) > 0){
			foreach ($data['cat'] as $cat_id) {
				$cat = new CompanyCat();
				$cat->company_id = $company->id;
				$cat->type_id = 1;
				$cat->cat_id = $cat_id;
				$cat->save();
			}
		}
		
		$company->title = Input::get('title');
		$company->greeting = Input::get('greeting');
		$company->is_greeting = Input::get('is_greeting');
		$company->phone = implode(',', Input::get('phone'));
		$company->location = implode('|', Input::get('location'));
		$company->save();
		
		$restoran->cousine = Input::get('cousine');
		$restoran->cost_for_2 = Input::get('cost_for_2');
		$restoran->save();
		
		$user->password = Hash::make(Input::get('password'));
		$user->save();
		
		return Redirect::back();
	}
	
	function postImages(){
		$data = Input::all();
		$user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
		
		CompanyFile::where('company_id', $company->id )->delete();
		
		if (Input::has('main_photo')){
			$company->photo = Input::get('main_photo');
			$company->save();
		}
		
		if (Input::has('youtube')){
			foreach (Input::get('youtube') as $y) {
				$file = new CompanyFile();
				$file->company_id = $company->id;
				$file->file_type_id = 3;
				$file->path = $y;
				$file->save();
			}
		}
		
		if (Input::has('photo_galerea')){
			foreach (Input::get('photo_galerea') as $y) {
				$file = new CompanyFile();
				$file->company_id = $company->id;
				$file->path = $y;
				$file->file_type_id = 2;
				$file->save();
			}
		}
		
		if (Input::has('menu_galerea')){
			foreach (Input::get('menu_galerea') as $y) {
				$file = new CompanyFile();
				$file->company_id = $company->id;
				$file->path = $y;
				$file->file_type_id = 6;
				$file->save();
			}
		}
		
		if (Input::has('meals_galerea_img')){
			foreach (Input::get('meals_galerea_img') as $k=>$y) {
				$file = new CompanyFile();
				$file->company_id = $company->id;
				$file->path = $y;
				$file->title = ( isset($data['meals_galerea_title'][$k]) ? $data['meals_galerea_title'][$k] : null );
				$file->note = ( isset($data['meals_galerea_note'][$k]) ? $data['meals_galerea_note'][$k] : null );
				$file->file_type_id = 4;
				$file->save();
			}
		}
		
		if (Input::has('guests_galerea')){
			foreach (Input::get('guests_galerea') as $y) {
				$file = new CompanyFile();
				$file->company_id = $company->id;
				$file->path = $y;
				$file->file_type_id = 5;
				$file->save();
			}
		}
		
		if (Input::has('team_galerea')){
			foreach (Input::get('team_galerea') as $y) {
				$file = new CompanyFile();
				$file->company_id = $company->id;
				$file->path = $y;
				$file->file_type_id = 7;
				$file->save();
			}
		}
		
		return Redirect::back();
	}
	
}

