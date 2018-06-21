<?php
class AdminCompanySubController extends BaseController {

    function getIndex () {
        $ar = array();
        $ar['title'] = 'Company sub-categories';
        $ar['ar_types'] = SysCompanyType::lists('name', 'id');
        $ar['ar_cats'] = SysCompanyCat::lists('name', 'id');
		
		if (Input::has('name')) 
			$ar['subcats'] = SysCompanySubcat::where('name', 'like', '%'.Input::get('name').'%')->paginate(25);
		else 
			$ar['subcats'] = SysCompanySubcat::paginate(25);
		
		if (Input::has('sort_name') && Input::has('sort_val')){
			if(Input::get('sort_name') == 'idsub' && Input::get('sort_val') == 'down'){
				$ar['subcats'] = SysCompanySubcat::orderBy('id', 'ASC')->paginate(25);
			}
			else if(Input::get('sort_name') == 'idsub' && Input::get('sort_val') == 'up'){
				$ar['subcats'] = SysCompanySubcat::orderBy('id', 'DESC')->paginate(25);
			}
			else if(Input::get('sort_name') == 'namesub' && Input::get('sort_val') == 'down'){
				$ar['subcats'] = SysCompanySubcat::orderBy('name', 'ASC')->paginate(25);
			}
			else if(Input::get('sort_name') == 'namesub' && Input::get('sort_val') == 'up'){
				$ar['subcats'] = SysCompanySubcat::orderBy('name', 'DESC')->paginate(25);
			}
		}

        return View::make('admin.directory.company-sub.index', $ar);
    }

    

    function getSubCat ($id = 0) {
        $item = SysCompanySubcat::find($id);

        $ar = array();
        if (!$item) {
            $ar['title'] = 'Add new subcategory';
            $ar['action'] = action('AdminCompanySubController@postSubCat');
        } else {
            $ar['title'] = 'Edit subcategory';
            $ar['action'] = action('AdminCompanySubController@postSubCat', $item->id);
            $ar['item'] = $item;
        }
        $ar['ar_cats'] = SysCompanyCat::lists('name', 'id');

        return View::make('admin.directory.company-sub.sub-cat', $ar);
    }

    function postSubCat ($id = 0) {
        $item = SysCompanySubcat::find($id);
        if (!$item)
            $item = new SysCompanySubcat();

        $item->name = Input::get('name');
        $item->parent_id = Input::get('parent_id');

        if (!$item->save())
            return Redirect::back()->withErrors($item->getErrors());

        return Redirect::action('AdminCompanySubController@getIndex')->with('success', 'Data saved successfully');
    }

}
