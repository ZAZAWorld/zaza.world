<?php
class ManagerBlogController extends BaseController {
	function getIndex ($status_id = 1) {
		$user = Auth::user();
		$moderator = Moderator::where('user_id', $user->id)->first();
		if (!$moderator)
			App::abort(404);
		if (!$moderator->moderate_blog)
			App::abort(404);
			
		$ar = array();
		$ar['title'] = 'Moderate blog';
		$ar['ar_status'] = Advert::getStatusAr();
		$ar['items'] = Blog::withTrashed()->where('status_id', $status_id)->with('relUser')->orderBy('id', 'desc')->paginate(25);
		$ar['status_id'] = $status_id;
		
		
		return View::make('manager.blog.index', $ar);
	}
	
	function getView ($blog_id) {
		$user = Auth::user();
		$moderator = Moderator::where('user_id', $user->id)->first();
		if (!$moderator)
			App::abort(404);
		if (!$moderator->moderate_blog)
			App::abort(404);
		
		$blog = Blog::withTrashed()->where(array('id'=>$blog_id))->first();
		if (!$blog)
			App::abort(404);
		
		$ar = array();
		$ar['title'] = 'Blog item';
		$ar['item'] = $blog;
		
		return View::make('manager.blog.view', $ar);
	}
	
	function getChangeStatus ($blog_id, $status_id) {
		$user = Auth::user();
		$moderator = Moderator::where('user_id', $user->id)->first();
		if (!$moderator)
			App::abort(404);
		if (!$moderator->moderate_blog)
			App::abort(404);
			
		$blog = Blog::withTrashed()->where(array('id'=>$blog_id))->first();
		if (!$blog)
			App::abort(404);
		$blog->status_id = $status_id;
		$blog->moderator_id = $moderator->id;
		$blog->modarete_time = time();
		$blog->save();
		if ($status_id == 3){
			$blog->delete();
		}
			
		
		/* return Redirect::back()->with('success', 'Data saved successfully'); */
	}
}