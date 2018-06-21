<?php
class AdminModeratorsStatisticController extends BaseController {
	function getAdverts () {
		$ar = array();
        $ar['title'] = 'Statistic of moderators (advert)';
		$ar['moderators'] = Moderator::orderBy('l_name', 'asc')->get();
		
		return View::make('admin.statistic.moderator.advert', $ar);
	}
	
	function getCompanies () {
		$ar = array();
        $ar['title'] = 'Statistic of moderators (company)';
		$ar['moderators'] = Moderator::orderBy('l_name', 'asc')->get();
		
		return View::make('admin.statistic.moderator.company', $ar);
	}
	
	function getBlogs () {
		$ar = array();
        $ar['title'] = 'Statistic of moderators (blogs)';
		$ar['moderators'] = Moderator::where('moderate_blog', 1)->orderBy('l_name', 'asc')->get();
		
		return View::make('admin.statistic.moderator.blog', $ar);
	}
	
	function getComments () {
		$ar = array();
        $ar['title'] = 'Statistic of moderators (comments)';
		$ar['moderators'] = Moderator::where('maderate_comment', 1)->orderBy('l_name', 'asc')->get();
		
		return View::make('admin.statistic.moderator.comment', $ar);
	}
}