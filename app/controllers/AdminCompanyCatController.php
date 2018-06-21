<?php
class AdminCompanyCatController extends BaseController {

    function getIndex () {
        $ar = array();
        $ar['title'] = 'Company categories';
        $ar['ar_types'] = SysCompanyType::lists('name', 'id');
        $ar['ar_cats'] = SysCompanyCat::lists('name', 'id');
		
		if (Input::has('name')) 
			$ar['cats'] = SysCompanyCat::where('name', 'like', '%'.Input::get('name').'%')->paginate(25);
		else 
			$ar['cats'] = SysCompanyCat::paginate(25);
		
		if (Input::has('sort_name') && Input::has('sort_val')){
			if (Input::get('sort_name') == 'id' && Input::get('sort_val') == 'down'){
				$ar['cats'] = SysCompanyCat::orderBy('id', 'ASC')->paginate(25);
			}
			else if(Input::get('sort_name') == 'id' && Input::get('sort_val') == 'up'){
				$ar['cats'] = SysCompanyCat::orderBy('id', 'DESC')->paginate(25);
			}
			else if(Input::get('sort_name') == 'name' && Input::get('sort_val') == 'down'){
				$ar['cats'] = SysCompanyCat::orderBy('name', 'ASC')->paginate(25);
			}
			else if(Input::get('sort_name') == 'name' && Input::get('sort_val') == 'up'){
				$ar['cats'] = SysCompanyCat::orderBy('name', 'DESC')->paginate(25);
			}
			else if(Input::get('sort_name') == 'type' && Input::get('sort_val') == 'down'){
				$ar['ar_types'] = SysCompanyType::orderBy('id', 'ASC')->lists('name', 'id');
			}
			else if(Input::get('sort_name') == 'type' && Input::get('sort_val') == 'up'){
				$ar['ar_types'] = SysCompanyType::orderBy('id', 'DESC')->lists('name', 'id');
			}
		}

        return View::make('admin.directory.company-cat.index', $ar);
    }

    function getCat ($id = 0) {
        $item = SysCompanyCat::find($id);

        $ar = array();
        if (!$item) {
            $ar['title'] = 'Add new category';
            $ar['action'] = action('AdminCompanyCatController@postCat');
        } else {
            $ar['title'] = 'Edit category';
            $ar['action'] = action('AdminCompanyCatController@postCat', $item->id);
            $ar['item'] = $item;
        }
        $ar['ar_types'] = SysCompanyType::lists('name', 'id');

        return View::make('admin.directory.company-cat.cat', $ar);
    }

    function postCat ($id = 0) {
        $item = SysCompanyCat::find($id);
        if (!$item)
            $item = new SysCompanyCat();

        $item->name = Input::get('name');
        $item->type_id = Input::get('type_id');

        if (!$item->save())
            return Redirect::back()->withErrors($item->getErrors());

        return Redirect::action('AdminCompanyCatController@getIndex')->with('success', 'Data saved successfully');
    }

}
