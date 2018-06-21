<?php
class CommentController extends BaseController {	
	function anyAdd () {
		if (!Auth::check()) 
			return Redirect::back()->with('error', 'Please, sign in to leave your comment');
		if (!Input::has('note') || Input::has('note')=='' || trim(Input::has('note')) == '')
			return Redirect::back()->with('error', '');
			
		$user = Auth::user();
		
		$comment = new SysAdComment();
		$comment->user_id = $user->id;
		$comment->title = Input::get('title');
		$comment->email = $user->email;
		$comment->name = $user->full_name;
		$comment->note = Input::get('note');
		$comment->element_type_id = Input::get('element_type_id');
		$comment->element_id = Input::get('element_id');
		if (Input::has('parent_id'))
			$comment->parent_id = Input::get('parent_id');
		else 
			$comment->parent_id = 0;
		$comment->save();
		
		if ($comment->element_type_id == 5){
			$url = strtok( URL::previous(), '?');
			return Redirect::to($url.'?show_id='.$comment->element_id);
		}
		
		return Redirect::back();
	}
	
	function getDelete($id){
		$user = Auth::user();
		if (!$user)
			return App::abort(404);
		$comment = SysAdComment::where(array('id'=>$id, 'user_id'=>$user->id))->firstOrFail();
		
		SysAdComment::where('parent_id', $comment->id)->delete();
		$comment->delete();
		
		return Redirect::back();
	}
	
	
}
