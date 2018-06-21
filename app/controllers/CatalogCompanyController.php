<?php
class CatalogCompanyController extends BaseController {
    public $category = null;
    public $company = null;

    function getIndex ($catalog_id) {
        $category = SysCompanyCat::findOrFail($catalog_id);
        $this->category = $category;

        if($category->type_id == 1)
           return $this->generateRestorants();

        return $this->generateOther();
    }

    function generateRestorants () {
		$ar_compny_id = CompanyCat::where('cat_id', $this->category->id)->lists('company_id');
		$copms = Company::where('is_vip', 0);
		$copms_vip = Company::where('is_top', 1);
		
		if (Auth::check()){
			$userasd = Auth::user();
			 $copms =  $copms->whereHas('relUser', function($q) use($userasd){
				 $q->where('city_id', $userasd->city_id);
			 });
			 
			 $copms_vip =  $copms_vip->whereHas('relUser', function($q) use($userasd){
				 $q->where('city_id', $userasd->city_id);
			 });
		}
		else if (Session::has('def_city_id')){
			$city_id = Session::get('def_city_id');
			$copms =  $copms->whereHas('relUser', function($q) use($city_id){
				 $q->where('city_id', $city_id);
			});
			$copms_vip =  $copms_vip->whereHas('relUser', function($q) use($city_id){
				 $q->where('city_id', $city_id);
			});
		}
		
		$ar_filter = array();
		
		if (Input::has('filter') && Input::get('filter')){
			if (Input::has('cousine_id') && Input::get('cousine_id') && Input::get('cousine_id')!='Cousine') {
				$cousine = Input::get('cousine_id');
				
				$elsasad  = CompanyRestoran::where('id', '>', 0);
				$i = 0;
				foreach($cousine as $c){
					$i ++;
					if ($i == 1)
						$elsasad = $elsasad->where('cousine', 'LIKE', '%'.$c.'%');
					else 
						$elsasad = $elsasad->orWhere('cousine', 'LIKE', '%'.$c.'%');
					
				}
				$ar_id = $elsasad->lists('company_id');
				$ar_compny_id = array_intersect($ar_id, $ar_compny_id);
			}
			
			if (Input::has('location') && Input::get('location')) {
				$location = Input::get('location');
				$copms = $copms->where('location', 'LIKE', '%'.$location.'%');
			}
			
			if (Input::has('keywords') && Input::get('keywords')) {
				$copms = $copms->where('title', 'LIKE', '%'.Input::get('keywords').'%');
			}
			
			if (Input::has('min_price') && Input::get('min_price')) {
				$min_price = Input::get('min_price');
				$ar_id = CompanyRestoran::where('cost_for_2', '>=',$min_price)->lists('company_id');
				$ar_compny_id = array_intersect($ar_id, $ar_compny_id);
			}
			
			if (Input::has('max_price') && Input::get('max_price')) {
				$max_price = Input::get('max_price');
				$ar_id = CompanyRestoran::where('cost_for_2', '<=',$max_price)->lists('company_id');
				$ar_compny_id = array_intersect($ar_id, $ar_compny_id);
			}
			
			$ar_options = CompanyRestoran::getOptionsAr();
			$ar_option_where = array();
			foreach ($ar_options as $k=>$v){
				if (!Input::has('option_'.$k))
					continue;
					
				$ar_option_where[] = $k;
			}
			
			if (count($ar_option_where) > 0){
				$restorans = CompanyRestoran::where('id', '>', 0);
				foreach ($ar_option_where as $k) {
					$option = $ar_options[$k];
					$str_option = '"'.$k.'":{"icon":"'.$option['icon'].'","name":"'.$option['name'].'","check":1}';
					$restorans->where('options', 'like', '%'.$str_option.'%');
				}
				
				$ar_id = $restorans->lists('company_id');
				$ar_compny_id = array_intersect($ar_id, $ar_compny_id);
			}
			
		}
		
        $copms = $copms->whereIn('companies.id', $ar_compny_id);
		
		$total_count = 0;
		$total_count = $total_count + $copms->count();
		
		if (Input::has('show_sort') && Input::has('val_sort') && in_array(Input::get('val_sort'), array('most_cheap', 'most_expen', 'most_popul'))){
			$sort = Input::get('val_sort');
			if ($sort == 'most_cheap'){
				$copms = $copms->select(DB::raw('companies.*, company_restoran.cost_for_2 as `cost_for_2`, `companies`.`id` as id'))
										->leftJoin('company_restoran', 'companies.id', '=', 'company_restoran.company_id')
										->orderBy('cost_for_2', 'asc');
			}
			else if ($sort == 'most_expen') {
				$copms = $copms->select(DB::raw('companies.*, company_restoran.cost_for_2 as `cost_for_2`, `companies`.`id` as id'))
										->leftJoin('company_restoran', 'companies.id', '=', 'company_restoran.company_id')
										->orderBy('cost_for_2', 'desc');
			}
			else if ($sort == 'most_popul') {
				$copms = $copms->orderBy('total_views', 'desc');
			}
		}
		else 
			$copms = $copms->orderBy('id', 'desc');
		
		$copms_vip = $copms_vip->whereIn('id', $ar_compny_id);
        
		
		
        $ar = array();
        $ar['title'] = 'Restaurant catalogue';
		$ar['copms_vip'] = $copms_vip->orderBy('onlain_index', 'desc')->get();
		$ar['copms'] = $copms->paginate(48);
        $ar['catalog'] = $this->category;



        $view = View::make('front.catalog-restoran.index', $ar);
		$view = $this->generateRestoranFilters($view, $total_count, $ar_filter);

        return $view;
    }
	
	private function generateRestoranFilters ($view, $total_count, $ar_filter = array()) {
		$cat = $this->category;
		$parent_cat = SysCompanyType::findOrFail($cat->type_id);
		$ar_options = CompanyRestoran::getOptionsAr();
		
		$ar = $ar_filter;
		$ar['cat'] = $cat;
		$ar['parent_cat'] = $parent_cat;
		$ar['total_count'] =  $total_count;
		$ar['val_sort'] = $this->generateSortLink();
		
		$ar['ar_cousine'] = SysAdRestoranCousine::lists('name', 'name');
		$ar['option_romantic'] = $ar_options[9];
		$ar['option_private'] = $ar_options[10];
		unset($ar_options[9]);
		unset($ar_options[10]);
		$ar['option_ar'] = $ar_options;
		
		
		//echo '<pre>'; print_r($ar['option_romantic']); echo '</pre>'; exit();
		
		return $view->nest('filter_block','front.catalog-restoran.filter', $ar);
	}
	
	private function generateSortLink () { // функция генерации ссылки для сортировки
		$ar = Input::all();
		
		$link = '?show_sort=1';
		foreach ($ar as $k=>$v) {
			if ($k == 'val_sort' || $k == 'page' || $k=='cousine_id')
				continue;
				
			$link = $link.'&'.$k.'='.$v;
		}
		$link = $link.'&val_sort=';
		
		return $link;
	}

    function generateOther () {
        $ar_compny_id = CompanyCat::where('cat_id', $this->category->id)->lists('company_id');
        //$copms_vip = Company::where('is_vip', 1);
        $copms = Company::where('id', '>', 0);
		$copms_vip = Company::where('is_top', 1);
		$ar_filter = array();
		
		if (Auth::check()){
			$userasd = Auth::user();
			 $copms =  $copms->whereHas('relUser', function($q) use($userasd){
				 $q->where('city_id', $userasd->city_id);
			 });
			 
			 $copms_vip =  $copms_vip->whereHas('relUser', function($q) use($userasd){
				 $q->where('city_id', $userasd->city_id);
			 });
		}
		else if (Session::has('def_city_id')){
			$city_id = Session::get('def_city_id');
			$copms =  $copms->whereHas('relUser', function($q) use($city_id){
				 $q->where('city_id', $city_id);
			});
			$copms_vip =  $copms_vip->whereHas('relUser', function($q) use($city_id){
				 $q->where('city_id', $city_id);
			});
		}
		
		if (Input::has('filter') && Input::get('filter')){
			if (Input::has('sub_cat_id') && Input::get('sub_cat_id')) {
				$sub_cat = SysCompanySubcat::findOrFail(Input::get('sub_cat_id'));
				$ar_filter['sub_cat'] = $sub_cat;
				$ar_id = CompanyCat::where('cat_id', $this->category->id)->where('subcat_id', $sub_cat->id)->lists('company_id');
				$ar_compny_id = array_intersect($ar_id, $ar_compny_id);
			}
			
			if (Input::has('location') && Input::get('location')) {
				$location = Input::get('location');
				$copms_vip = $copms_vip->where('location', 'LIKE', '%'.$location.'%');
				$copms = $copms->where('location', 'LIKE', '%'.$location.'%');
			}
			
			if (Input::has('keywords') && Input::get('keywords')) {
				
				$copms_vip = $copms_vip->where(function($q){
					$q->where('title', 'LIKE', '%'.Input::get('keywords').'%')->orWhere('activity', 'LIKE', '%'.Input::get('keywords').'%');
				});
				$copms = $copms->where(function($q){
					$q->where('title', 'LIKE', '%'.Input::get('keywords').'%')->orWhere('activity', 'LIKE', '%'.Input::get('keywords').'%');
				});
			}
			
			if ((Input::has('whosale') && Input::get('whosale')) || (Input::has('retail') && Input::get('retail'))) {
				if(Input::has('whosale') && !Input::has('retail')) {
                    $copms_vip = $copms_vip->where('whosale', 1);
                    $copms = $copms->where('whosale', 1);
                }
                elseif(!Input::has('whosale') && Input::has('retail')){
                    $copms_vip = $copms_vip->where('retail', 1);
                    $copms = $copms->where('retail', 1);
                }
                else{
                    $copms_vip = $copms_vip->whereRaw('retail = ? or whosale = ?', [1,1]);
                    $copms = $copms->whereRaw('retail = ? or whosale = ?', [1,1]);
                }
			}
			
			if (Input::has('special_offer') && Input::get('special_offer')) {
				$copms_vip = $copms_vip->where('is_top', 1);
				$copms = $copms->where('is_top', 1);
			}
			
			
		}
		
		$copms_vip = $copms_vip->whereIn('id', $ar_compny_id);
        $copms = $copms->whereIn('id', $ar_compny_id);
		
		$total_count = 0;
		$total_count = $total_count + $copms_vip->count();
		$total_count = $total_count + $copms->count();
			
        $ar = array();
        $ar['title'] = 'Company catalog';
        $ar['copms_vip'] = $copms_vip->orderBy('onlain_index', 'desc')->get();
        $ar['copms'] = $copms->orderBy('onlain_index', 'desc')->paginate(48);
		$ar['catalog'] = $this->category;
		
		//echo $copms_vip->count(); exit();
		/*echo $copms->toSql();
		echo '<pre>';print_r(DB::getQueryLog()); echo '</pre>';
		dd(DB::getQueryLog()); exit();
		*/
		$view = View::make('front.catalog-company.index', $ar);
		$view = $this->generateFilters($view, $total_count, $ar_filter);

        return $view;
    }
	
	private function generateFilters ($view, $total_count, $ar_filter = array()) {
		$cat = $this->category;
		$parent_cat = SysCompanyType::findOrFail($cat->type_id);
		
		$ar = $ar_filter;
		$ar['cat'] = $cat;
		$ar['parent_cat'] = $parent_cat;
		$ar['sub_cats'] = SysCompanySubcat::where('parent_id', $cat->id)->orderBy('name', 'asc')->lists('name', 'id');
		$ar['total_count'] =  $total_count;
		
		return $view->nest('filter_block','front.catalog-company.filter', $ar);
	}

    function getCompanyView ($id) {
        $this->company = Company::findOrFail($id);
		
		$company = $this->company;
		if ($company->is_top){
			$company->count_top = $company->count_top - 1;
			$company->save();
		}

        if ($this->company->is_restorant)
            return $this->generateRestoranView();

        if ($this->company->is_vip)
            return $this->generateCompanyVipView();

        return $this->generateCompanySimpleView();
    }

    function generateRestoranView () {
		$user = User::findOrFail($this->company->user_id);
        $company = Company::where('user_id', $user->id)->first();



		$restoran = CompanyRestoran::where('company_id', $company->id)->first();
		if (!$restoran){
			$restoran = new CompanyRestoran();
			$restoran->company_id = $company->id;
			$restoran->save();
		}
		$social = Social::where('user_id', $user->id)->first();
		if (!$social){
			$social = new Social();
			$social->user_id = $user->id;
			$social->save();
		}
		$company->setView();
		
        $ar = array();
        $ar['title'] = ($company->title ? $company->title : 'Company title');
        $ar['user'] = $user;
        $ar['company'] = $company;
		$ar['restoran'] = $restoran;
		$ar['social'] = $social;
		$ar['blog'] = Blog::where('element_id', $user->id)->orderBy('id', 'desc')->paginate(6);
		
		$ar['ar_youtube'] = CompanyFile::where(array('file_type_id'=>3, 'company_id'=>$company->id))->get();
		$ar['ar_cats'] = SysCompanyCat::where('type_id', 1)->lists('name', 'id');
		$ar['ar_cousine'] = CompanyRestoran::getCousineAr();
		$ar['ar_time_am'] = CompanyRestoran::getTimeAMAr();
		$ar['ar_time_pm'] = CompanyRestoran::getTimePMAr();
		$ar['ar_cat'] = CompanyCat::where('company_id', $company->id)->lists('cat_id');
		$ar['ar_cat_names'] = SysCompanyCat::where('type_id', 1)->lists('name', 'id');
		
		$ar['photo_galerea'] = CompanyFile::where(array('file_type_id'=>2 , 'company_id'=>$company->id))->get();
		$ar['photo_menu'] = CompanyFile::where(array('file_type_id'=>6 , 'company_id'=>$company->id))->get();
		$ar['photo_melas'] = CompanyFile::where(array('file_type_id'=>4 , 'company_id'=>$company->id))->get();
		$ar['photo_guests'] = CompanyFile::where(array('file_type_id'=>5 , 'company_id'=>$company->id))->get();
		$ar['photo_team'] = CompanyFile::where(array('file_type_id'=>7 , 'company_id'=>$company->id))->get();
		
		//echo '<pre>'; print_r( CompanyFile::where(array('file_type_id'=>2 , 'company_id'=>$company->id))->get()->toArray()); echo '</pre>'; exit();

        return View::make('front.restoran.view', $ar);
    }

    function generateCompanySimpleView () {
        $user = User::findOrFail($this->company->user_id);
        $company = $this->company;
		$company->setView();

        $ar = array();
        $ar['title'] = ($company->title ? $company->title : 'Company title');
        $ar['user'] = $user;
        $ar['company'] = $company;
        $ar['citys'] = SysCity::getCityAr();
		
		$ar['ads'] = Advert::where('user_id', $user->id)->get();
		$ar['all_ads_ids'] = $ar['ads']->list('id');

        return View::make('front.company.view', $ar);
    }

    function generateCompanyVipView () {
        $user = User::findOrFail($this->company->user_id);
        $company = $this->company;
		$company->setView();
		
        $ar = array();
        $ar['title'] = ($company->title ? $company->title : 'Company title');
        $ar['user'] = $user;
        $ar['company'] = $company;
		$ar['ar_blogs'] = Blog::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(6);
		$ar['ar_type'] = SysCompanyType::where('id', '>=', 2)->lists('name', 'id');
		$ar['youtube_links'] = CompanyFile::where(array('company_id'=>$company->id, 'file_type_id'=>8))->get();
		$ar['photos'] = CompanyFile::where(array('company_id'=>$company->id, 'file_type_id'=>1))->get();
		$ar['social'] = Social::where('user_id', $user->id)->first();
		if (!$ar['social']){
			$social = new Social();
			$social->user_id = $user->id;
			$social->save();
			$ar['social'] = $social;
		}
		$ar['ar_cat'] = SysCompanyCat::lists('name', 'id');
		$ar['ar_subcat'] = SysCompanySubcat::lists('name', 'id');
		$ar['ar_youtube'] = CompanyFile::where(array('file_type_id'=>3, 'company_id'=>$company->id))->get();
		
        return View::make('front.company-vip.index', $ar);
    }
	
	function postAddRestoran () {
		
	}

	function postAddRestoranReview () {
		if (!Auth::check()) 
			return Redirect::back()->with('error', 'Please, sign in to post your article');
		if (!Input::has('note') || Input::has('note')=='' || trim(Input::has('note')) == '')
			return Redirect::back()->with('error', '');
		if (!Input::has('element_id'))
			return Redirect::back()->with('error', '');
			
		$user = Auth::user();
		$user_restoran = User::findOrFail(Input::get('element_id'));
		$company = Company::where('user_id', $user_restoran->id)->firstOrFail();
		$restoran = CompanyRestoran::where('company_id', $company->id)->firstOrFail();
		
		
		$blog = new Blog();
		$blog->user_type_id = $user->user_type_id;
		$blog->user_id = $user->id;
		$blog->type_id = 2;
		$blog->note = Input::get('note');
		$blog->status_id = 1;
		$blog->element_id = $user_restoran->id;
		
		if (Input::hasFile('image'))
           $blog->photo = ModelSnipet::setImage(Input::file('image'), 'company');
			
		if (Input::has('title'))
			$blog->title = Input::get('title');
			
		if (Input::has('tags'))
			$blog->tags = Input::get('tags');
		
		if (Input::has('meta_title'))
			$blog->meta_title = Input::get('meta_title');
		
		if (Input::has('meta_note'))
			$blog->meta_note = Input::get('meta_note');
		
		if (Input::has('meta_tag'))
			$blog->meta_tag = Input::get('meta_tag');
			
		$blog->save();
		
		$restoran->count_score = $restoran->count_score + 1;
		
		$score_food = Input::get('score_food'); 
		$score_service = Input::get('score_service'); 
		$score_interior = Input::get('score_interior'); 
		$total_score = array_sum(array($score_food, $score_service, $score_interior))/3;
		
		$score_ar = $restoran->score_ar;
		$score_ar['score_food'][] = $score_food;
		$score_ar['score_service'][] = $score_service;
		$score_ar['score_interior'][] = $score_interior;
		$score_ar['total_score'][] = $total_score;
		$restoran->score_ar = $score_ar;
		
		$restoran->score_food = array_sum($score_ar['score_food'])/count($score_ar['score_food']);
		$restoran->score_service = array_sum($score_ar['score_service'])/count($score_ar['score_service']);
		$restoran->score_interior = array_sum($score_ar['score_interior'])/count($score_ar['score_interior']);
		$restoran->total_score = array_sum($score_ar['total_score'])/count($score_ar['total_score']);
		$restoran->save();
		
		return Redirect::back();
	}

	function getCallBack ($company_id) {
			
		$company = Company::findOrFail($company_id);
		
		if (Auth::check())	{
			$call = new CompanyCallback();
			$call->company_id = $company_id;
			$call->user_id = Auth::user()->id;
			if (!$call->save()) 
				return Redirect::back()->withErrors($call->getErrors());
		}
		
		
		if (Auth::check()){
			$user = Auth::user();
			$contact = $user->getContactNumber();
			$full_name = $user->full_name;
			$email = $user->email;
		}
		else {
			$user = new User();
			$contact = Input::get('number');
			$full_name = Input::get('full_name');
			$email = Input::get('email');
		}
		
		$subject = Input::get('subject');
		
		MailSend::sendCallBackMessage($user, $company, $subject, $contact, $full_name, $email);
		
		
		return Redirect::back();
	}
	
}
