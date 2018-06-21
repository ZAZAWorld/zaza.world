<?php
class InquiryController extends BaseController {
	function postAdd(){
		if (!Input::has('note') || Input::has('note')=='' || trim(Input::has('note')) == '')
			return Redirect::back()->with('error', "We don't have any inquiry yet");
			
		$user = Auth::user();
		
		$el = new Inquiry();
		$el->user_id = $user->id;
		if (Input::has('type_id') && Input::get('type_id') == 9999)
			$el->is_personal_account = 1;
		else {
			$el->is_personal_account = 0;
			$el->type_id = Input::get('type_id');
			$el->cat_id = Input::get('cat_id');
		}
		$el->note = Input::get('note');
		$el->save();
	
		return Redirect::back();
	}
	
}