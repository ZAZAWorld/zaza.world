<?php
class AdminReportBlogController extends BaseController {
    function getIndex () {
		$begin = null;
		if (Input::has('begin'))
			$begin = strtotime(Input::get('begin'));
			
		$end = null;
		if (Input::has('end'))
			$end = strtotime(Input::get('end'));
			
		$items = Blog::orderBy('id', 'desc');
			
		if ($begin)
			$items = $items->where('created_unix', '>', $begin);
		if ($end)
			$items = $items->where('created_unix', '<', $end);
		
		$ar = array();
        $ar['title'] = 'Report of blog';
		$ar['items'] = $items->with('relUser')->paginate(25);

		$ar['ar_modarators'] = Moderator::getArName();
		$ar['ar_status'] = Advert::getStatusAr();
		$ar['begin'] = ($begin ? date('Y-m-d', $begin) :null);
		$ar['end'] = ($end ? date('Y-m-d', $end) :null);
		
		return View::make('admin.report.blog.index', $ar);
	}	
	
}