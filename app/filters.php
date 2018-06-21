<?php
Route::filter('checkAdmin', function(){
	if (Auth::check() && Auth::user()->user_type_id!=1)
		Auth::logout();

	if (!(Auth::check()))
		return Redirect::action('AdminController@getLogin');
});

Route::filter('checkManager', function(){
	if (Auth::check() && Auth::user()->user_type_id!=2)
		Auth::logout();

	if (Auth::check() && Auth::user()->active!=1)
		Auth::logout();

	if (!(Auth::check()))
		return Redirect::action('ManagerController@getLogin');
});

Route::filter('csrf', function(){
	if (Session::token() !== Input::get('_token')){
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('checkPerson', function(){
	if (Auth::check() && Auth::user()->user_type_id!=3)
		Auth::logout();

	if (!(Auth::check()))
		return Redirect::action('PageController@getIndex');
});

Route::filter('checkCompany', function(){
	if (Auth::check() && Auth::user()->user_type_id!=4)
		Auth::logout();

	if (!(Auth::check()))
		return Redirect::action('PageController@getIndex');
});

Route::filter('checkCompanySimple', function(){
	if (Auth::check() && (Auth::user()->user_type_id!=4 || (Auth::user()->user_type_id==4 && Auth::user()->relCompany->is_vip != 0)))
		Auth::logout();

	if (!(Auth::check()))
		return Redirect::action('PageController@getIndex');
});

Route::filter('checkCompanyVip', function(){
	if (Auth::check() && (Auth::user()->user_type_id!=4 || (Auth::user()->user_type_id==4 && Auth::user()->relCompany->is_vip == 0)))
		Auth::logout();

	if (!(Auth::check()))
		return Redirect::action('PageController@getIndex');
});

Route::filter('checkCompanyRestoran', function(){
	if (Auth::check() && (Auth::user()->user_type_id!=4 || (Auth::user()->user_type_id==4 && Auth::user()->relCompany->is_restorant == 0)))
		Auth::logout();

	if (!(Auth::check()))
		return Redirect::action('PageController@getIndex');
});
