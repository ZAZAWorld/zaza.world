<?php
class AdminModeratorController extends BaseController {

    function getIndex () {
        $ar = array();
        $ar['title'] = 'Moderators';
        $ar['items'] = Moderator::with('relUser')->paginate(25);
		$ar['ar_company_types'] = SysCompanyType::lists('name', 'id');
        $ar['ar_company_cats'] = array(null=>'', 0=>'')+SysCompanyCat::lists('name', 'id');
		$ar['ar_ad_cat_1'] = SysAdvertCat::where('level', 1)->lists('name', 'id');
		$ar['ar_ad_cat_2'] = array(null=>'', 0=>'')+SysAdvertCat::where('level', 2)->lists('name', 'id');
        $ar['breadcrumb'] = $this->generateBreadcrumbs(array(array('url'=>action('AdminModeratorController@getIndex'), 'name'=>'Moderators')));

		return View::make('admin.moderator.index', $ar);
    }

    function getItem ($id = 0) {
        $moderator = Moderator::find($id);

        $ar = array();
        if (!$moderator) {
            $ar['action'] = action('AdminModeratorController@postItem');
            $ar['title'] = 'Add new moderator';
        }
        else {
            $ar['action'] = action('AdminModeratorController@postItem', $moderator->id);
            $ar['title'] = 'Edit moderator';
            $ar['user'] =  User::findOrFail($moderator->user_id);
            $ar['moderator'] = $moderator;
        }
        $ar['ar_lang'] = SysLang::lists('name', 'id');
		$ar['ar_country'] = SysCountry::lists('name', 'id');
		$ar['ar_city'] = SysCity::lists('name', 'id');
        $ar['breadcrumb'] = $this->generateBreadcrumbs(array(
                                                            array('url'=>action('AdminModeratorController@getIndex'), 'name'=>'Moderators'),
                                                            array('url'=>action('AdminModeratorController@getItem', $id), 'name'=>$ar['title'])
                                                        ));

        return View::make('admin.moderator.item', $ar);
    }

    function postItem ($id = 0) {
        DB::beginTransaction();

        $moderator = Moderator::find($id);
        if (!$moderator) {
            $moderator = new Moderator();
            $user = new User();
        }
        else
            $user = User::findOrFail($moderator->user_id);

        $user->user_type_id = 2;
        $user->active = 1;
        $user->email = Input::get('email');
        $user->f_name = Input::get('f_name');
        $user->l_name = Input::get('l_name');
        $user->lang_id = Input::get('lang_id');
        $user->country_id = Input::get('country_id');
        $user->city_id = Input::get('city_id');
        $user->password = Hash::make(Input::get('password'));
        if (!$user->save()) {
            DB::rollback();
            return Redirect::back()->withErrors($user->getErrors());
        }

        $moderator->user_id = $user->id;
        $moderator->f_name = Input::get('f_name');
        $moderator->l_name = Input::get('l_name');
        $moderator->p_name = Input::get('p_name');
        $moderator->phones = Input::get('phones');
        $moderator->mobile = Input::get('mobile');
        $moderator->address = Input::get('address');
        if (!$moderator->save()){
            DB::rollback();
			return Redirect::back()->withErrors($moderator->getErrors());
        }
        DB::commit();

        return Redirect::back()->with('success', 'Data saved successfully');
    }

    function getCompanyModerate ($id) {
        $item = Moderator::findOrFail($id);

        $ar = array();
        $ar['title'] = 'Company maderate rights';

        $ar['rights'] = ModeratorRight::where(array('type_id'=>1, 'moderator_id'=>$item->id))->paginate(25);

        $ar['ar_types'] = SysCompanyType::lists('name', 'id');
        $ar['ar_cats'] = SysCompanyCat::lists('name', 'id');
        $ar['ar_subcats'] = SysCompanySubcat::lists('name', 'id');
        $ar['item'] = $item;

        return View::make('admin.moderator.company-cat', $ar);
    }

    function postCompanyModerate ($id) {
        $item = Moderator::findOrFail($id);

        $right = new ModeratorRight();
        $right->type_id = 1;
        $right->moderator_id = $item->id;
        $right->cat1_id = Input::get('cat1_id');
        $right->cat2_id = Input::get('cat2_id');
        $right->cat3_id = Input::get('cat3_id');
        if (!$right->save())
            return Redirect::back()->withErrors($right->getErrors());

        return Redirect::back()->with('success', 'Data saved successfully');
    }

    function getDeleteCompanyModerate ($id) {
        $right = ModeratorRight::findOrFail($id);
        $right->delete();

        return Redirect::back()->with('success', 'Data saved deleted');
    }
	
	function getAdModerate ($id) {
        $item = Moderator::findOrFail($id);

        $ar = array();
        $ar['title'] = 'Ad maderate rights';

        $ar['rights'] = ModeratorRight::where(array('type_id'=>2, 'moderator_id'=>$item->id))->paginate(25);

        $ar['ar_ad_cat_1'] = SysAdvertCat::where('level', 1)->lists('name', 'id');
		$ar['ar_ad_cat_2'] = array(null=>'', 0=>'')+SysAdvertCat::where('level', 2)->lists('name', 'id');
        $ar['item'] = $item;

        return View::make('admin.moderator.ad-cat', $ar);
    }

    function postAdModerate ($id) {
        $item = Moderator::findOrFail($id);

        $right = new ModeratorRight();
        $right->type_id = 2;
        $right->moderator_id = $item->id;
        $right->cat1_id = Input::get('cat1_id');
        $right->cat2_id = Input::get('cat2_id');
        if (!$right->save())
            return Redirect::back()->withErrors($right->getErrors());

        return Redirect::back()->with('success', 'Data saved successfully');
    }

    function getDeleteAdModerate ($id) {
        $right = ModeratorRight::findOrFail($id);
        $right->delete();

        return Redirect::back()->with('success', 'Data saved deleted');
    }

	function getModerateBlogRight ($id) {
		$moderator = Moderator::findOrFail($id);
		$moderator->moderate_blog = ($moderator->moderate_blog ? 0 : 1);
		if (!$moderator->save())
			return Redirect::back()->withErrors($moderator->getErrors());
		
		return Redirect::back()->with('success', 'Data saved successfully');
	}
	
	function getModerateCommentRight ($id) {
		$moderator = Moderator::findOrFail($id);
		$moderator->maderate_comment = ($moderator->maderate_comment ? 0 : 1);
		if (!$moderator->save())
			return Redirect::back()->withErrors($moderator->getErrors());
		
		return Redirect::back()->with('success', 'Data saved successfully');
	}

	function getModerateBanner ($id) {
		$moderator = Moderator::findOrFail($id);
		$moderator->moderate_banner = ($moderator->moderate_banner ? 0 : 1);
		if (!$moderator->save())
			return Redirect::back()->withErrors($moderator->getErrors());
		
		return Redirect::back()->with('success', 'Data saved successfully');
	}
}
