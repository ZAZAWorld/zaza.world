<?php

class PageController extends BaseController {
	function getIndex () {
		$ar = array();
		$ar['title'] = 'Homepage';
		$ar['cat_company'] = SysCompanyType::where('id','>=',2)->get();
		$ar['bottom'] = true;

		return View::make('front.index.homepage', $ar);
	}

	function getCatalog () {
		$ar = array();
		$ar['title'] = 'Catalog';

		return View::make('front.catalog.index', $ar);
	}

	function getPersonal () {
		$ar = array();
		$ar['title'] = 'asd';

		return View::make('front.personal-page.index', $ar);
	}

	function getRestoran () {
		$ar = array();
		$ar['title'] = 'asd';

		return View::make('front.restoran.index', $ar);
	}

	function getRestoranCatalog () {
		$ar = array();
		$ar['title'] = 'asd';

		return View::make('front.catalog-restoran.index', $ar);
	}

	function getCompany () {
		$ar = array();
		$ar['title'] = 'asd';

		return View::make('front.company.index', $ar);
	}

	function getCompanyVip () {
		$ar = array();
		$ar['title'] = 'asd';

		return View::make('front.company-vip.index', $ar);
	}
	
	function postTrans ($name = null) {
		return  TransWord::getArabic($name);
	}



}
