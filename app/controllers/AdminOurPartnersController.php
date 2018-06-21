<?php
class AdminOurPartnersController extends BaseController {

	function getIndex () {
		$ar = array();
		$ar['title'] = 'Our Partners';
        $ar['items'] = SysAdOurPartners::orderBy('id', 'desc')->get();
		
		return View::make('admin.directory.our-partners.index', $ar);
	}
	
	function getItem ($id = 0) {
		$item = SysAdOurPartners::find($id);
		
		$ar = array();
		if ($item) {
			$ar['title'] = 'Edit partners';
			$ar['item'] = $item;
			$ar['action'] = action('AdminOurPartnersController@postItem', $item->id);
		}
		else {
			$ar['title'] = 'Add new partners';
			$ar['action'] = action('AdminOurPartnersController@postItem');
		}
		$ar['ar_active'] = array(0=>"No", 1=>'Yes');
		
		return View::make('admin.directory.our-partners.item', $ar);
	}
	
	function postItem ($id = 0) {
		$item = SysAdOurPartners::find($id);
		if (!$item)
			$item = new SysAdOurPartners();
			$item->name = Input::get('name');
			$item->active = Input::get('active');
		if (Input::hasFile('image'))
			$item->icon = ModelSnipet::setImage(Input::file('image'));
		$item->save();

        return Redirect::action("AdminOurPartnersController@getIndex")->with('success', 'Data saved successfully');
	}
	
	function getDelete($id) {
		$item = SysAdOurPartners::findOrFail($id);
	//	SysAdAutoModel::where('brand_id', $item->id)->delete();
		$item->delete();
		
		return Redirect::action("AdminOurPartnersController@getIndex")->with('success', 'Data deleted successfully');
	}
}