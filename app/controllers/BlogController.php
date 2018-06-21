<?php
class BlogController extends BaseController {
	function postAdd(){
		if (!Auth::check())
			return Redirect::back()->with('error', 'Please, sign in to post your article');
		if (!Input::has('note') || Input::has('note')=='' || trim(Input::has('note')) == '')
			return Redirect::back()->with('error', '');

		$user = Auth::user();

		$blog = new Blog();
		$blog->user_type_id = $user->user_type_id;
		$blog->user_id = $user->id;
		$blog->type_id = Input::get('type_id');
		$blog->note = Input::get('note');
		$blog->status_id = 1;

		if (Input::hasFile('image'))
           $blog->photo = ModelSnipet::setImage(Input::file('image'), 'company');

		if (Input::has('title'))
			$blog->title = Input::get('title');

		if (Input::has('element_id'))
			$blog->element_id = Input::get('element_id');

		if (Input::has('tags'))
			$blog->tags = Input::get('tags');

		if (Input::has('meta_title'))
			$blog->meta_title = Input::get('meta_title');

		if (Input::has('meta_note'))
			$blog->meta_note = Input::get('meta_note');

		if (Input::has('meta_tag'))
			$blog->meta_tag = Input::get('meta_tag');

		$blog->save();

		return Redirect::back();
	}

	function postAddShare() {
		if (!Auth::check())
			return '0';
			
		$user = Auth::user();

		$share = UserBlogShare::where(array('user_id'=>$user->id, 'blog_id'=>Input::get('blog_id')))->first();
		if (!$share){
			$share = new UserBlogShare();
			$share->user_id = $user->id;
			$share->blog_id = Input::get('blog_id');
			$share->save();
		}
		else 
			$share->delete();

		return '1';
	}
	
	function postUpdateDialog(){
		if (!Auth::check())
			return Redirect::back()->with('error', 'Please, sign in to edit your article');
		
		$blog_id = Input::get('blog_id');
		$user = Auth::user();
		$blog = Blog::where(array('user_id'=>$user->id, 'id'=>$blog_id))->first();
		
		if (!$blog)
			return '0';
			
		$ar = array();
		$ar['blog'] = $blog;
		
		return View::make('front.blog.edit_dialog', $ar);
	}
	
	function postUpdate(){
		if (!Auth::check())
			return Redirect::back()->with('error', 'Please, sign in to edit your article');
		
		$blog_id = Input::get('blog_id');
			
		$user = Auth::user();
		$blog = Blog::where(array('user_id'=>$user->id, 'id'=>$blog_id))->first();
		
		if (!$blog)
			App::abort(404);
		
		$blog->note = Input::get('note');
		$blog->photo = Input::get('photo');
		$blog->save();
		
		return Redirect::back();
	}
	
	function getDelete($blog_id){
		if (!Auth::check())
			return Redirect::back()->with('error', 'Please, sign in to edit your article');
			
		$user = Auth::user();
		$blog = Blog::where(array('user_id'=>$user->id, 'id'=>$blog_id))->first();
		if (!$blog)
			App::abort(404);
		
		$blog->delete();
		
		return Redirect::back();
	}
}

