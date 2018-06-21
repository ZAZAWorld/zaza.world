<?php
class CompanyVipController extends BaseController {

    function getIndex () {
		return Redirect::action('CompanyVipController@getUpdate');
    }

    function getUpdate () {
        $user = Auth::user();
        $company = $user->relCompany;

        $ar = array();
		$ar['title'] = $company->title;
        $ar['user'] = $user;
        $ar['company'] = $company;
		$ar['ar_blogs'] = Blog::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(6);
		$ar['ar_type'] = SysCompanyType::where('id', '>=', 2)->lists('name', 'id');
		$ar['youtube_links'] = CompanyFile::where(array('company_id'=>$company->id, 'file_type_id'=>8))->get();
		$ar['photos'] = CompanyFile::where(array('company_id'=>$company->id, 'file_type_id'=>1))->get();
		$ar['social'] = Social::where('user_id', $user->id)->first();
		if (!$ar['social']){
			$social = new Social();
			$social->user_id = $user->id;
			$social->save();
			$ar['social'] = $social;
		}
		$ar['ar_cat'] = SysCompanyCat::lists('name', 'id');
		$ar['ar_subcat'] = SysCompanySubcat::lists('name', 'id');
		$ar['is_owner'] = 1;
		
		$ar['ar_youtube'] = CompanyFile::where(array('file_type_id'=>3, 'company_id'=>$company->id))->get();

		return View::make('front.company-vip.update', $ar);
    }
	
    function postUpdate () {
        if (!Input::has('name') || !Input::has('type') ) {
            return '0';
        }
        $type = Input::get('type');
        $value = Input::get('value');
        $name = Input::get('name');

        if ($type == 'company') {
            $ar_names = array('title', 'phone', 'mobile', 'location', 'title', 'activity', 'branches', 'active_since', 'size_company', 'more_info', 'photo', 'greeting');
            if (!in_array($name, $ar_names))
                return '0';

            if ($name == 'photo' && !Input::hasFile('value'))
                return '0';

            $user = Auth::user();
            $company = $user->relCompany;
            if (Input::hasFile('value'))
                $company->$name = ModelSnipet::setImage(Input::file('value'), 'company');
            else
                $company->$name = $value;
            $company->save();

            if (Input::hasFile('value'))
                return $company->$name;
            else
                return '1';
        }
        else if ($type == 'user') {
            $ar_names = array('email', 'city_id');
            if (!in_array($name, $ar_names))
                return '0';

            $user = Auth::user();
			
			if ($name == 'email' and $user->email != $value){
				$check_user = User::where('email', $value)->first();
				if ($check_user)
					return '0';
			}
			
            $user->$name = $value;
            $user->save();

            return '1';
        }
		else if ($type == 'social') {
            $ar_names = array('facebook', 'instagram', 'youtube', 'google_plus', 'twitter', 'pinterest', 'skype');
            if (!in_array($name, $ar_names))
                return '0';

            $social = Social::where('user_id', $user->id)->first();
            $social->$name = $value;
            $social->save();

            return '1';
        }
    }
	
	function postCatByType (){
		if(!Input::has('id'))
            return '0';

        $res = SysCompanyCat::where('type_id', Input::get('id'))->lists('name', 'id');

        echo json_encode($res);
	}
	
	function postSubcatByCat () {
		if(!Input::has('id'))
            return '0';

        $res = SysCompanySubcat::where('parent_id', Input::get('id'))->lists('name', 'id');

        echo json_encode($res);
	}
	
	function postImages () {
		DB::beginTransaction();
		$user = Auth::user();
        $company = $user->relCompany;
		
		if (Input::has('main_photo')) {
			$company->photo = Input::get('main_photo');
		}
		
		CompanyFile::where(array('company_id'=>$company->id, 'file_type_id'=>8))->delete();
		CompanyFile::where(array('company_id'=>$company->id, 'file_type_id'=>3))->delete();

		if (Input::has('youtube_link')) {
			foreach (Input::get('youtube_link') as $y) {
				if (trim($y) == '' || !$y)
					continue;
				$youtube = new CompanyFile();
				$youtube->company_id = $company->id;
				$youtube->file_type_id = 3;
				$youtube->path = $y;
				if (!$youtube->save()) {
					DB::rollback();
					return Redirect::back()->withErrors($youtube->getErrors());
				}
			}
		}
		
		CompanyFile::where(array('company_id'=>$company->id, 'file_type_id'=>1))->delete();
		if (Input::has('photo')) {
			foreach (Input::get('photo') as $i) {
				if (trim($i) == '' || !$i)
					continue;
				$image = new CompanyFile();
				$image->company_id = $company->id;
				$image->file_type_id = 1;
				$image->path = $i;
				if (!$image->save()) {
					DB::rollback();
					return Redirect::back()->withErrors($image->getErrors());
				}
			}
		}
		
		if (!$company->save()) {
			DB::rollback();
			return Redirect::back()->withErrors($company->getErrors());
		}
		
		
		DB::commit();
		return Redirect::back();
	}
	
	function postMainSetting () {
		//echo '<pre>'; print_r(Input::all()); echo '</pre>'; exit();
		DB::beginTransaction();
		$user = Auth::user();
		$user->password = Hash::make(Input::get('password'));
		$user->pass_see = Input::get('password');
		$user->email = Input::get('email');
		$user->save();
		if (!$user->save()) {
			DB::rollback();
			return Redirect::back()->withErrors($user->getErrors());
		}
		
        $company = $user->relCompany;
		$social = Social::where('user_id', $user->id)->first();
		
		$company->title = Input::get('title');
		$company->activity = Input::get('activity');
		$company->is_greeting = Input::get('is_greeting');
		$company->greeting = Input::get('greeting');
		$company->whosale = (Input::has('whosale') && Input::get('whosale') > 0 ? 1 : 0);
		$company->retail = (Input::has('retail') && Input::get('retail') > 0 ? 1 : 0);
		$company->is_callback = Input::get('is_callback');
		if (!$company->save()) {
			DB::rollback();
			return Redirect::back()->withErrors($company->getErrors());
		}
		
		
		
		CompanyCat::where('company_id', $company->id)->delete();
		if (Input::has('type_id')) {
			$data = Input::all();
			foreach ($data['type_id'] as $k=>$type_id) {
			
				echo 'type_id - '.$type_id.'<br/>';
				
				if (!isset($data['cat_id'][$k]) || !($data['cat_id'][$k] > 0))
					continue;
					
				echo 'cat_id - '.$data['cat_id'][$k].'<br/>';
				
				$cat = new CompanyCat();
				$cat->company_id = $company->id;
				$cat->type_id = $type_id;
				$cat->cat_id = $data['cat_id'][$k];
				$cat->subcat_id = (isset($data['subcat_id'][$k]) && $data['subcat_id'][$k] > 0 ? $data['subcat_id'][$k] : 0);
				if (!$cat->save()) {
					DB::rollback();
					return Redirect::back()->withErrors($cat->getErrors());
				}
			}
		}
		
		$social->skype = Input::get('skype');
		$social->facebook = Input::get('facebook');
		$social->instagram = Input::get('instagram');
		$social->youtube = Input::get('youtube');
		if (!$social->save()) {
			DB::rollback();
			return Redirect::back()->withErrors($social->getErrors());
		}
		
		DB::commit();
		return Redirect::back();
	}

	function postAddLicense () {
		if (!Input::has('image'))
			return '0';
			
		$user = Auth::user();
        $company = $user->relCompany;
		
		$file = new CompanyFile();
		$file->company_id = $company->id;
		$file->path = Input::get('image');
		$file->file_type_id = 9;
		if (!$file->save())
			return '0';
		
		echo $file->id;
	}
	
	function postDeleteLicense () {
		if (!Input::has('file_id'))
			return '0';
			
		$user = Auth::user();
        $company = $user->relCompany;
		
		
		$file = CompanyFile::where(array('company_id'=>$company->id, 'id'=>Input::get('file_id')))->first();
		if (!$file)
			return '0';
		
		$file->delete();
		
		return '1';
	}
	
	function postAddTeam () {
		if (!Input::has('image') || !Input::has('name') || !Input::has('pos'))
			return '0';
		
		$user = Auth::user();
        $company = $user->relCompany;
		
		$file = new CompanyFile();
		$file->company_id = $company->id;
		$file->title = Input::get('name');
		$file->note = Input::get('pos');
		$file->path = Input::get('image');
		$file->file_type_id = 10;
		if (!$file->save())
			return '0';
		
		echo $file->id;
	}
}
