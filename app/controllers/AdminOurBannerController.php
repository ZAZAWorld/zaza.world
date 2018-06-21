<?php
class AdminOurBannerController extends BaseController {

	function getIndex () {
		$ar = array();
		$ar['title'] = 'Banner';
        $ar['items'] = SysAdBannerPartners::orderBy('id', 'desc')->get();
		
		return View::make('admin.directory.adv-banner.index', $ar);
	}
	
	function getItem ($id = 0) {
		$item = SysAdBannerPartners::find($id);
		
		$ar = array();
		if ($item) {
			$ar['title'] = 'Edit banner';
			$ar['item'] = $item;
			$ar['action'] = action('AdminOurBannerController@postItem', $item->id);
		}
		else {
			$ar['title'] = 'Add new banner';
			$ar['action'] = action('AdminOurBannerController@postItem');
		}
		$ar['ar_active'] = array(0=>"No", 1=>'Yes');
		
		return View::make('admin.directory.adv-banner.item', $ar);
	}
	
	function postItem ($id = 0) {
		$item = SysAdBannerPartners::find($id);
		if (!$item)
			$item = new SysAdBannerPartners();
			
		$item->name = Input::get('name');
		$item->location = Input::get('location');
		$item->contact = Input::get('contact');
		$item->email = Input::get('email');
		$item->person = Input::get('person');
		if (Input::hasFile('license'))
			$item->license = ModelSnipet::setImage(Input::file('license'), 'images', 'large');
		if (Input::hasFile('banner'))
			$item->banner = ModelSnipet::setImage(Input::file('banner'), 'images', 'large');
		$item->days = Input::get('days');
		$item->publish_date = Input::get('publish_date');
		$item->save();

        return Redirect::action("AdminOurBannerController@getIndex")->with('success', 'Data saved successfully');
	}
	
	function getDelete($id) {
		$item = SysAdBannerPartners::findOrFail($id);
	//	SysAdAutoModel::where('brand_id', $item->id)->delete();
		$item->delete();
		
		return Redirect::action("AdminOurBannerController@getIndex")->with('success', 'Data deleted successfully');
	}
}