<?php
class AdminAutoBrandController extends BaseController {

	function getIndex () {
		$ar = array();
		$ar['title'] = 'Auto brands';
		if (Input::has('brand')) 
			$ar['items'] = SysAdAutoBrand::where('name', 'like', '%'.Input::get('brand').'%')->orderBy('id', 'DESC')->paginate(25);
		else 
        $ar['items'] = SysAdAutoBrand::orderBy('id', 'desc')->paginate(25);
		
		if (Input::has('sort_name') && Input::has('sort_val')){
			if (Input::get('sort_name') == 'id' && Input::get('sort_val') == 'down'){
				$ar['items'] = SysAdAutoBrand::orderBy('id', 'ASC')->paginate(25);
			}
			else if(Input::get('sort_name') == 'id' && Input::get('sort_val') == 'up'){
				$ar['items'] = SysAdAutoBrand::orderBy('id', 'DESC')->paginate(25);
			}
			else if(Input::get('sort_name') == 'name' && Input::get('sort_val') == 'down'){
				$ar['items'] = SysAdAutoBrand::orderBy('name', 'ASC')->paginate(25);
			}
			else if(Input::get('sort_name') == 'name' && Input::get('sort_val') == 'up'){
				$ar['items'] = SysAdAutoBrand::orderBy('name', 'DESC')->paginate(25);
			}
		}
		
		return View::make('admin.directory.auto-brand.index', $ar);
	}
	
	function getItem ($id = 0) {
		$item = SysAdAutoBrand::find($id);
		
		$ar = array();
		if ($item) {
			$ar['title'] = 'Edit brand';
			$ar['item'] = $item;
			$ar['action'] = action('AdminAutoBrandController@postItem', $item->id);
		}
		else {
			$ar['title'] = 'Add new brand';
			$ar['action'] = action('AdminAutoBrandController@postItem');
		}
		
		return View::make('admin.directory.auto-brand.item', $ar);
	}
	
	function postItem ($id = 0) {
		$item = SysAdAutoBrand::find($id);
		if (!$item)
			$item = new SysAdAutoBrand();
		$item->name = Input::get('name');
		if (Input::hasFile('image'))
			$item->icon = ModelSnipet::setImage(Input::file('image'));
		$item->save();

        return Redirect::action("AdminAutoBrandController@getIndex")->with('success', 'Data saved successfully');
	}
	
	function getDelete($id) {
		$item = SysAdAutoBrand::findOrFail($id);
		SysAdAutoModel::where('brand_id', $item->id)->delete();
		$item->delete();
		
		return Redirect::action("AdminAutoBrandController@getIndex")->with('success', 'Data deleted successfully');
	}
}