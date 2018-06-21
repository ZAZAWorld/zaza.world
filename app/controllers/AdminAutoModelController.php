<?php
class AdminAutoModelController extends BaseController {

	function getIndex () {
		$ar = array();
		$ar['title'] = 'Auto brands';
		if (Input::has('model')) 
			$ar['items'] = SysAdAutoModel::where('name', 'like', '%'.Input::get('model').'%')->orderBy('id', 'DESC')->paginate(25);
		else 
        $ar['items'] = SysAdAutoModel::orderBy('id', 'desc')->paginate(25);
		$ar['ar_brands'] = SysAdAutoBrand::lists('name', 'id');
		
		
		if(Input::has('sort_name') && Input::has('sort_val')){
			if(Input::get('sort_name') == 'id' && Input::get('sort_val') == 'down'){
				$ar['items'] = SysAdAutoModel::orderBy('id', 'asc')->paginate(25);
			}
			else if (Input::get('sort_name') == 'id' && Input::get('sort_val') == 'up'){
				$ar['items'] = SysAdAutoModel::orderBy('id', 'desc')->paginate(25);
			}
			else if (Input::get('sort_name') == 'name' && Input::get('sort_val') == 'down'){
				$ar['items'] = SysAdAutoModel::orderBy('name', 'asc')->paginate(25);
			}
			else if (Input::get('sort_name') == 'name' && Input::get('sort_val') == 'up'){
				$ar['items'] = SysAdAutoModel::orderBy('name', 'desc')->paginate(25);
			}
			else if (Input::get('sort_name') == 'brands' && Input::get('sort_val') == 'down'){
				$ar['items'] = SysAdAutoModel::orderBy('brand_id', 'asc')->paginate(25);
			}
			else if (Input::get('sort_name') == 'brands' && Input::get('sort_val') == 'up'){
				$ar['items'] = SysAdAutoModel::orderBy('brand_id', 'desc')->paginate(25);
			}
				
		}
		
		return View::make('admin.directory.auto-model.index', $ar);
	}
	
	function getItem ($id = 0) {
		$item = SysAdAutoModel::find($id);
		
		$ar = array();
		if ($item) {
			$ar['title'] = 'Edit model';
			$ar['item'] = $item;
			$ar['action'] = action('AdminAutoModelController@postItem', $item->id);
		}
		else {
			$ar['title'] = 'Add new model';
			$ar['action'] = action('AdminAutoModelController@postItem');
		}
		$ar['ar_brands'] = SysAdAutoBrand::lists('name', 'id');
		
		return View::make('admin.directory.auto-model.item', $ar);
	}
	
	function postItem ($id = 0) {
		$item = SysAdAutoModel::find($id);
		if (!$item)
			$item = new SysAdAutoModel();
		$item->name = Input::get('name');
		$item->brand_id = Input::get('brand_id');
		$item->save();

        return Redirect::action("AdminAutoModelController@getIndex")->with('success', 'Data saved successfully');
	}
	
	function getDelete($id) {
		$item = SysAdAutoModel::findOrFail($id);
		$item->delete();
		
		return Redirect::action("AdminAutoModelController@getIndex")->with('success', 'Data deleted successfully');
	}
}