<?php
class AdminAdvPropController extends BaseController {

    function getIndex () {
        $ar = array();
        $ar['title'] = 'Advert properties';
        $ar['items'] = SysAdvertProp::orderBy('id', 'desc')->with('relPropCat', 'relPropOption')->paginate(20);
        $ar['ar_types'] = SysAdvertPropType::lists('name', 'id');
		$ar['ar_cat'] = SysAdvertCat::lists('name', 'id');

		if (Input::has('sort_name') && Input::has('sort_val')){
			if (Input::get('sort_name') == 'id' && Input::get('sort_val') == 'down'){
				$ar['items'] = SysAdvertProp::orderBy('id', 'ASC')->with('relPropCat', 'relPropOption')->paginate(20);
			}
			else if(Input::get('sort_name') == 'id' && Input::get('sort_val') == 'up'){
				$ar['items'] = SysAdvertProp::orderBy('id', 'DESC')->with('relPropCat', 'relPropOption')->paginate(20);
			}
			else if(Input::get('sort_name') == 'name' && Input::get('sort_val') == 'down'){
				$ar['items'] = SysAdvertProp::orderBy('name', 'ASC')->with('relPropCat', 'relPropOption')->paginate(20);
			}
			else if(Input::get('sort_name') == 'name' && Input::get('sort_val') == 'up'){
				$ar['items'] = SysAdvertProp::orderBy('name', 'DESC')->with('relPropCat', 'relPropOption')->paginate(20);
			}
		}
		
        return View::make('admin.directory.adv-prop.index', $ar);
    }

    function getItem ($id = 0) {
        $item = SysAdvertProp::find($id);

        $ar = array();
        if (!$item) {
            $ar['title'] = 'Add new advert property';
            $ar['action'] = action('AdminAdvPropController@postItem');
        }
        else {
            $ar['title'] = 'Edit advert property';
            $ar['action'] = action('AdminAdvPropController@postItem', $item->id);
            $ar['item'] = $item;
        }
        $ar['ar_icons'] = SysAdvertProp::getArIconWithSpan();
        $ar['ar_types'] = SysAdvertPropType::lists('name', 'id');
        $ar['ar_many'] = array(0=>'single', 1=>'Many');
        $ar['ar_option'] = array(0=>"hasn't option", 1=>'has option');

        return View::make('admin.directory.adv-prop.item', $ar);
    }

    function postItem ($id = 0) {
        $item = SysAdvertProp::find($id);
        if (!$item)
            $item = new SysAdvertProp();
        $item->name = Input::get('name');
        $item->icon = Input::get('icon');
        $item->type_id = Input::get('type_id');
        $item->is_many = Input::get('is_many');
        $item->is_option = Input::get('is_option');
        $item->save();

        return Redirect::action("AdminAdvPropController@getIndex")->with('success', 'Data saved successfully');
    }

    function postAdvertCatAjax () {
          $ar = SysAdvertCat::where('parent_id', Input::get('parent_id'))->lists('name', 'id');
		      echo json_encode($ar);
    }

    function getCat ($id) {
        $item = SysAdvertProp::findOrFail($id);

        $ar = array();
        $ar['title'] = 'Advert property categories';
        $ar['items'] = SysAdvertPropCat::where('prop_id', $item->id)->get();
        $ar['ar_cat_1'] = SysAdvertCat::getFullArrNames(1);
        $ar['ar_cat_2'] = array(null => '', 0 => '') + SysAdvertCat::getFullArrNames(2);
        $ar['ar_cat_3'] = array(null => '', 0 => '') + SysAdvertCat::getFullArrNames(3);
        $ar['ar_cat_4'] = array(null => '', 0 => '') + SysAdvertCat::getFullArrNames(4);
        $ar['item'] = $item;

        return View::make('admin.directory.adv-prop.cat', $ar);
    }

    function postCat ($id) {
        $item = SysAdvertProp::findOrFail($id);

        $cat = new SysAdvertPropCat();
        $cat->prop_id = $item->id;
        $cat->cat1_id = Input::get('cat1_id');
        $cat->cat2_id = Input::get('cat2_id');
        $cat->cat3_id = Input::get('cat3_id');
        $cat->cat4_id = Input::get('cat4_id');
        $cat->save();

        return Redirect::action("AdminAdvPropController@getCat", $item->id)->with('success', 'Data saved successfully');
    }

    function getDeleteCat ($id, $cat_id) {
        $item = SysAdvertProp::findOrFail($id);

        $cat = SysAdvertPropCat::findOrFail($cat_id);
        $cat->delete();

        return Redirect::action("AdminAdvPropController@getCat", $item->id)->with('success', 'Data deleted successfully');
    }

    function getOption ($id) {
        $item = SysAdvertProp::findOrFail($id);

        $ar = array();
        $ar['title'] = 'Advert property options';
        $ar['item'] = $item;
        $ar['items'] = SysAdvertPropOption::where('prop_id', $item->id)->get();
        $ar['ar_icons'] = SysAdvertProp::getArIconWithSpan();


        return View::make('admin.directory.adv-prop.option', $ar);
    }

    function postOption ($id) {
        $item = SysAdvertProp::findOrFail($id);

        $option = new SysAdvertPropOption();
        $option->prop_id = $item->id;
        $option->name = Input::get('name');
        $option->icon = Input::get('icon');
        $option->save();

        return Redirect::action("AdminAdvPropController@getOption", $item->id)->with('success', 'Data saved successfully');
    }

    function getDeleteOption ($id, $prop_id) {
        $item = SysAdvertProp::findOrFail($id);

        $option = SysAdvertPropOption::findOrFail($prop_id);
        $option->delete();

        return Redirect::action("AdminAdvPropController@getOption", $item->id)->with('success', 'Data deleted successfully');
    }

    function getDelete ($id) {
        $item = SysAdvertProp::findOrFail($id);
        $item->delete();

        return Redirect::action("AdminAdvPropController@getIndex")->with('success', 'Data deleted successfully');
    }

}
