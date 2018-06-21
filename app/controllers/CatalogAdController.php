<?php
class CatalogAdController extends BaseController {
	private $sys_catalog = null;
	private $advert_ids = null;
    private $all_ads = null;
	private $catalog_id = null;
	private $view_filter_ar = array();
	
    function getIndex ($catalog_id) {
        $this->catalog_id = $catalog_id;
        $catalog = SysAdvertCat::findOrFail($catalog_id);
        $advert_ids = AdvertCat::where('cat2_id', $catalog->id)->lists('advert_id');

        //$check_conditions = array();
       // if(Input::has('negotiable') || Input::has('exchange') || Input::has('free') || Input::has('urgent') || Input::has('hot_deal')){

       //     foreach(array('negotiable','exchange','free','urgent','hot_deal') as $v){
       //         if(Input::has($v)){
       //             if($v == 'hot_deal'){
       //                 $v = 'hot_price';
        //            }
        //        }
        //    }
       // }
        // $check_condition_where = !empty($check_conditions) ? ' AND ('.implode(' OR ', $check_conditions).')' : '';

        $all_ads = Advert::orderBy('vip','desc');
		$this->sys_catalog = $catalog;
		$this->advert_ids = $advert_ids;
		$this->all_ads = $all_ads;

		if (Auth::check()) {
			$user = Auth::user();
			$total_vip_ads = Advert::where('vip', 1)->whereIn('id', $this->advert_ids)->orderBy('created_unix', 'desc')->where('city_id', $user->city_id)->take(12)->get();
		}
		else if (Session::has('def_city_id')){
			$total_vip_ads = Advert::where('vip', 1)->whereIn('id', $this->advert_ids)->orderBy('created_unix', 'desc')->where('city_id', Session::get('def_city_id'))->take(12)->get();
		}
		else 
			$total_vip_ads = Advert::where('vip', 1)->whereIn('id', $this->advert_ids)->orderBy('created_unix', 'desc')->take(12)->get();
		
		Advert::where('vip', 1)->whereIn('id', $this->advert_ids)->increment('is_vip_counter');
		
		$this->generateSortLink();

        if (Input::has('filter') && Input::get('filter'))
			$this->filterAdds($all_ads, $catalog_id);

        //if(!empty($this->advert_ids)) {
            $this->all_ads = $this->all_ads->whereIn('id', $this->advert_ids);

        //}

		if (Auth::check()) {
			$user = Auth::user();
			if ($user->city_id > 0) {
                $this->all_ads = $this->all_ads->where('city_id', $user->city_id);
			}
		} else {
            if (Session::has('def_city_id')) {
                $this->all_ads = $this->all_ads->where('city_id', Session::get('def_city_id'));
            }else{
                $this->all_ads = $this->all_ads->where('city_id', 1);
            }
        }

		$this->all_ads->increment('is_vip_counter');

		$this->generateTotalCountAdvert();
		$this->sortAdverts();

        $ar = array();
        $ar['title'] = 'Catalog';
        $ar['catalog'] = $catalog;
        $ar['all_ads'] = $this->all_ads->paginate(36);
		$ar['total_vip_ads'] = $total_vip_ads;
		$ar['hide_sum'] = ($catalog_id == 33 ? true : false);
        $simple_all_ads_ids = $ar['all_ads']->lists('id');
        $ar['all_ads_ids'] = $simple_all_ads_ids;
        $vip_all_ads_ids = $ar['total_vip_ads']->lists('id');
        $ar['vip_ads_ids'] = $vip_all_ads_ids;
        $view = View::make('front.catalog.index', $ar);
		$view = $this->generateFilters($view);
        return $view;

    }
	
	private function filterAdds () {

        if (Input::has('sub_cat_id') && Input::get('sub_cat_id')) {
            if(!is_array(Input::get('sub_cat_id'))) {
                $sub_cat = SysAdvertCat::find(Input::get('sub_cat_id'));

                if ($sub_cat) {
                    //exit();
                    $this->view_filter_ar['sub_cat'] = $sub_cat->name;
                    $advertsObj = AdvertCat::where('cat2_id', $this->sys_catalog->id)->where('cat3_id', $sub_cat->id);
                    if(Input::has('type_transport_id') && Input::get('type_transport_id')){
                        $advertsObj->where('cat4_id', Input::get('type_transport_id'));
                    }
                    $this->advert_ids = $advertsObj->lists('advert_id');
                }
            }
            else{
                $sub_cats = SysAdvertCat::find(Input::get('sub_cat_id'));

                if ($sub_cats) {
                    //exit();
                    $sbcats = array();
                    foreach($sub_cats as $sub_cat) {
                        $sbcats[] = $sub_cat->name;
                    }

                    $this->view_filter_ar['sub_cat'] = implode(',',$sbcats);
                    $this->advert_ids = AdvertCat::where('cat2_id', $this->sys_catalog->id)->
                    whereIn('cat3_id', Input::get('sub_cat_id'))->lists('advert_id');
                }

            }
		}

		if (Input::has('sub_cat_2_id') && Input::get('sub_cat_2_id')) {
			$sub_cat2 = SysAdvertCat::find(Input::get('sub_cat_2_id'));
			if ($sub_cat2){
				$this->view_filter_ar['sub_cat2'] = $sub_cat2;
				$this->advert_ids = AdvertCat::where('cat2_id', $this->sys_catalog->id)->where('cat4_id', $sub_cat2->id)->lists('advert_id');
			}
		}

		if (Input::has('min_price') && Input::get('min_price')) {
			$min_price = Input::get('min_price');
			$this->all_ads = $this->all_ads->where('price', '>=', $min_price);
		}

		if (Input::has('max_price') && Input::get('max_price')) {
			$max_price = Input::get('max_price');
            $this->all_ads = $this->all_ads->where('price', '<=', $max_price);
		}

        if ((Input::has('min_period') && Input::get('min_period')) ||  Input::has('max_period') && Input::get('max_period')) {
            if(Input::has('min_period') && !Input::has('max_period')) {
                $min_period = date('Y-m-d', strtotime(Input::get('min_period')));

                $ar_advert = AdvertProp::whereRaw('prop_id = 53 and CAST(option_val AS DATE) >= ?', [$min_period])->
                /*where('option_val', '>', (int)$ar_seats[0])->
                where('option_val', '<=', $ar_seats[1])->*/
                lists('advert_id');
                $this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
            }
            elseif(!Input::has('min_period') && Input::has('max_period')) {
                $max_period = date('Y-m-d', strtotime(Input::get('max_period')));
                $ar_advert = AdvertProp::whereRaw('prop_id = 52 and CAST(option_val AS DATE) <= ?', [$max_period])->
                /*where('option_val', '>', (int)$ar_seats[0])->
                where('option_val', '<=', $ar_seats[1])->*/
                lists('advert_id');
                $this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
            }
            else{
                $min_period = date('Y-m-d', strtotime(Input::get('min_period')));
                $max_period = date('Y-m-d', strtotime(Input::get('max_period')));
                $ar_advert = AdvertProp::whereRaw('(prop_id in( 52,53 ) and CAST(option_val AS DATE) between ? and ?)', [$min_period,$max_period])->
                /*where('option_val', '>', (int)$ar_seats[0])->
                where('option_val', '<=', $ar_seats[1])->*/
                lists('advert_id');
                $this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
            }

        }

        if (Input::has('seat') && Input::get('seat')) {
            $ar_seats = explode(';',Input::get('seat'));
            $ar_advert = AdvertProp::whereRaw('prop_id = 18 and CAST(option_val AS UNSIGNED) > ? and CAST(option_val AS UNSIGNED) <= ?', $ar_seats)->
            /*where('option_val', '>', (int)$ar_seats[0])->
            where('option_val', '<=', $ar_seats[1])->*/
            lists('advert_id');
            $this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
        }

        if(Input::has('water_length') && Input::get('water_length')){
            $ar_water_lens = explode(';',Input::get('water_length'));
            $ar_advert = AdvertProp::whereRaw('prop_id = 21 and CAST(option_val AS UNSIGNED) > ? and CAST(option_val AS UNSIGNED) <= ?', $ar_water_lens)->
            /*where('option_val', '>', (int)$ar_seats[0])->
            where('option_val', '<=', $ar_seats[1])->*/
            lists('advert_id');
            $this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
        }

        if (Input::has('term_id') && Input::get('term_id')) {
			$term_id = Input::get('term_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>4))->where('option_val', 'like', '%'.$term_id.'%')->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('with_driver') && Input::get('with_driver')) {
			$with_driver = Input::get('with_driver');
			$ar_advert = AdvertProp::where(array('prop_id'=>5))->where('option_val', 'like', '%'.$with_driver.'%')->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}

        if (Input::has('location') && Input::get('location')) {
			$location = Input::get('location');
            $this->all_ads = $this->all_ads->where('address', 'LIKE', '%'.$location.'%');
		}
		
		if (Input::has('furnished') && Input::get('furnished')) {
			$ar_advert = AdvertProp::where(array('prop_id'=>30))->where('option_val', 86)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('maidroom') && Input::get('maidroom')) {
			$ar_advert = AdvertProp::where(array('prop_id'=>31))->where('option_val', 84)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		
		if (Input::has('keywords') && Input::get('keywords')) {
			$keywords = Input::get('keywords');
			$keywords = explode(",", $keywords);
			if (count($keywords) > 0) {
				$about = Advert::where('title', 'LIKE', '%'.trim(array_shift($keywords)).'%');/*
				if (count($keywords) > 0) {
					foreach ($keywords as $k) {
						$about = $about->where('note', 'LIKE', '%'.trim($k).'%');
					}
				}
				*/
				$ar_advert = $about->lists('id');
				$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
			}
		}

		if (Input::has('auto_brand_id') && Input::get('auto_brand_id')) {
			$auto_brand_id = Input::get('auto_brand_id');
            $this->all_ads = $this->all_ads->where('auto_brand_id', $auto_brand_id);
		}

		if (Input::has('auto_model_id') && Input::get('auto_model_id')) {
			$auto_model_id = Input::get('auto_model_id');
            foreach($auto_model_id as $k => $v){
                if(empty($v)){
                    unset($auto_model_id[$k]);
                }
            }
            if(!empty($auto_model_id)) {
                $this->all_ads = $this->all_ads->whereIn('auto_model_id', $auto_model_id);
            }
		}

		if (Input::has('min_year') && Input::get('min_year')) {
			$min_year = Input::get('min_year');
			$ar_advert = AdvertProp::where(array('prop_id'=>17))->where('option_val', '>=', $min_year)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('max_year') && Input::get('max_year')) {
			$max_year = Input::get('max_year');
			$ar_advert = AdvertProp::where(array('prop_id'=>17))->where('option_val', '<=', $max_year)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('car_body_id') && Input::get('car_body_id')) {
			$car_body_id = Input::get('car_body_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>6))->where('option_val', $car_body_id)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('car_color_id') && Input::get('car_color_id')) {
			$car_color_id = Input::get('car_color_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>15))->where('option_val', $car_color_id)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('car_mileage_id') && Input::get('car_mileage_id')) {
			$car_mileage_id = Input::get('car_mileage_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>8))->where('option_val', $car_mileage_id)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('car_fuel_id') && Input::get('car_fuel_id')) {
			$car_fuel_id = Input::get('car_fuel_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>14))->where('option_val', $car_fuel_id)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('car_transmiss_id') && Input::get('car_transmiss_id')) {
			$car_transmiss_id = Input::get('car_transmiss_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>12))->where('option_val', $car_transmiss_id)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('car_drive_wheel_id') && Input::get('car_drive_wheel_id')) {
			$car_drive_wheel_id = Input::get('car_drive_wheel_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>10))->where('option_val', $car_drive_wheel_id)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('car_warranty_id') && Input::get('car_warranty_id')) {
			$car_warranty_id = Input::get('car_warranty_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>11))->where('option_val', $car_warranty_id)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('car_condition_id') && Input::get('car_condition_id')) {
			$car_condition_id = Input::get('car_condition_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>13))->where('option_val', $car_condition_id)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('size_id') && Input::get('size_id')) {
			$size_id = Input::get('size_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>($this->catalog_id == 81 ? 24 : 23)))->where('option_val', $size_id)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('male_id') && Input::get('male_id')) {
			$male_id = Input::get('male_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>22))->whereIn('option_val', $male_id)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('job_time_id') && Input::get('job_time_id')) {
			$job_time_id = Input::get('job_time_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>50));
			$ar_advert = $ar_advert->where('option_val', $job_time_id);
			$ar_advert = $ar_advert->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('job_exprience_id') && Input::get('job_exprience_id')) {
			$job_exprience_id = Input::get('job_exprience_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>47))->where('option_val', 'LIKE', '%'.$job_exprience_id.'%')->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('job_visa_id') && Input::get('job_visa_id')) {
			$job_visa_id = Input::get('job_visa_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>44))->where('option_val', $job_visa_id)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('min_salary') && Input::get('min_salary')) {
			$min_salary = Input::get('min_salary');
			$ar_advert = AdvertProp::where(array('prop_id'=>46))->where('option_val', '>=', $min_salary)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('max_salary') && Input::get('max_salary')) {
			$max_salary = Input::get('max_salary');
			$ar_advert = AdvertProp::where(array('prop_id'=>46))->where('option_val', '<=', $max_salary)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('job_company_size') && Input::get('job_company_size')) {
			$job_company_size = Input::get('job_company_size');
			$ar_advert = AdvertProp::where(array('prop_id'=>49))->where('option_val', $job_company_size)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('min_bedromm') && Input::get('min_bedromm')) {
			$min_bedromm = Input::get('min_bedromm');
			$ar_advert = AdvertProp::where(array('prop_id'=>26))->where('option_val', '>=',$min_bedromm)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('max_bedromm') && Input::get('max_bedromm')) {
			$max_bedromm = Input::get('max_bedromm');
			$ar_advert = AdvertProp::where(array('prop_id'=>26))->where('option_val', '<=',$max_bedromm)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('min_size_property') && Input::get('min_size_property')) {
			$min_size_property = Input::get('min_size_property');
			$ar_advert = AdvertProp::where(array('prop_id'=>27))->where('option_val', '>=',$min_size_property)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('max_size_property') && Input::get('max_size_property')) {
			$max_size_property = Input::get('max_size_property');
			$ar_advert = AdvertProp::where(array('prop_id'=>27))->where('option_val', '<=',$max_size_property)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('bathtooms') && Input::get('bathtooms')) {
			$bathtooms = Input::get('bathtooms');
			$ar_advert = AdvertProp::where(array('prop_id'=>28))->where('option_val', $bathtooms)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}
		
		if (Input::has('parking_id') && Input::get('parking_id')) {
			$parking_id = Input::get('parking_id');
			$ar_advert = AdvertProp::where(array('prop_id'=>29))->where('option_val', $parking_id)->lists('advert_id');
			$this->advert_ids = array_intersect($ar_advert, $this->advert_ids);
		}

        if(Input::has('negotiable') || Input::has('exchange') || Input::has('free') || Input::has('urgent') || Input::has('hot_deal')){
            $this->all_ads = $this->all_ads->where(function($q) {
                $q->where('negotiable', Input::get('negotiable'))
                  ->orWhere('exchange', Input::get('exchange'))
                  ->orWhere('free', Input::get('free'))
                  ->orWhere('urgent', Input::get('urgent'))
                  ->orWhere('hot_price', Input::get('hot_deal'));
            });
        }

	}
	
	private function generateFilters ($view) {
        $confirmation = array(
            //Buses
            138 => [
                'years'=>[1980,2018],
                'price' => [10000=>'10 k', 25000 => '25 k',50000 => '50 k', 75000 => '75 k', 100000=> '100 k',
                    150000 => '150 k',200000=> '200 k', 300000 => '300 k', 500000 => '500 k'],
                'tpl' => 'buses'
            ],
            //Campers
            139 => [
                'years'=>[1980,2018],
                'price' => [25000 => '25 k',50000 => '50 k', 75000 => '75 k', 100000=> '100 k',
                    150000 => '150 k',200000=> '200 k'],
                'tpl' => 'campers'
            ],
            //Cars
            30 =>
                [
                    'price' => [10000=>'10 k', 25000 => '25 k',50000 => '50 k', 75000 => '75 k', 100000=> '100 k',
                        150000 => '150 k',200000=> '200 k', 300000 => '300 k', 500000 => '500 k', 750000 => '750 k',
                        1000000 => '1mln', 1000001 => '1mln +'],
                    'years'  => [1960,2018],
                    'tpl' => 'auto_sale'
                ],
            //Heavy &amp; Construction Vehicles
            143 => [
                'price' => [10000=>'10 k', 25000 => '25 k',50000 => '50 k', 75000 => '75 k', 100000=> '100 k',
                    150000 => '150 k',200000=> '200 k', 300000 => '300 k', 500000 => '500 k', 750000 => '750 k',
                    1000000 => '1mln', 1000001 => '1mln +'],
                'years'=> [1980,2018],
                'tpl' => 'heavy'
            ],

            //Motorbikes
            140 => [
                'price' => [10000=>'10 k', 25000 => '25 k',50000 => '50 k', 75000 => '75 k', 100000=> '100 k',
                    150000 => '150 k',200000=> '200 k', 300000 => '300 k', 300000 => '300 k+'],
                'years'=> [1980,2018],
                'tpl' => 'motorbikes'
            ],
            //Planes &amp; Helicopters
            144 => [
                'price' => [10000=>'10 k', 25000 => '25 k',50000 => '50 k', 75000 => '75 k', 100000=> '100 k',
                    150000 => '150 k',200000=> '200 k', 300000 => '300 k', 500000 => '500 k', 750000 => '750 k',
                    1000000 => '1mln', 1000001 => '1mln +'],
                'years'=> [1980,2018],
                'tpl' => 'planes'
            ],
            //Trucks
            142 => [
                'price' => [10000=>'10 k', 25000 => '25 k',50000 => '50 k', 75000 => '75 k', 100000=> '100 k',
                    150000 => '150 k',200000=> '200 k', 300000 => '300 k', 500000 => '500 k', 750000 => '750 k',
                    1000000 => '1mln', 1000001 => '1mln +'],
                'years'=> [1980,2018],
                'tpl'=> 'trucks'
            ],
            //Water transports
            141 => [
                'price' => [10000=>'10 k', 25000 => '25 k',50000 => '50 k', 75000 => '75 k', 100000=> '100 k',
                    150000 => '150 k',200000=> '200 k', 300000 => '300 k', 500000 => '500 k', 750000 => '750 k',
                    1000000 => '1mln', 1000001 => '1mln +'],
                'years'=> [1960,2018],
                'tpl' => 'water'
            ]
        );
		$cat = $this->sys_catalog;
		$parent_cat = SysAdvertCat::findOrFail($cat->parent_id);

		$ar = $this->view_filter_ar;
		$ar['cat'] = $cat;
        $ar['type_car'] =  Input::has('sub_cat_id') ? Input::get('sub_cat_id') : null;
        $type_car = Input::has('sub_cat_id') ? Input::get('sub_cat_id') : 30;
		$ar['parent_cat'] = $parent_cat;
		$ar['sub_cats'] = SysAdvertCat::where('parent_id', $cat->id)->orderBy('name', 'asc')->lists('name', 'id');

        $ar['types_parts'] = array();
        if($ar['type_car'] !== null){
            $ar['types_parts'] =  SysAdvertCat::where('parent_id', $type_car)->orderBy('name', 'asc')->lists('name', 'id');
        }

        $ar['bed_room_types'] = array(1=>'1',2=>'2',3=>'3',4=>'4',5=>'5',6=>'6',7=>'7',8=>'8',9=>'9',10=>'10+');
        $ar['bath_rooms_types'] = array(1=>'1+',2=>'2+',3=>'3+',4=>'4+',5=>'5+');
        $ar['parking_types'] = array(1=>'1+',2=>'2+',3=>'3+',4=>'4+',5=>'5+');
        $ar['prices_auto'] = array(10000=>'10 k', 25000 => '25 k',50000 => '50 k', 75000 => '75 k', 100000=> '100 k',
            150000 => '150 k',200000=> '200 k', 300000 => '300 k', 500000 => '500 k', 750000 => '750 k',
            1000000 => '1mln', 1000001 => '1mln +');
        $ar['years'] = array();
        for($y=2018;$y>=1960;$y--){
            $ar['years'][$y] = $y;
        }
        $ar['experience_list'] = array(1=> '0 – 1 years', 5=> '2-5 years', 9 => '6-9 years', 15 => '10 -15 years',
                                       16 => '16 + years');
        $ar['ar_terms_property'] = SysAdvertPropOption::where('prop_id',33)->lists('name','id');
        $ar['ar_capital_list'] = array(50000=>'0 – 50 k' , 100000=>'51 k – 100 k' , 200000 => '101 k – 200 k',
                                       500000=>'201 k – 500 k',1000000=>'500 k – 1 mln' , 1000001 => '1 mln +');
		$ar['mileage_list'] = array(10000 => '10 k', 25000 => '25 k', 50000=> '50 k', 75000=> '75 k',
                                    100000=> '100 k', 150000=> '150 k', 200000 => '200 k', 200000=> '200 k +');
        $ar['number_seats'] = array('9;20'=>'9 – 20', '21;30' => '21 – 30', '31;40'=>'31 -40','41;50' => '41-50');
        $ar['ar_condition'] = SysAdvertPropOption::where('prop_id', 13)->lists('name', 'id');

        if ($cat->id == 20){ // auto for rent
			$ar['ar_terms'] = SysAdvertPropOption::where('prop_id', 4)->lists('name', 'id');
			$view = $view->nest('filter_block','front.catalog.filters.auto_for_rent', $ar);
		}
		else if ($cat->id == 17){ // auto for sale
			$ar['ar_terms'] = SysAdvertPropOption::where('prop_id', 4)->lists('name', 'id');
			$ar['ar_brands'] = SysAdAutoBrand::lists('name', 'id');
            $ar['tpl'] = $confirmation[$type_car]['tpl'];

			if (Input::has('auto_brand_id') && Input::get('auto_brand_id')) 
				$ar['ar_models'] = SysAdAutoModel::where('brand_id', Input::get('auto_brand_id'))->lists('name', 'id');
			else 
				$ar['ar_models'] = array();

            $ar['prices_auto'] = $confirmation[$type_car]['price'];
            $ar['years'] = array();
            $years = $confirmation[$type_car]['years'];
            for($y=$years[1];$y>=$years[0];$y--){
                $ar['years'][$y] = $y;
            }
            $ar['mileage_list'] = array(10000 => '10 k', 25000 => '25 k', 50000=> '50 k', 75000=> '75 k',
                100000=> '100 k', 150000=> '150 k', 200000 => '200 k', 200000=> '200 k +');

            $ar['number_seats'] = array('9;20'=>'9 – 20', '21;30' => '21 – 30', '31;40'=>'31 -40','41;50' => '41-50');

            $ar['experience_list'] = array(1=> '0 – 1 years', 5=> '2-5 years', 9 => '6-9 years', 15 => '10 -15 years',
                16 => '16 + years');
            $ar['ar_terms_property'] = SysAdvertPropOption::where('prop_id',33)->lists('name','id');
            $ar['ar_capital_list'] = array(50000=>'0 – 50 k' , 100000=>'51 k – 100 k' , 200000 => '101 k – 200 k',
                500000=>'201 k – 500 k',1000000=>'500 k – 1 mln' , 1000001 => '1 mln +');

			$ar['ar_body'] = SysAdvertPropOption::where('prop_id', 6)->lists('name', 'id');
			$ar['ar_color'] = SysAdvertPropOption::where('prop_id', 15)->lists('name', 'id');
			$ar['ar_fuel'] = SysAdvertPropOption::where('prop_id', 14)->lists('name', 'id');
			$ar['ar_transmission'] = SysAdvertPropOption::where('prop_id', 12)->lists('name', 'id');
			$ar['ar_drive_wheel'] = SysAdvertPropOption::where('prop_id', 10)->lists('name', 'id');
			$ar['ar_warranty'] = SysAdvertPropOption::where('prop_id', 11)->lists('name', 'id');
			$ar['ar_condition'] = SysAdvertPropOption::where('prop_id', 13)->lists('name', 'id');

            $ar['ar_type_transport'] = SysAdvertCat::where('parent_id', $type_car)->lists('name', 'id');

            $ar['ar_water_length'] = array('1;10'=>'Under 10', '10;19'=>'10-19 ft', '20;29'=>'20-29 ft', '30;39'=>'30-39 ft',
                '40;49'=>'40-49 ft', '50;75' => '50-75 ft', '75;99'=>'75-99 ft', '100;100000'=>'100 ft +');

			$view = $view->nest('filter_block','front.catalog.filters.auto_for_sale', $ar);
		}
		else if ($cat->id == 21){ // auto parts
			$ar['ar_terms'] = SysAdvertPropOption::where('prop_id', 4)->lists('name', 'id');
			$ar['ar_brands'] = SysAdAutoBrand::lists('name', 'id');
			
			if (Input::has('auto_brand_id') && Input::get('auto_brand_id')) 
				$ar['ar_models'] = SysAdAutoModel::where('brand_id', Input::get('auto_brand_id'))->lists('name', 'id');
			else 
				$ar['ar_models'] = array();
				
			$ar['ar_body'] = SysAdvertPropOption::where('prop_id', 6)->lists('name', 'id');
			$ar['ar_condition'] = SysAdvertPropOption::where('prop_id', 13)->lists('name', 'id');

			$view = $view->nest('filter_block','front.catalog.filters.auto_parts', $ar);
		}
		else if ($cat->id == 69){ // Consumer Goods/Home Furnishings
			$ar['ar_condition'] = SysAdvertPropOption::where('prop_id', 13)->lists('name', 'id');
				
			$view = $view->nest('filter_block','front.catalog.filters.default_with_condition', $ar);
		}
		else if ($cat->id == 80){ // Consumer Goods/Clothes 
			$ar['ar_condition'] = SysAdvertPropOption::where('prop_id', 13)->lists('name', 'id');
			$ar['ar_size'] = SysAdvertPropOption::where('prop_id', 23)->lists('name', 'id');
				
			$view = $view->nest('filter_block','front.catalog.filters.default_with_condition_size', $ar);
		}
        else if ($cat->id == 81){ // Consumer Goods/Shoes
            $ar['ar_condition'] = SysAdvertPropOption::where('prop_id', 13)->lists('name', 'id');
            $ar['ar_size'] = SysAdvertPropOption::where('prop_id', 24)->lists('name', 'id');

            $view = $view->nest('filter_block','front.catalog.filters.default_with_condition_size', $ar);
        }
        else if ($cat->id == 97){ // Busines/Distributorship
            $view = $view->nest('filter_block','front.catalog.filters.distirbutorship', $ar);
        }
        else if ($cat->id == 96){ // Busines/Franchising
            $view = $view->nest('filter_block','front.catalog.filters.franchising', $ar);
        }
        else if ($cat->id == 94){ // Busines/Partnership
            $ar['capital'] = array(0 => '0 – 50 k' , 51000 =>'51 k – 100 k',100001=>  '101 k – 200 k', 200000=> '201 k – 500 k' ,
                500000 => '500 k – 1 mln' , 1000001 =>'1 mln +');
            $view = $view->nest('filter_block','front.catalog.filters.partnership', $ar);
        }
		else if ($cat->id == 78){ // Consumer Goods/Pets
			$ar['ar_male'] = SysAdvertPropOption::where('prop_id', 22)->lists('name', 'id');
				
			$view = $view->nest('filter_block','front.catalog.filters.default_male', $ar);
		}
		else if (in_array($cat->id, SysAdvertCat::where('parent_id', 7)->lists('id'))) { // Equipments and Materials
			$ar['ar_condition'] = SysAdvertPropOption::where('prop_id', 13)->lists('name', 'id');
				
			$view = $view->nest('filter_block','front.catalog.filters.default_with_condition', $ar);
		}
		else if (in_array($cat->id, SysAdvertCat::where('parent_id', 8)->lists('id'))) { // Events
			$ar['ar_condition'] = SysAdvertPropOption::where('prop_id', 13)->lists('name', 'id');
				
			$view = $view->nest('filter_block','front.catalog.filters.events', $ar);
		}
		else if ($cat->id == 33){ // Jobs/CV
			$ar['ar_times'] = SysAdvertPropOption::where('prop_id', 50)->lists('name', 'id');
			$ar['ar_visa'] = SysAdvertPropOption::where('prop_id', 44)->lists('name', 'id');
				
			$view = $view->nest('filter_block','front.catalog.filters.job_cv', $ar);
		}
		else if ($cat->id == 31){ // Jobs/Vacancies
			$ar['ar_times'] = SysAdvertPropOption::where('prop_id', 50)->lists('name', 'id');
			$ar['ar_company_size'] = SysAdvertPropOption::where('prop_id', 49)->lists('name', 'id');
				
			$view = $view->nest('filter_block','front.catalog.filters.job_vacance', $ar);
		}

		else if (in_array($cat->id, SysAdvertCat::where('parent_id', 9)->lists('id'))) { // Found and lost
			$ar['ar_condition'] = SysAdvertPropOption::where('prop_id', 13)->lists('name', 'id');
				
			$view = $view->nest('filter_block','front.catalog.filters.found_lost', $ar);
		}
		else if (in_array($cat->id, SysAdvertCat::where('parent_id', 1)->lists('id'))) { // Property
				
			$view = $view->nest('filter_block','front.catalog.filters.property', $ar);
		}
		else if (in_array($cat->id, SysAdvertCat::where('parent_id', 4)->lists('id'))) { // Services
			$ar['ar_condition'] = SysAdvertPropOption::where('prop_id', 13)->lists('name', 'id');
				
			$view = $view->nest('filter_block','front.catalog.filters.found_lost', $ar);
		}
		else if (in_array($cat->id, SysAdvertCat::where('parent_id', 4)->lists('id'))) { // Services
			$ar['ar_condition'] = SysAdvertPropOption::where('prop_id', 13)->lists('name', 'id');
				
			$view = $view->nest('filter_block','front.catalog.filters.found_lost', $ar);
		}
		else {
			$view = $view->nest('filter_block','front.catalog.filters.default', $ar);
		}

		return $view;
	}
	
	private function generateTotalCountAdvert(){ // функция подсчета количества обьявлений
		$total_count = 0;
		
		$total_count = $total_count + $this->all_ads->count();
		
		$this->view_filter_ar['advert_count'] = $total_count;
	}
	
	private function generateSortLink () { // функция генерации ссылки для сортировки
		$ar = Input::all();
		
		$link = '?show_sort=1';
		foreach ($ar as $k=>$v) {
			if ($k == 'val_sort' || $k == 'page' || is_array($v))
				continue;
				
			$link = $link.'&'.$k.'='.$v;
		}
		$link = $link.'&val_sort=';
		
		$this->view_filter_ar['val_sort'] = $link;
	}
	
	private function sortAdverts () { // функции сортировки
		if (Input::has('show_sort') && Input::has('val_sort') && in_array(Input::get('val_sort'), array('most_cheap', 'most_expen', 'most_popul'))){
			$sort = Input::get('val_sort');
			if ($sort == 'most_cheap'){
                $this->all_ads = $this->all_ads->orderBy('price', 'asc');
			}
			else if ($sort == 'most_expen') {
                $this->all_ads = $this->all_ads->orderBy('price', 'desc');
			}
			else if ($sort == 'most_popul') {
                $this->all_ads = $this->all_ads->orderBy('vip_views', 'desc');
			}
		}
		else {
            $this->all_ads = $this->all_ads->orderBy('created_unix', 'desc');
		}
	}
	
}
