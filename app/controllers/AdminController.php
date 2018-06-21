<?php
class AdminController extends BaseController {
	protected $guarded = array('id');

	public function getLogin() { //страница входа в систему
		return View::make('admin.login');
	}

	public function postLogin (){ //обработка входа в систему
		$input = array(
			'email' => Input::get('email'),
			'password'  => Input::get('password'),
			'user_type_id'  => 1
		);

		if (Auth::attempt($input,true))
			return Redirect::action('AdminController@getIndex');

		$alert = "Invalid combination of username and password";

		return Redirect::back()->withError($alert);
	}

	public function getLogout (){ // выход из системы
		Auth::logout();

		return Redirect::action('AdminController@getLogin');
	}

	public function getIndex () {
		return View::make('admin.index');
	}

	public function getProfile () {
		$ar = array();
		$ar['user'] = Auth::user();
		$ar['ar_lang'] = SysLang::lists('name', 'id');
		$ar['ar_country'] = SysCountry::lists('name', 'id');
		$ar['ar_city'] = SysCity::lists('name', 'id');
		$ar['title'] = 'Profile';
		$ar['breadcrumb'] = $this->generateBreadcrumbs(array(array('url'=>action('AdminController@getProfile'), 'name'=>'Profile')));

		return View::make('admin.profile', $ar);
	}

	public function postProfile () {
		$user = Auth::user();
		$user->email = Input::get('email');
		$user->f_name = Input::get('f_name');
		$user->l_name = Input::get('l_name');
		$user->password = Hash::make(Input::get('password'));
		$user->lang_id = Input::get('lang_id');
		$user->country_id = Input::get('country_id');
		$user->city_id = Input::get('city_id');

		if (!$user->save())
			return Redirect::back()->withErrors($user->getErrors());

		return Redirect::back()->with('success', 'Data saved successfully');
	}

}
