<?php
/*
$val = '180,000,151,500';
$val = str_replace(",", "", $val);
echo intval($val );
exit();
*/
/*
$user = User::find(165);
$user->password = Hash::make('346488');
$user->save();
*/

User::setLastVizit();
CronTask::checkAdvertRenewReminder();
CronTask::checkCompanyOnlainIndex();
CronTask::checkPayAdvert();
CronTask::checkBanner();
CronTask::checkTopCompany();

//AdvertView::setNoteAuthView(3);

//echo '<pre>'; print_r(AdvertView::getUserListCount()); echo '</pre>'; exit();
/*
App::error(function($exception, $code)
{
    switch ($code){
		case 404:
            return Response::view('front.errors.404', array(), 404);
    }
});
*/

Route::post('trans/{name}', 'PageController@postTrans');

/*********Роутер Чата*************/
Route::get('message', 'MessageController@getIndex');
Route::post('message/send', 'MessageController@sendMessage');
Route::post('message/search', 'MessageController@searchDialogs');
Route::post('message/dialog/open', 'MessageController@openDialog');
Route::post('message/poll', 'MessageController@messagePolling');
Route::get('message/messages', 'MessageController@getMessages');

Route::get('message/check', 'MessageController@checkNewMessages');

/*********Роутер Карты*************/
Route::post('map-search', 'MapController@searchPlacesByLocation');
Route::post('map-all', 'MapController@getAllPlaces');
/***** Маршруты публичных страниц *****/
Route::get('/', 'PageController@getIndex');
Route::controller('ad', 'AdController');
Route::controller('catalog-ad', 'CatalogAdController');
Route::controller('catalog-company', 'CatalogCompanyController');
Route::controller('comment', 'CommentController');
Route::controller('blog', 'BlogController');
Route::controller('inquiry', 'InquiryController');
Route::controller('advert-us', 'BannerController');

Route::get('activate-account', 'PersonController@getActivateAccount');

Route::get('change-city/{id}', function ($id) {
	if (Auth::check()){
		$user = Auth::user();
		$user->city_id = $id;
		$user->save();
	}
	else {
		Session::put('def_city_id', $id);
	}

	return Redirect::back();
});

Route::post('onlain-user', function () {
	echo User::getCurrentOnlainUser();
});

/******* Машруты пользователей ******/
Route::get('facebook', 'PersonController@loginWithFacebook');
Route::post('facebook/setmail', 'PersonController@loginWithFacebookWithoutMail');
Route::get('facebook/checkmail', 'PersonController@checkEmail');
Route::get('google', 'PersonController@loginWithGoogle');
Route::any('logout', 'PersonController@getLogout');
Route::get('profile/{id}', 'PersonController@getView');
Route::get('user-profile/{id}', 'PersonController@getProfileView');
Route::post('registration', 'PersonController@postRegistration');
Route::post('registration_real', 'PersonController@postRegistrationReal');
Route::post('forget-password', 'PersonController@postForgetPassword');
Route::get('forget-password', 'PersonController@getForgetPassword');
Route::post('email', 'PersonController@postEmail');
Route::any('checkPhone', 'PersonController@checkPhone');

Route::group(array('before' => 'checkPerson'), function(){

	Route::get('personal-cabinet', 'PersonController@getCabinet');
	Route::get('personal-cabinet/update', 'PersonController@getCabinetUpdate');
	Route::post('personal-cabinet/send', 'PersonController@postCabinetUpdate');
	Route::post('personal-cabinet/article', 'PersonController@postAddArticle');
	Route::post('personal-cabinet/change-password', 'PersonController@postChangePassword');
});

/******* Маршруты компании *******/
Route::post('login', 'PersonController@postLogin');
Route::post('company/registration', 'CompanyController@postRegistration');
Route::post('company/get/subcat', 'CompanyController@postSubCats');
Route::post('company/get/cat', 'CompanyController@postCats');
Route::post('company/image', 'CompanyController@postImage');
Route::post('company/file', 'CompanyController@postFile');
Route::post('company/like', 'CompanyController@postLike');
Route::post('company/dislike', 'CompanyController@postDislike');

Route::group(array('before' => 'checkCompany'), function(){
	Route::get('company/cabinet', 'CompanyController@getCabinet');
	Route::post('company/to_top', 'CompanyController@postToTop');
});

Route::group(array('before' => 'checkCompanySimple'), function(){
	Route::controller('company-simple', 'CompanySimpleController');
});

Route::group(array('before' => 'checkCompanyVip'), function(){
	Route::controller('company-vip', 'CompanyVipController');
});

Route::group(array('before' => 'checkCompanyRestoran'), function(){
	Route::controller('restoran', 'CompanyRestoranController');
});

/******* Маршруты администратора *****/
Route::get('adminka/login', 'AdminController@getLogin');
Route::post('adminka/login', 'AdminController@postLogin');
Route::get('adminka/logout', 'AdminController@getLogout');

Route::group(array('before' => 'checkAdmin'), function(){
	Route::get('adminka/', 'AdminController@getIndex');
	Route::get('adminka/profile', 'AdminController@getProfile');
	Route::post('adminka/profile', 'AdminController@postProfile');

	Route::controller('adminka/moderator', 'AdminModeratorController');
	Route::controller('adminka/company-cat', 'AdminCompanyCatController');
	Route::controller('adminka/company-sub', 'AdminCompanySubController');
	Route::controller('adminka/adv-bar', 'AdminAdvBarController');
	Route::controller('adminka/adv-cat', 'AdminAdvCatController');
	Route::controller('adminka/adv-subcat', 'AdminAdvSubcatController');
    Route::controller('adminka/adv-prop', 'AdminAdvPropController');
	Route::controller('adminka/auto-brand', 'AdminAutoBrandController');
	Route::controller('adminka/auto-model', 'AdminAutoModelController');
	Route::controller('adminka/restoran-cousine', 'AdminRestoranCousineController');
	Route::controller('adminka/blog-interests', 'AdminBlogInterestController');
	Route::controller('adminka/stat', 'AdminStatController');
	

	Route::controller('adminka/statistic/moderator', 'AdminModeratorsStatisticController');
	
	Route::controller('adminka/report/ad', 'AdminReportAdController');
	Route::controller('adminka/report/company', 'AdminReportCompanyController');
	Route::controller('adminka/report/company-vip', 'AdminReportCompanyVipController');
	Route::controller('adminka/report/blog', 'AdminReportBlogController');
	Route::controller('adminka/report/comment', 'AdminReportComentController');
	Route::controller('adminka/report/banner', 'AdminReportBannerController');
	Route::controller('adminka/report/manager', 'AdminReportManagerController');
	

	Route::controller('adminka/trans/word', 'AdminTransWordsController');
	Route::controller('adminka/our-partner', 'AdminOurPartnersController');
	Route::controller('adminka/adv-banner', 'AdminOurBannerController');

	Route::controller('adminka/json', 'AjaxController');
});

/******* Маршруты модераторов *****/
Route::get('manager/login', 'ManagerController@getLogin');
Route::post('manager/login', 'ManagerController@postLogin');
Route::get('manager/logout', 'ManagerController@getLogout');

Route::group(array('before' => 'checkManager'), function(){
	Route::get('manager/', 'ManagerController@getIndex');
	Route::get('manager/profile', 'ManagerController@getProfile');
	Route::post('manager/profile', 'ManagerController@postProfile');

	Route::controller('manager/ad', 'ManagerAdController');
	Route::controller('manager/blog', 'ManagerBlogController');
	Route::controller('manager/comment', 'ManagerCommentController');
	Route::controller('manager/company', 'ManagerCompanyController');
	Route::controller('manager/banner', 'ManagerBannerController');
	
});


/*****  Тестовые машруты ******/
Route::get('test/terms', function () { 
	return View::make('front.test.terms');
});
Route::get('test/current_user_count', function () {
	$date_key = date('Ymd');
	echo $date_key; echo '<br />';
	
	if (Session::has('onlain_counter.'.$date_key)) {
		Session::put('onlain_counter.'.$date_key, 1);
		echo '<p>is note has</p>';
	}
	else {
		 echo '<p>is has</p>';
	}
	
	Session::forget('onlain_counter');
	
});

// устанавливаем язык по умалчанию
if (!Session::has('LANG')){
	App::setLocale('en');
	Session::put('LANG', 'en');
}
else{
	App::setLocale(Session::get('LANG'));
}

// маршруты переключение языков
Route::get('en', function () {
	App::setLocale('en');
	Session::put('LANG', 'en');

	return Redirect::back();
});
Route::get('ae', function () {
	App::setLocale('ae');
	Session::put('LANG', 'ae');

	return Redirect::back();
});
