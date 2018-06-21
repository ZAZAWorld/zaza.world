<?php
class CompanyController extends BaseController {
	
	function postToTop(){
		if (!Input::has('count_view') )
			return App::abort(404);
		
		$total_cost = Input::get('count_view') * 1;
		
		$user = Auth::user();
		$user_balans = Budjet::getBudjet($user);
		$company = Company::where('user_id', $user->id)->firstOrFail();
		
		if (($user_balans->total_aed - $total_cost) < 0)
			return Redirect::back()->with('error', 'Account does not have enough funds for requested transaction. Please, refill your account');
		
		if ($company->is_top)
			return Redirect::back()->with('error', 'Your company already in top');
		
		DB::beginTransaction();
		
		$user_balans->total_aed = $user_balans->total_aed - $total_cost;
		$user_balans->save();
		
		$budjet_history = new BudjetHistory();
		$budjet_history->user_id = $user->id;
		$budjet_history->budjet_id = $user_balans->id;
		$budjet_history->is_spend = 1;
		$budjet_history->aed = $total_cost;
		$budjet_history->note = 'Company make to top';
		$budjet_history->type_id = 7;
		$budjet_history->save();
		
		$company->is_top = 1;
		$company->count_top = Input::get('count_view');
		$company->save();
		
		DB::commit();
		
		return Redirect::back();
	}
	
    function getCabinet () {
        $company = Auth::user()->relCompany;

		if ($company->is_restorant == 1)
            return Redirect::action('CompanyRestoranController@getIndex');

        if ($company->is_restorant == 0 && $company->is_vip == 0)
            return Redirect::action('CompanySimpleController@getIndex');

        if ($company->is_restorant == 0 && $company->is_vip != 0)
            return Redirect::action('CompanyVipController@getIndex');

    }

    function postRegistration () {
        if (Auth::check())
            Auth::logout();
			
		//echo '<pre>'; print_r(Input::all()); echo '</pre>'; exit();
		$check_user = User::where('email', Input::get('email'))->first();
		if ($check_user)
			return Redirect::back()->with('error', 'This email already used');

        $data = $this->trimData(Input::all());
		
        $user = new User();
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
		$user->pass_see = Input::get('password');
        $user->active = 1;
        $user->country_id = 1;
        $user->city_id = 1;
        $user->lang_id = 1;
        $user->user_type_id = 4;
        $user->save();
		
		$user->setActiveChecker();

        $company = new Company();
        $company->user_id = $user->id;
		if (Input::get('type_id') != 1)
			$company->is_vip = 1;
		else 
			$company->is_vip = 0;
        $company->status_id = 1;
        $company->is_restorant = (Input::get('type_id') == 1 ? 1 : 0);
		
		if (Input::has('title_1') && trim(Input::get('title_1'))!='')
			$company->title = Input::get('title_1');
		else 
			$company->title = Input::get('title_2');
		
        $company->photo = Input::get('logo');
        $company->activity = Input::get('activity');
        $company->web_site = Input::get('web_site');

		if (is_array(Input::get('phone')))
			$company->phone = implode(',', Input::get('phone'));
		else
			$company->phone = Input::get('phone');

		if (is_array(Input::get('mobile')))
			$company->mobile =  implode(',', Input::get('mobile'));
		else
			$company->mobile = Input::get('mobile');

		if (is_array(Input::get('location')))
			$company->location =  implode('|', Input::get('location'));
		else
			$company->location = Input::get('location');

        $company->save();
		
		if ($company->is_restorant){
			$restoran = new CompanyRestoran();
			$restoran->company_id = $company->id;
			
			
			$ar_cousine = Input::get('cousine_id');
			if (is_array($ar_cousine) && count($ar_cousine) > 0){
				$restoran->cousine = $ar_cousine;
			}
			
			$restoran->save();
		}



        foreach (Input::get('license') as $l) {
            $license = new CompanyFile();
            $license->company_id = $company->id;
            $license->file_type_id = 9;
            $license->path = $l;
            $license->save();
        }

        foreach ($data['cat_id'] as $type_id=>$ar_cats) {
            foreach ($ar_cats as $cat_id) {
                if (isset($data['subcat_id'][$cat_id])) {
                    foreach ($data['subcat_id'][$cat_id] as $sub_cat) {
                        $company_cat = new CompanyCat();
                        $company_cat->company_id = $company->id;
                        $company_cat->type_id = $type_id;
                        $company_cat->cat_id = $cat_id;
                        $company_cat->subcat_id = $sub_cat;
                        $company_cat->save();
                    }
                }
                else {
                    $company_cat = new CompanyCat();
                    $company_cat->company_id = $company->id;
                    $company_cat->type_id = $type_id;
                    $company_cat->cat_id = $cat_id;
                    $company_cat->save();
                }

            }

        }
        $company->setModerator();
		
		//Auth::loginUsingId($user->id);
		
        return Redirect::to('/')
						->with('success2',  '
											<center>You have registered with zaza.ae</center> <br />
											<center>and bonus AED 555  is in your <a href="'.action('CompanyController@getCabinet').'">account</a>!</center> <br />
											<center>Activation link has been sent to your email. Please follow the link.</center>');
    }

    function postSubCats () {
        $res = SysCompanySubcat::where('parent_id', Input::get('cat_id'))->orderBy('name', 'asc')->lists('name', 'id');
        echo json_encode($res);
    }

	function postCats () {
        $res = SysCompanyCat::where('type_id', Input::get('id'))->orderBy('name', 'asc')->lists('name', 'id');
        echo json_encode($res);
    }

    function postImage () {
        if (Input::hasFile('image')) {
            echo  ModelSnipet::setImage(Input::file('image'), 'company');
        }
        else
            echo '0';
    }
	
	function postFile () {
        if (Input::hasFile('image')) {
            echo  ModelSnipet::setImage(Input::file('image'), 'company', 'file');
        }
        else
            echo '0';
    }

	function postLike(){
		$company = Company::find(Input::get('id'));
		if (!$company)
			return '0';
		$company->setLike();

		return $company->total_like;
	}

	function postDislike (){
		$company = Company::find(Input::get('id'));
		if (!$company || !Auth::check())
			return '0';

		$user = Auth::user();
		CompanyLike::where(array('company_id'=>$company->id, 'user_id'=>$user->id))->delete();
		$company->total_like = $company->total_like - 1;
		$company->save();
		
		return $company->total_like;
	}

}
