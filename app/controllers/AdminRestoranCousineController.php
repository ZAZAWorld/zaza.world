<?php
class AdminRestoranCousineController extends BaseController {

	function getIndex () {
		$ar = array();
		$ar['title'] = 'Restaurant Cousine';
        $ar['items'] = SysAdRestoranCousine::orderBy('id', 'desc')->get();
		
		return View::make('admin.directory.restoran-cousine.index', $ar);
	}
	
	function getItem ($id = 0) {
		$item = SysAdRestoranCousine::find($id);
		
		$ar = array();
		if ($item) {
			$ar['title'] = 'Edit ';
			$ar['item'] = $item;
			$ar['action'] = action('AdminRestoranCousineController@postItem', $item->id);
		}
		else {
			$ar['title'] = 'Add new ';
			$ar['action'] = action('AdminRestoranCousineController@postItem');
		}
		
		return View::make('admin.directory.restoran-cousine.item', $ar);
	}
	
	function postItem ($id = 0) {
		$item = SysAdRestoranCousine::find($id);
		if (!$item)
			$item = new SysAdRestoranCousine();
		$item->name = Input::get('name');
		if (Input::hasFile('image'))
			$item->icon = ModelSnipet::setImage(Input::file('image'));
		$item->save();

        return Redirect::action("AdminRestoranCousineController@getIndex")->with('success', 'Data saved successfully');
	}
	
	function getDelete($id) {
		$item = SysAdRestoranCousine::findOrFail($id);
		$item->delete();
		
		return Redirect::action("AdminRestoranCousineController@getIndex")->with('success', 'Data deleted successfully');
	}
}