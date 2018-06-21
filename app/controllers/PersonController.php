<?php
class PersonController extends BaseController {

	function getActivateAccount(){
		$user = User::findOrFail(Input::get('user_id'));
		if (!$user->checkActiveChecker(Input::get('pass')))
			return App::abort(404);

		Auth::loginUsingId($user->id);

		return Redirect::to('/');
	}

	function getView($id) {
		$user = User::findOrFail($id);
		if ($user->user_type_id == 3)
			return Redirect::action('PersonController@getProfileView', $user->id);

		if ($user->user_type_id == 4)
			return Redirect::action('CatalogCompanyController@getCompanyView', $user->relCompany->id);

		App::abort(404);
	}

    function postRegistration(){
        $check_user = User::where('email', Input::get('email'))->first();
        if ($check_user)
            return Redirect::back()->with('error', 'This email already use');

        DB::beginTransaction();
        $user = new PreRegister();
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->pass_see = Input::get('password');
        $user->active = 1;
        $user->country_id = 1;
        $user->city_id = 1;
        $user->lang_id = 1;
        $user->user_type_id = 3;


        if (!$user->save()) {
            DB::rollback();
            //return Redirect::back()->withErrors($user->getErrors());
        }

        $user->setActiveChecker(Input::get('phone'));

        $person = $user;
        $person->user_id =  $user->id;
        $person->auth_id = 0;
        $person->auth_from = 0;
        $person->full_name = Input::get('full_name');
        $person->status_id = 1;
        $person->phone = Input::get('phone');
        if (!$person->save()) {
            DB::rollback();
            //return Redirect::back()->withErrors($person->getErrors());
        }

        DB::commit();

        return json_encode(array('id'=>$user->id,'confirm_active'=>$user->id));
        /*return Redirect::to('/')
                        ->with('success2', ' <center>You have registered with zaza.ae</center> <br />
                                            <center>and bonus  AED 222  is in your account!</center>');*/
    }

    function postRegistrationReal(){
        $pre_user_id = (int)Input::get('user_id');
        if($pre_user = PreRegister::where('id', $pre_user_id)->first()){
            DB::beginTransaction();
            $user = new User();
            $user->email = $pre_user->email;
            $user->password = $pre_user->password;
            $user->pass_see = $pre_user->pass_see;
            $user->active = 1;
            $user->country_id = 1;
            $user->city_id = 1;
            $user->lang_id = 1;
            $user->user_type_id = 3;
            $user->confirm_active = rand(1000000,9999999);
            $user->is_active = 0;
            $user->save();

            if (!$user->save()) {
                DB::rollback();
                //return Redirect::back()->withErrors($user->getErrors());
            }

            $person = new Person();
            $person->user_id =  $user->id;
            $person->auth_id = 0;
            $person->auth_from = 0;
            $person->full_name = $pre_user->full_name;
            $person->status_id = 1;
            $person->phone = $pre_user->phone;
            if (!$person->save()) {
                DB::rollback();
                //return Redirect::back()->withErrors($person->getErrors());
            }

            DB::commit();
            return json_encode(array('result'=>array('user_id'=>$user->id,'confirm_code'=>$user->confirm_active)));
        }
    }

    function postLogin (){ //обработка входа в систему
		$input = array(
			'email' => Input::get('email'),
			'password'  => Input::get('password'),
			'user_type_id'  => 3,
			'is_active' => 1
		);

		if (Auth::attempt($input,true))
			return Redirect::action('PersonController@getCabinet');


        $input = array(
			'email' => Input::get('email'),
			'password'  => Input::get('password'),
			'user_type_id'  => 4,
			'is_active' => 1
		);

        if (Auth::attempt($input,true))
			return Redirect::action('CompanyController@getCabinet');


		$alert = "You have entered incorrect combination of login and password or did not activate your account";

		return Redirect::back()->withError($alert);
	}

    function loginWithFacebookWithoutMail() {
        if (Auth::check()){
            $user = Auth::user();
            $user->email = Input::get('email');
            $user->save();
            MailSend::sendMessageRegistration($user);
        }
        return Redirect::action('PageController@getIndex');
    }

    function checkEmail(){
        if (User::where('email', Input::get('email'))->first())
            return 1;
        else
            return 0;
    }

    function loginWithFacebook() {
        if (Auth::check())
            Auth::logout();
        $code = Input::get('code');
        $OAuth = new OAuth();
        $OAuth::setHttpClient('CurlClient');
        $fb = $OAuth::consumer('Facebook', Input::get('redirectUri'));

        if (!empty($code)) {
            $token = $fb->requestAccessToken($code);
            $result = json_decode($fb->request('/me?fields=id,name,first_name,last_name,email'), true);
                $person = Person::where(array('auth_id' => $result['id'], 'auth_from' => Person::getFacebookFrom()))->first();
                if (!$person) {
                    $user = new User();
                    if(!isset($result['email']))
                        $user->email = "none";
                    else
                        $user->email = $result['email'];
                    $user->active = 1;
                    $user->user_type_id = 3;
                    $user->save();

                    $person = new Person();
                    $person->auth_id = $result['id'];
                    $person->auth_from = Person::getFacebookFrom();
                    $person->full_name = $result['name'];
                    $person->photo = '/front/img/no-profile-img.gif';
                    $person->user_id = $user->id;
                    $person->save();
                }
                Auth::loginUsingId($person->user_id);
                $check_user = Auth::user();
                if($check_user){
                    $mail = $check_user->email;
                    if($mail == "none")
                        return Redirect::action('PageController@getIndex')->with('setmailfbook','Please set your email');
                    else
                        return Redirect::action('PageController@getIndex');
                    }
        }else {
            $url = $fb->getAuthorizationUri();
            return Redirect::to((string)$url);
        }
    }

	function loginWithGoogle() {
        /*
        if (Auth::check())
            Auth::logout();
            */

	    $code = Input::get( 'code' );
	    $googleService = OAuth::consumer( 'Google' );

	    if ( !empty( $code ) ) {
	        $token = $googleService->requestAccessToken( $code );
	        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true);

            $person = Person::where(array('auth_id'=>$result['id'], 'auth_from'=>Person::getGoogleFrom()))->first();
            if (!$person) {
                $user = new User();
                if (isset($result['given_name']))
                    $user->f_name = $result['given_name'];
                if (isset($result['family_name']))
                    $user->l_name = $result['family_name'];
                $user->email = $result['email'];
                $user->active = 1;
                $user->user_type_id = 3;
                $user->save();

                $person = new Person();
                $person->auth_id = $result['id'];
                $person->auth_from = Person::getGoogleFrom();
                $person->full_name = $result['name'];
                if (isset($result['picture']))
                    $person->photo = $result['picture'];
                else
                    $person->photo = '/front/img/no-profile-img.gif';
                if (isset($result['given_name']))
                    $person->f_name = $result['given_name'];
                if (isset($result['family_name']))
                    $person->s_name = $result['family_name'];
                $person->user_id = $user->id;
                $person->save();
            }


            Auth::loginUsingId($person->user_id);

            return Redirect::action('PageController@getIndex');
	    }
	    else {
	        $url = $googleService->getAuthorizationUri();
	        return Redirect::to( (string)$url );
	    }

	}

    function getCabinet () {
        $user = Auth::user();
        $personal = Person::where('user_id', $user->id)->first();
        if (!$personal)
            App::abort(404);

		if (Input::has('add_interest')){
            $interest = Input::get('add_interest');
            $item = PersonInterest::where(array('person_id'=>$personal->id, 'interest_id'=>$interest))->first();
            if (!$item)
                PersonInterest::create(array('person_id'=>$personal->id, 'interest_id'=>$interest));
            else
                $item->delete();

			return Redirect::back();
        }

		$ar_com_likes = CompanyLike::where('user_id', $user->id)->lists('company_id');
		$ar_person_interest = PersonInterest::where('person_id', $personal->id)->lists('interest_id');
		$solial = $user->relSocial;
		if (!$solial){
			$solial = new Social();
			$solial->user_id = $user->id;
			$solial->save();
		}


        $ar = array();
		$ar['title'] = 'Personal cabinet "'.$personal->full_name.'"';
        $ar['user'] = $user;
        $ar['personal'] = $personal;
        $ar['social'] = $solial;

        $ar['restorants'] = Company::whereIn('id', $ar_com_likes)->where(array('is_restorant'=>1))->get();
        $ar['services'] = Company::whereIn('id', $ar_com_likes)->where(array('is_restorant'=>0))->whereHas('relCat', function($q){
			$q->where(array('type_id'=>2));
		})->get();
        $ar['shops'] = Company::whereIn('id', $ar_com_likes)->where(array('is_restorant'=>0))->whereHas('relCat', function($q){
			$q->where(array('type_id'=>3));
		})->get();

		$ar['ar_interest'] = SysBlogInterest::whereIn('id', $ar_person_interest)->get();
		$ar['person_interest'] = PersonInterest::where('person_id', $personal->id)->lists('interest_id');
		$ar['blog_interest'] = SysBlogInterest::whereIn('id', $ar_person_interest)->lists('name', 'id');
		$ar['blogs'] = Blog::whereIn('interest_id', $ar_person_interest)->orWhere('user_id', $user->id)->orderBy('id', 'desc')->paginate(12);

		$ar_share_blog_id = UserBlogShare::where('user_id', $user->id)->lists('blog_id');
		//$ar['shares'] = Blog::where('user_type_id', 3)->where('user_id', $user->id)->orderBy('id', 'desc')->paginate(12);
		$ar['shares'] = Blog::where(function($q) use($user){
									$q->where('user_type_id', 3)->where('user_id', $user->id);
								})
								->orWhere(function($q) use ($ar_share_blog_id){
									$q->whereIn('id', $ar_share_blog_id);
								})
								->orderBy('id', 'desc')
								->paginate(12);

		$ar['my_like'] = Advert::whereHas('relLike', function($q) use ($user) {
			$q->where('user_id', $user->id);
		})->get();
		$ar['my_adds'] = Advert::where('user_id', $user->id)->orderBy('id', 'desc')->get();
		$ar['all_ads_ids'] = $ar['my_adds']->lists('id');

		return View::make('front.personal-page.index', $ar);
    }

	function getProfileView($user_id){
		$user = User::findOrFail($user_id);
        $personal = Person::where('user_id', $user->id)->first();
        if (!$personal)
            App::abort(404);

		$ar_com_likes = CompanyLike::where('user_id', $user->id)->lists('company_id');
		$ar_person_interest = PersonInterest::where('person_id', $personal->id)->lists('interest_id');

        $ar = array();
		$ar['title'] = 'Personal cabinet "'.$personal->full_name.'"';
        $ar['user'] = $user;
        $ar['personal'] = $personal;
        $ar['social'] = $user->relSocial;

        $ar['restorants'] = Company::whereIn('id', $ar_com_likes)->where(array('is_restorant'=>1))->get();
        $ar['services'] = Company::whereIn('id', $ar_com_likes)->where(array('is_restorant'=>0))->whereHas('relCat', function($q){
			$q->where(array('type_id'=>2));
		})->get();
        $ar['shops'] = Company::whereIn('id', $ar_com_likes)->where(array('is_restorant'=>0))->whereHas('relCat', function($q){
			$q->where(array('type_id'=>3));
		})->get();

		$ar['ar_interest'] = SysBlogInterest::whereIn('id', $ar_person_interest)->get();
		$ar['blog_interest'] = SysBlogInterest::whereIn('id', $ar_person_interest)->lists('name', 'id');
		$ar['blogs'] = Blog::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(12);

		return View::make('front.personal-page.view', $ar);
	}

    function getCabinetUpdate () {
        $user = Auth::user();
        $personal = Person::where('user_id', $user->id)->first();
        if (!$personal)
            App::abort(404);

		$ar_person_interest = PersonInterest::where('person_id', $personal->id)->lists('interest_id');

        $ar = array();
		$ar['title'] = 'Personal cabinet "'.$personal->full_name.'"';
        $ar['user'] = $user;
        $ar['personal'] = $personal;
        $ar['social'] = $user->relSocial;
        $ar['restorants'] = PersonCompany::where(array('person_id'=>$personal->id, 'company_type_id'=>1))->get();
        $ar['services'] = PersonCompany::where(array('person_id'=>$personal->id, 'company_type_id'=>2))->get();
        $ar['shops'] = PersonCompany::where(array('person_id'=>$personal->id, 'company_type_id'=>3))->get();
        $ar['ar_city'] = SysCity::getCityAr();
        $ar['ar_interest'] = SysBlogInterest::get();
        $ar['get_interest'] = Input::get('interest');
        $ar['blogs'] = Blog::where('user_id', $user->id)->orderBy('id', 'desc')->get();


        if (Input::has('add_interest')){
            $interest = Input::get('add_interest');
            $item = PersonInterest::where(array('person_id'=>$personal->id, 'interest_id'=>$interest))->first();
            if (!$item)
                PersonInterest::create(array('person_id'=>$personal->id, 'interest_id'=>$interest));
            else
                $item->delete();

			return Redirect::back();
        }

        $ar['person_interest'] = PersonInterest::getInterestPersonKeys($personal->id);
		$ar['blog_interest'] = SysBlogInterest::whereIn('id', $ar_person_interest)->lists('name', 'id');

		return View::make('front.personal-page.update', $ar);
    }

    function postCabinetUpdate () {
        if (!Input::has('name') || !Input::has('type')) {
            return '0';
        }
        $type = Input::get('type');
        $value = Input::get('value');
        $name = Input::get('name');

        if ($type == 'person') {
            $ar_names = array('full_name', 'about', 'phone', 'mobile');
            if (!in_array($name, $ar_names)) {
                return '0';
            }

            $user = Auth::user();
            $personal = Person::where('user_id', $user->id)->first();
            $personal->$name = $value;
            $personal->save();

            return '1';
        }
        else if ($type == 'user') {
            $ar_names = array('city_id', 'email', 'location');
            if (!in_array($name, $ar_names)) {
                return '0';
            }

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
            $ar_names = array('facebook', 'instagram', 'skype');
            if (!in_array($name, $ar_names)) {
                return '0';
            }

            $user = Auth::user();
            $social = Social::where('user_id', $user->id)->first();
            if (!$social) {
                $social = new Social();
                $social->user_id = $user->id;
            }

            $social->$name = $value;
            $social->save();

            return '1';
        }
        else if ($type == 'photo') {
            if (Input::hasFile('value')) {
                $user = Auth::user();

                $personal = Person::where('user_id', $user->id)->first();
                $personal->photo = ModelSnipet::setImage(Input::file('value'), 'logo');
                $personal->save();

                return $personal->photo;
            }
        }
        else if ($type == 'photo_before') {
            $user = Auth::user();
            $personal = Person::where('user_id', $user->id)->first();
            if ($value == '')
                $personal->photo = '/front/img/no-profile-img.gif';
            else
                $personal->photo = $value;
            $personal->save();

            return $personal->photo;
        }

        return '0';

    }

    function postAddArticle () {
        $user = Auth::user();
        $personal = Person::where('user_id', $user->id)->first();

        $blog = new Blog();
        $blog->user_type_id = 3;
        $blog->user_id = $user->id;
        $blog->type_id = 1;
        $blog->status_id = 1;
        $blog->note = Input::get('about');
        $blog->interest_id = Input::get('interest');

        if (Input::hasFile('photo'))
            $blog->photo = ModelSnipet::setImage(Input::file('photo'), 'article');

        $blog->save();

        return Redirect::back();
    }

    function getLogout (){ // выход из системы
		Auth::logout();

		return Redirect::back();
	}

	function postForgetPassword (){
		$user = User::where('email', Input::get('email'))->first();
		if (!$user)
			return Redirect::back()->withError('This email is not registered with zaza.ae');

		$user->change_password = str_random(18);
		$user->save();

		MailSend::sendForgotPasswordMessage($user);

		return Redirect::back()->with('success', 'Message has been sent to your email');
	}

	function getForgetPassword (){
		$user = User::where('id', Input::get('id'))->where('change_password', Input::get('key'))->first();
		if (!$user)
			App::abort(404);

		$new_password = str_random(6);
		$user->password = Hash::make($new_password);
		$user->change_password = 0;
		$user->save();

		MailSend::sendNewPasswordMessage($user, $new_password);

		return Redirect::action('PageController@getIndex')->with('success', 'New password has been sent to your email.');
	}

	function postChangePassword () {
		$user = Auth::user();
        $personal = Person::where('user_id', $user->id)->first();
        if (!$personal)
            App::abort(404);

		if (!Input::has('old_password') || !Input::has('new_password') || !Input::has('repeat_new_password'))
			App::abort(404);

		if (Input::get('new_password') != Input::get('repeat_new_password'))
			return Redirect::back()->with('error', 'Enter the same value to set new password');

		/*
		echo Hash::make(Input::get('old_password')).'<br />';
		echo $user->password;
		exit();
		if (Hash::check(Input::get('old_password'), $user->password))
			return Redirect::back()->with('error', 'Enter true old password to set new password');
		*/
		//if (Hash::make(Input::get('old_password')) != $user->password)


		$user->password = Hash::make(Input::get('new_password'));
		$user->save();

		return Redirect::back()->with('success', 'Password has been changed successfully');
	}

	function postEmail () {
		if (!Input::has('email'))
			return '0';

		if (User::where('email', Input::get('email'))->first())
			return '0';

		return '1';
	}

    function checkPhone(){
        if (!Input::has('phone')) {
            return 0;
        }
        $phone = preg_replace('/[^0-9]/i','', Input::get('phone'));
        return ( Person::where('phone','like','%'.$phone)->orWhere('phone','like','%'.Input::get('phone'))->first() )
            ? 0 : 1;
    }
}
