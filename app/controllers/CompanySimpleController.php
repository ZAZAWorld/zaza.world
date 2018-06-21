<?php
class CompanySimpleController extends BaseController {

    function getIndex () {
		$user = Auth::user();
        $company = $user->relCompany;

        $ar = array();
		$ar['title'] = $company->title;
        $ar['user'] = $user;
        $ar['company'] = $company;
		$ar['citys'] = SysCity::getCityAr();
		
		$ar['ads'] = Advert::where('user_id', $user->id)->get();
        $ar['all_ads_ids'] = Advert::where('user_id', $user->id)->list('id');

		return View::make('front.company.index', $ar);
    }

    function getUpdate () {
        $user = Auth::user();
        $company = $user->relCompany;

        $ar = array();
		$ar['title'] = $company->title;
        $ar['user'] = $user;
        $ar['company'] = $company;

		return View::make('front.company.update', $ar);
    }

    function postUpdate () {
        if (!Input::has('name') || !Input::has('type') ) {
            return '0';
        }
        $type = Input::get('type');
        $value = Input::get('value');
        $name = Input::get('name');

        if ($type == 'company') {
            $ar_names = array('title', 'phone', 'mobile', 'location', 'title', 'activity', 'branches', 'active_since', 'size_company', 'more_info', 'photo');
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
    }

}
