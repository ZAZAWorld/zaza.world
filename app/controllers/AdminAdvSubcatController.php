<?php
class AdminAdvSubcatController extends BaseController {
    function getIndex () {
        $ar = array();
        $ar['title'] = 'Advert sub-categories';
        $ar['ar_cat3'] = SysAdvertCat::getFullArrNames(3);
		
		if (Input::has('name')) 
			$ar['cat_4'] = SysAdvertCat::where('level', 4)->where('name', 'like', '%'.Input::get('name').'%')->orderBy('id', 'DESC')->paginate(20);
		else 
			$ar['cat_4'] = SysAdvertCat::where('level', 4)->paginate(20);
		
		if(Input::has('sort_name') && Input::has('sort_val')){
			if(Input::get('sort_name') == 'idt' && Input::get('sort_val') == 'down'){
				$ar['cat_4'] = SysAdvertCat::where('level', 4)->orderBy('id', 'DESC')->paginate(20);
			}
			else if(Input::get('sort_name') == 'idt' && Input::get('sort_val') == 'up'){
				$ar['cat_4'] = SysAdvertCat::where('level', 4)->orderBy('id', 'ASC')->paginate(20);
			}
			else if(Input::get('sort_name') == 'namet' && Input::get('sort_val') == 'down'){
				$ar['cat_4'] = SysAdvertCat::where('level', 4)->orderBy('name', 'DESC')->paginate(20);
			}
			else if(Input::get('sort_name') == 'namet' && Input::get('sort_val') == 'up'){
				$ar['cat_4'] = SysAdvertCat::where('level', 4)->orderBy('name', 'ASC')->paginate(20);
			}
			else if(Input::get('sort_name') == 'bart' && Input::get('sort_val') == 'down'){
				$ar['cat_4'] = SysAdvertCat::where('level', 4)->orderBy('parent_id', 'DESC')->paginate(20);
			}
			else if(Input::get('sort_name') == 'bart' && Input::get('sort_val') == 'up'){
				$ar['cat_4'] = SysAdvertCat::where('level', 4)->orderBy('parent_id', 'ASC')->paginate(20);
			}
		}


        return View::make('admin.directory.adv-subcat.index', $ar);
    }

    function getItem ($level = 2,$id = 0) {
        if (!in_array($level, array(2,3,4)))
            App::abort(404);

        $item = SysAdvertCat::find($id);
        $ar = array();
        if (!$item) {
            $ar['title'] = 'Add new category';
            $ar['action'] = action('AdminAdvSubcatController@postItem', array($level));
        } else {
            $ar['title'] = 'Edit category';
            $ar['action'] = action('AdminAdvSubcatController@postItem', array($level, $item->id));
            $ar['item'] = $item;
        }

        $parent_level = $level - 1;
        $ar['ar_parents'] = SysAdvertCat::getFullArrNames($parent_level);

        return View::make('admin.directory.adv-subcat.item', $ar);
    }

    function postItem ($level = 2, $id = 0) {
        if (!in_array($level, array(2,3,4)))
            App::abort(404);

        $item = SysAdvertCat::find($id);
        if (!$item) {
            $item = new SysAdvertCat();
            $item->level = $level;
        }

        $item->name = Input::get('name');
        $item->parent_id = Input::get('parent_id');

        if (!$item->save())
            return Redirect::back()->withErrors($item->getErrors());

        return Redirect::action('AdminAdvSubcatController@getIndex')->with('success', 'Data saved successfully');
    }

    function getDelete ($id) {
        $el = SysAdvertCat::findOrFail($id);
        $el->allDelete();

        return Redirect::action('AdminAdvSubcatController@getIndex')->with('success', 'Data saved deleted');
    }


}
