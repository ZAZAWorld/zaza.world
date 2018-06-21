<?php
class ManagerBannerController extends BaseController {
	function getIndex ($status_id = 0) {
		$user = Auth::user();
		$moderator = Moderator::where('user_id', $user->id)->first();
		if (!$moderator)
			App::abort(404);
		if (!$moderator->moderate_banner)
			App::abort(404);
			
		$ar = array();
		$ar['title'] = 'Moderate banners';
		$ar['ar_status'] = SysAdBannerPartners::getStatusAr();
		if ($status_id == 0)
			$ar['items'] = SysAdBannerPartners::where('status_id', $status_id)->orderBy('id', 'desc')->paginate(25);
		else
			$ar['items'] = SysAdBannerPartners::where('status_id', $status_id)->where('moderator_id', $moderator->id)->orderBy('id', 'desc')->paginate(25);
		$ar['status_id'] = $status_id;
		
		
		return View::make('manager.banner.index', $ar);
	}
	
	function getChangeStatus ($banner_id, $status_id) {
		$user = Auth::user();
		$moderator = Moderator::where('user_id', $user->id)->first();
		if (!$moderator)
			App::abort(404);
		if (!$moderator->moderate_banner)
			App::abort(404);
			
		$elem = SysAdBannerPartners::where(array('id'=>$banner_id))->first();
		if (!$elem)
			App::abort(404);
			
		if ($status_id == 2)
			return Redirect::action('ManagerBannerController@getAccept', $elem->id);
			
		$elem->status_id = $status_id;
		$elem->moderator_id = $moderator->id;
		$elem->save();
		
		return Redirect::back()->with('success', 'Data saved successfully');
	}
	
	function getAccept($banner_id){
		$user = Auth::user();
		$moderator = Moderator::where('user_id', $user->id)->first();
		if (!$moderator)
			App::abort(404);
		if (!$moderator->moderate_banner)
			App::abort(404);
			
		$elem = SysAdBannerPartners::where(array('id'=>$banner_id))->first();
		if (!$elem)
			App::abort(404);
			
		$ar = array();
		$ar['title'] = 'Accept banners';
		$ar['action'] = action('ManagerBannerController@postAccept', $elem->id);
		$ar['item'] = $elem;
		
		return View::make('manager.banner.accept', $ar);
	}
	
	function postAccept ($banner_id){
		$user = Auth::user();
		$moderator = Moderator::where('user_id', $user->id)->first();
		if (!$moderator)
			App::abort(404);
		if (!$moderator->moderate_banner)
			App::abort(404);
			
		$elem = SysAdBannerPartners::where(array('id'=>$banner_id))->first();
		if (!$elem)
			App::abort(404);
		$elem->paid_date = Input::get('paid_date');
		$elem->paid_doc_number = Input::get('paid_doc_number');
		$elem->paid_sum = Input::get('paid_sum');
		$elem->status_id = 2;
		$elem->moderator_id = $moderator->id;
		
		$elem->save();
		
		return Redirect::action('ManagerBannerController@getIndex', 1)->with('success', 'Data saved successfully');
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
		
		return View::make('manager.banner.item', $ar);
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
}