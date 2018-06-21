<?php
class AdminBlogInterestController extends BaseController {

	function getIndex () {
		$ar = array();
		$ar['title'] = 'Blog Interest';
        $ar['items'] = SysBlogInterest::orderBy('id', 'desc')->get();
		
		return View::make('admin.directory.blog-interests.index', $ar);
	}
	
	function getItem ($id = 0) {
		$item = SysBlogInterest::find($id);
		
		$ar = array();
		if ($item) {
			$ar['title'] = 'Edit ';
			$ar['item'] = $item;
			$ar['action'] = action('AdminBlogInterestController@postItem', $item->id);
		}
		else {
			$ar['title'] = 'Add new ';
			$ar['action'] = action('AdminBlogInterestController@postItem');
		}
		
		return View::make('admin.directory.blog-interests.item', $ar);
	}
	
	function postItem ($id = 0) {
		$item = SysBlogInterest::find($id);
		if (!$item)
			$item = new SysBlogInterest();
		$item->name = Input::get('name');
		if (Input::hasFile('image'))
			$item->icon = ModelSnipet::setImage(Input::file('image'));
		$item->save();

        return Redirect::action("AdminBlogInterestController@getIndex")->with('success', 'Data saved successfully');
	}
	
	function getDelete($id) {
		$item = SysBlogInterest::findOrFail($id);
		$item->delete();
		
		return Redirect::action("AdminBlogInterestController@getIndex")->with('success', 'Data deleted successfully');
	}
}