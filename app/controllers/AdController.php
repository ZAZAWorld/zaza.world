<?php
class AdController extends BaseController {

	function anySearchBody () {
		if (!Input::has('search'))
			return '0';
			
		$search = Input::get('search');
		$items = $this->generateSearchResult($search);
		
		echo json_encode($items);
	}
	
	function modifySearchString ($search, $text) {
		if (strlen($text) > 200)
			$text = substr($text, 0, 200).'...';
			
		$text = str_replace($search, "<b>".$search."</b>", $text);
		
		return $text;
	}
	
	function generateSearchResult ($search) {
		/***** advert search ****/
		$ar_ad_type = SysAdvertCat::where('level', 1)->lists('name', 'id');
		$ar_advert_id = AdvertAbout::where('note', 'like', '%'.$search.'%')->lists('advert_id', 'advert_id');
		
		$items = Advert::where('title', 'like', '%'.$search.'%')->with('relAbout', 'relOneCat')->get();
		$res = array();
		foreach ($items as $i) {
			if (isset($ar_advert_id[$i->id]))
				unset($ar_advert_id[$i->id]);
				
			if ($i->relAbout && $i->relOneCat) {
				$title = $this->modifySearchString($search, $i->title); 
				$about = $this->modifySearchString($search, $i->relAbout->note);  
				$res[] = array(
					'id' => $i->id, 'title' => $title, 'note' => $about, 'cat' => $ar_ad_type[$i->relOneCat->cat1_id], 'cat_1_id' => $i->relOneCat->cat1_id, 'cat_2_id' => $i->relOneCat->cat2_id, 'type' => 1
				);
			}
		}
		
		if (count($ar_advert_id) > 0) {
			$ar_advert_id = array_keys($ar_advert_id);
			$items = Advert::whereIn('id', $ar_advert_id)->with('relAbout', 'relOneCat')->get();
			foreach ($items as $i) {
				if ($i->relAbout && $i->relOneCat) {
					$title = $this->modifySearchString($search, $i->title); 
					$about = $this->modifySearchString($search, $i->relAbout->note);  
					$res[] = array(
						'id' => $i->id, 'title' => $title, 'note' => $about, 'cat' => $ar_ad_type[$i->relOneCat->cat1_id], 'cat_1_id' => $i->relOneCat->cat1_id, 'cat_2_id' => $i->relOneCat->cat2_id, 'type' => 1
					);
				}
			}
		}
		
		/***** company search ****/
		$ar_company_type = SysCompanyType::lists('name', 'id');
		
		$items = Company::where('title', 'like', '%'.$search.'%')->orWhere('more_info', 'like', '%'.$search.'%')->with('relOneCat')->get();
		foreach ($items as $i) {
			if ($i->relOneCat) {
				$title = $this->modifySearchString($search, $i->title); 
				$about = $this->modifySearchString($search, $i->more_info); 
				$res[] = array(
					'id' => $i->id, 'title' => $title, 'note' => $about, 'cat' => $ar_company_type[$i->relOneCat->type_id], 'cat_1_id' => $i->relOneCat->type_id, 'cat_2_id' => $i->relOneCat->cat_id, 'type' => 2
				);
			}
		}
		
		return $res;
		
	}
	
    function anyView () {
        $advert_id = Input::get('id');
        $advert_ids = Input::get('ids');
        $ids = explode(',', $advert_ids);
        $current_key_id = array_search($advert_id, $ids,true);

        $advert = Advert::find($advert_id);
        if(!$advert)
            return '0';
		
		$advert->setView();
		
		$advert_cat = AdvertCat::where('advert_id', $advert->id)->first();
		if (!$advert_cat)
			return '0';
			
		if ($advert_cat->cat1_id == '3' and $advert_cat->cat2_id == '33')
			return $this->viewJob($advert, $advert_cat);
		else if ($advert_cat->cat1_id == '2')
			return $this->viewCar($advert, $advert_cat);

        if ($current_key_id-1 == -1)
            $previous = $ids[$current_key_id];
        else
            $previous = $ids[$current_key_id-1];

        if ($ids[$current_key_id] == end($ids))
            $next = $ids[$current_key_id];
        else
            $next = $ids[$current_key_id+1];

        $ar = array();
        $ar['advert'] = $advert;
        $ar['previous'] = $previous;
        $ar['next'] = $next;
        $ar['advert_ids'] = $advert_ids;
        $ar['about'] = AdvertAbout::where('advert_id', $advert->id)->first();
        $ar['files'] = AdvertFile::where('advert_id', $advert->id)->get();
        $ar['props'] = AdvertProp::where('advert_id', $advert->id)->get();
		
		$new_ar = array();
		foreach ($ar['props'] as $prop) {
			$p = $prop->getProp();
			if (!$p){
				$new_ar[] = $prop;
				continue;
			}
			
			if (isset($new_ar[$p->order_id]))
				$new_ar[($p->order_id + 1)] = $prop;
			else
				$new_ar[$p->order_id] = $prop;
		}
		ksort($new_ar);
		$ar['props'] = $new_ar;
		
        $ar['owner'] = User::findOrFail($advert->user_id);
		$ar['advert_cat'] = $advert_cat;

        return View::make('front.catalog.house_dialog', $ar);
    }
	
	function viewJob ($advert, $advert_cat) {
		$ar_advert_id = AdvertCat::where(array('cat1_id'=>$advert_cat->cat1_id, 'cat2_id'=>$advert_cat->cat2_id))->lists('advert_id');
		
        $previous = Advert::where('id', '>', $advert->id)->whereIn('id', $ar_advert_id)->min('id');
        $next = Advert::where('id', '<', $advert->id)->whereIn('id', $ar_advert_id)->max('id');
        if (!$previous) 
			$previous = Advert::whereIn('id', $ar_advert_id)->min('id');
        if (!$next)
			$next = Advert::whereIn('id', $ar_advert_id)->max('id');

        $ar = array();
        $ar['advert'] = $advert;
        $ar['previous'] = $previous;
        $ar['next'] = $next;
        $ar['about'] = AdvertAbout::where('advert_id', $advert->id)->first();
        $ar['files'] = AdvertProp::where('advert_id', $advert->id)->where('prop_id', 45)->get(); 
        $ar['props'] = AdvertProp::where('advert_id', $advert->id)->get();
		
		$new_ar = array();
		foreach ($ar['props'] as $k=>$prop) {
			$new_ar[$prop->prop_id] = $prop;
		}
		$ar['props'] = $new_ar;
			
		//echo '<pre>'; print_r($ar['props']); echo '</pre>'; exit();
		/*
		$new_ar = array();
		foreach ($ar['props'] as $prop) {
			$p = $prop->getProp();
			if (!$p){
				$new_ar[] = $prop;
				continue;
			}
			
			if (isset($new_ar[$p->order_id]))
				$new_ar[($p->order_id + 1)] = $prop;
			else
				$new_ar[$p->order_id] = $prop;
		}
		ksort($new_ar);
		$ar['props'] = $new_ar;
		*/
		
        $ar['owner'] = User::findOrFail($advert->user_id);
		$ar['ar_cat'] = SysAdvertCat::lists('name', 'id');
		$ar['cat'] = $advert_cat;

        return View::make('front.catalog.job_cv', $ar);
	}	
	
	function viewCar ($advert) {
        $advert_ids = Input::get('ids');
        $ids = explode(',', $advert_ids);
        $current_key_id = array_search($advert->id, $ids,true);

        if ($current_key_id-1 == -1)
            $previous = $ids[$current_key_id];
        else
            $previous = $ids[$current_key_id-1];

        if ($ids[$current_key_id] == end($ids))
            $next = $ids[$current_key_id];
        else
            $next = $ids[$current_key_id+1];

        $ar = array();
        $ar['advert'] = $advert;
        $ar['previous'] = $previous;
        $ar['next'] = $next;
        $ar['advert_ids'] = $advert_ids;
        $ar['about'] = AdvertAbout::where('advert_id', $advert->id)->first();
        $ar['files'] = AdvertFile::where('advert_id', $advert->id)->get();
        $ar['props'] = AdvertProp::where('advert_id', $advert->id)->get();
		
		$new_ar = array();
		foreach ($ar['props'] as $prop) {
			$p = $prop->getProp();
			if (!$p){
				$new_ar[] = $prop;
				continue;
			}
				
			
			if (isset($new_ar[$p->order_id]))
				$new_ar[] = $prop;
			else
				$new_ar[$p->order_id] = $prop;
		}
		ksort($new_ar);
		$ar['props'] = $new_ar;
        $ar['owner'] = User::findOrFail($advert->user_id);

        return View::make('front.catalog.house_dialog', $ar);
	}

    function getIndex (){

    }

    function anySubCat(){
        if(!Input::has('id'))
            return '0';

        $res = SysAdvertCat::where('parent_id', Input::get('id'))->where('id', '<>', 137)->orderBy('name', 'asc')->get();
        echo json_encode($res);
    }
	
	function postCarModel(){
		if(!Input::has('id'))
            return '0';
		
		$res = SysAdAutoModel::where('brand_id', Input::get('id'))->orderBy('name', 'asc')->get();
        echo json_encode($res);			
	}

    function postCarFilter(){
        $type_car = (int)Input::get('type_id');
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
                    'years'=> [1980,2017],
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
        $cat = SysAdvertCat::findOrFail(17);
        $parent_cat = SysAdvertCat::findOrFail($cat->parent_id);

        $ar = array();
        $ar['type_car'] = $type_car;
        $ar['cat'] = $cat;
        $ar['parent_cat'] = $parent_cat;
        $ar['sub_cats'] = SysAdvertCat::where('parent_id', $cat->id)->orderBy('name', 'asc')->lists('name', 'id');

        $ar['bed_room_types'] = array(1=>'1',2=>'2',3=>'3',4=>'4',5=>'5',6=>'6',7=>'7',8=>'8',9=>'9',10=>'10+');
        $ar['bath_rooms_types'] = array(1=>'1+',2=>'2+',3=>'3+',4=>'4+',5=>'5+');
        $ar['parking_types'] = array(1=>'1+',2=>'2+',3=>'3+',4=>'4+',5=>'5+');
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
         // auto for sale
            $ar['ar_terms'] = SysAdvertPropOption::where('prop_id', 4)->lists('name', 'id');
            $ar['ar_brands'] = SysAdAutoBrand::lists('name', 'id');

            /*if (Input::has('auto_brand_id') && Input::get('auto_brand_id'))
                $ar['ar_models'] = SysAdAutoModel::where('brand_id', Input::get('auto_brand_id'))->lists('name', 'id');
            else*/
            $ar['ar_models'] = array();

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
        /**
         *
         */
        $tpl = $confirmation[$type_car]['tpl'];
        return View::make('front.catalog.filters.ajax.'.$tpl, $ar);
    }

    function anyGenerateBody() {
        if(!Input::has('cat_1') || !Input::has('cat_2'))
            return '0';

        $cat_1 = Input::get('cat_1');
        $cat_2 = Input::get('cat_2');
        $cat_3 = Input::get('cat_3');
        $cat_4 = Input::get('cat_4');

        $ar = array();
        $ar['cat_1'] = $cat_1;
        $ar['cat_2'] = $cat_2;
        $ar['cat_3'] = $cat_3;
        $ar['cat_4'] = $cat_4;

        $ar = $this->generateAdBodyTitle($ar);
        $ar = $this->generateOptions($ar);
		
        if ($cat_1 == 1) { // property ad
			if ($cat_2 == 10) { // Property for sale
				if ($cat_3 == 23){ // Residential
                    if (in_array($cat_4, array(113))) // apartments
                           return View::make('front.ad.add_body.property_sale_residential_apartments', $ar);
                        else
                           return View::make('front.ad.add_body.property_sale_residential', $ar);
                }
				if ($cat_3 == 24) // Commercial
					return View::make('front.ad.add_body.property_sale_commercial', $ar); 
				if ($cat_3 == 25) // Land
					return View::make('front.ad.add_body.property_sale_commercial', $ar); 
				if ($cat_3 == 26) // Property Abroad
					return View::make('front.ad.add_body.property_sale_abroad', $ar); 
			}
			else if ($cat_2 == 16) { // Property for rent
				//if ($cat_3 == 27) // Residential
					//return View::make('front.ad.add_body.property_rent_residential', $ar); 
				if ($cat_3 == 27) {	
				if (in_array($cat_4, array(125, 912))) // rooms villa, rooms apartment
					return View::make('front.ad.add_body.property_rent_residential_rooms', $ar);
				else
				    if (in_array($cat_4, array(123))) // apartments
					    return View::make('front.ad.add_body.property_rent_residential_apartments', $ar);
				    else
                        return View::make('front.ad.add_body.property_rent_residential', $ar);
				}
				
				if ($cat_3 == 28) // Commercial
					return View::make('front.ad.add_body.property_rent_commercial', $ar); 
				
				if ($cat_3 == 29) // Property Abroad
					return View::make('front.ad.add_body.property_rent_abroad', $ar); 
			} 
        }
        else if ($cat_1 == 2) { // auto ad
			$ar['ar_auto_brands'] = SysAdAutoBrand::orderBy('name', 'asc')->get();
			$ar['ar_year'] = array();
			for ($i = 1900; $i <= 2018; $i++) {
				$ar['ar_year'][$i] = $i;
			}
			krsort($ar['ar_year']);
			
			if ($cat_2 == 17){// Auto sale
				if ($cat_3 == 30) // car 
					return View::make('front.ad.add_body.car_sale', $ar);
				if ($cat_3 == 138) // Buses 
					return View::make('front.ad.add_body.car_sale_bus', $ar);
				if ($cat_3 == 139) // Campers 
					return View::make('front.ad.add_body.car_sale_campers', $ar);
				if ($cat_3 == 140) // Motorbikes 
					return View::make('front.ad.add_body.car_sale_motorbike', $ar);
				if ($cat_3 == 141) // Water transports 
					return View::make('front.ad.add_body.car_sale_water_trans', $ar);
				if ($cat_3 == 142) // Trucks 
					return View::make('front.ad.add_body.car_sale_trucks', $ar);
				if ($cat_3 == 143) // Heavy & Construction Vehicles 
					return View::make('front.ad.add_body.car_sale_heavy', $ar);
				if ($cat_3 == 144) // Planes & Helicopters
					return View::make('front.ad.add_body.car_sale_planes', $ar);
			} 
			
			if ($cat_2 == 18) // Parking
				return View::make('front.ad.add_body.clean_template', $ar);
				
			if ($cat_2 == 19) // Plates
				return View::make('front.ad.add_body.clean_template_full', $ar);
			
            if ($cat_2 == 20) // Auto rent
                return View::make('front.ad.add_body.car_rent', $ar);
				
			if ($cat_2 == 21){// Auto parts
				if ($cat_3 == 151) // Car Parts
					return View::make('front.ad.add_body.car_part', $ar);
				if ($cat_3 == 152) // Motorbike & Bike Parts
					return View::make('front.ad.add_body.car_part_bus', $ar);
				if ($cat_3== 153) // Buses part
					return View::make('front.ad.add_body.car_part_bus', $ar);
				if ($cat_3 == 156) // Trucks parts
					return View::make('front.ad.add_body.car_part_bus', $ar);
					
				if ($cat_3 == 154) // water transport
					return View::make('front.ad.add_body.car_part_water_transport', $ar);
				if ($cat_3 == 155) // Planes & Helicopters
					return View::make('front.ad.add_body.car_part_water_transport', $ar);
				if ($cat_3 == 157) // Heavy & Construction Vehicles Parts
					return View::make('front.ad.add_body.car_part_water_transport', $ar);
					
				return View::make('front.ad.add_body.car_part', $ar);
			} 
			
			if ($cat_2 == 22) // Auto repair
				return View::make('front.ad.add_body.clean_template', $ar);
				
        }
        else if ($cat_1 == 3) { // Jobs ad
			if ($cat_2 == 31) // Vacancies
				return View::make('front.ad.add_body.job_vacance', $ar);
			if ($cat_2 == 32) // Jobs abroad
				return View::make('front.ad.add_body.job_abroad', $ar);
			if ($cat_2 == 33) // CV
				return View::make('front.ad.add_body.job_cv', $ar);
        }
        else if ($cat_1 == 4) { // Services ad
			return View::make('front.ad.add_body.clean_template_empty', $ar);
        }
        else if ($cat_1 == 5) { // Consumer Goods ad
			if ($cat_2 == 77) // Collecting & Antiquess
				return View::make('front.ad.add_body.consumer_good_coll_antiq', $ar);
			
			if ($cat_2 == 78)// pets
				return View::make('front.ad.add_body.consumer_good_pet', $ar);
				
			if ($cat_2 == 80)// Clothes
				return View::make('front.ad.add_body.consumer_good_clothes', $ar);
				
			if ($cat_2 == 81)// Shoes
				return View::make('front.ad.add_body.consumer_good_shoe', $ar);
			
			if (in_array($cat_2, array(87, 86, 88, 92, 89))) // Beauty / Men's grooming / Health Care / Gifts & Souvenirs  / Food & Beverage
				return View::make('front.ad.add_body.clean_template_full', $ar);
				
			
			return View::make('front.ad.add_body.consumer_good', $ar);
        }
        else if ($cat_1 == 6) { // Business ad
			if ($cat_2 == 93) // Business for sale
				return View::make('front.ad.add_body.clean_template_half', $ar);
			
			if ($cat_2 == 94) // Partnership
				return View::make('front.ad.add_body.clean_template_empty', $ar);
			
			if ($cat_2 == 95) // Startup & Investment
				return View::make('front.ad.add_body.clean_template', $ar);
			
			if ($cat_2 == 96) // Franchising
				return View::make('front.ad.add_body.clean_template', $ar);
			
			if ($cat_2 == 97) // Distirbutorship
				return View::make('front.ad.add_body.distirbutorship', $ar);
        }
        else if ($cat_1 == 7) { // Equipments and Materials  ad
			return View::make('front.ad.add_body.consumer_good', $ar);
        }
        else if ($cat_1 == 8) { // Events and  Exebitions ad
			return View::make('front.ad.add_body.event', $ar);
        }
        else if ($cat_1 == 9) { // Found and lost ad
			return View::make('front.ad.add_body.found_lost', $ar);
        }

		return View::make('front.ad.add_body.clean_template', $ar);
    }

    private function generateAdBodyTitle ($ar) {
        $cat_1 = SysAdvertCat::findOrFail($ar['cat_1']);
        $cat_2 = SysAdvertCat::find($ar['cat_2']);
        $cat_3 = SysAdvertCat::find($ar['cat_3']);
        $cat_4 = SysAdvertCat::find($ar['cat_4']);

        $title = array();
        if ($cat_1)
            $title[] = $cat_1->name;
        if ($cat_2)
            $title[] = $cat_2->name;
        if ($cat_3)
            $title[] = $cat_3->name;
        if ($cat_4)
            $title[] = $cat_4->name;

        $ar['cat_1_model'] = $cat_1;
        $ar['cat_2_model'] = $cat_2;
        $ar['cat_3_model'] = $cat_3;
        $ar['cat_4_model'] = $cat_4;
        $ar['title'] = implode(" / ", $title);

        return $ar;
    }

    private function generateOptions ($ar) {
        $where = array();
        if ($ar['cat_1_model'])
            $where['cat1_id'] = $ar['cat_1'];

        if ($ar['cat_2_model'])
            $where['cat2_id'] = $ar['cat_2'];


        $ar['props'] = SysAdvertProp::get()->keyBy('id');

        return $ar;
    }

    function postAdd () {
        $input = Input::all();
		//echo '<pre>'; print_r($input); echo '</pre>'; exit();
        
        $user = Auth::user();
        DB::beginTransaction();

        $advert = new Advert();
		if (!Input::has('title') && Input::has('car_type_brand') && Input::has('car_type_model') && isset($input['prop']['17'])){
			$brand = SysAdAutoBrand::findOrFail(Input::get('car_type_brand'));
			$model = SysAdAutoModel::findOrFail(Input::get('car_type_model'));
			$advert->title = $brand->name.' '.$model->name.' '.$input['prop']['17'];
		}
		else
			$advert->title = Input::get('title');
		
		if (Input::has('car_type_brand'))
			$advert->auto_brand_id = Input::get('car_type_brand');
		if (Input::has('car_type_model'))
			$advert->auto_model_id = Input::get('car_type_model');
		
		if (Input::has('negotiable'))
			$advert->negotiable = 1;
		if (Input::has('exchange'))
			$advert->exchange = 1;
		if (Input::has('free'))
			$advert->free = 1;
		if (Input::has('city_id'))
			$advert->city_id = Input::get('city_id');
			
		if (Input::has('to_be_discuss'))
			$advert->to_be_discuss = Input::get('to_be_discuss');
			
        $advert->user_type_id = $user->user_type_id;
        $advert->user_id = $user->id;
        $advert->order_number = Input::get('contact_number');
		$advert->address = Input::get('address');
		if (Input::has('youtube_href'))
			$advert->youtube = Input::get('youtube_href');
			
		if (Input::has('ad_main_photo') && Input::get('ad_main_photo'))
			$advert->photo = Input::get('ad_main_photo');
		else if(isset($input['ad_img']) && count($input['ad_img']) > 0)
			$advert->photo = $input['ad_img'][0];
		
		if (Input::has('price'))
			$advert->price = Input::get('price');
		
        $advert->status_id = 1;

        if (!$advert->save()) {
            DB::rollback();
            return Redirect::back()->withErrors($advert->getErrors());
        }

        AdvertCat::create(array('advert_id'=>$advert->id,
                                  'cat1_id'=>Input::get('cat_1'),
                                  'cat2_id'=>Input::get('cat_2'),
                                  'cat3_id'=>Input::get('cat_3'),
                                  'cat4_id'=>Input::get('cat_4')));
								  
		if(isset($input['ad_img']) && count($input['ad_img']) > 0) {
			foreach ($input['ad_img'] as $img) {
				$file = new AdvertFile();
				$file->advert_id = $advert->id;
				$file->file = $img;
				$file->save();
			}

		}
        
        AdvertAbout::create(array(
            'advert_id' => $advert->id,
            'note' => Input::get('note')
        ));

		if(isset($input['prop']) && count($input['prop'])){
			foreach ($input['prop'] as $prop_id => $prop_val) {
				if ($prop_id == 45){
					$prop_val = ModelSnipet::setImage(Input::file('prop.45'), 'company', 'file');
				}
				
				if ($prop_id == 23 ){
					foreach ($prop_val as $sub_prop_val) {
						$prop = new AdvertProp();
						$prop->advert_id = $advert->id;
						$prop->prop_id = $prop_id;
						$prop->option_val = $sub_prop_val;
						$prop->save();
					}
				}
				else {
					$prop = new AdvertProp();
					$prop->advert_id = $advert->id;
					$prop->prop_id = $prop_id;
					$prop->option_val = $prop_val;
					$prop->save();
				}
				
				
				//echo $prop_id.' '.$prop_val;
			}
		}
		
		$advert->setModerator();
		
		//////// платные функции
		if (isset($input['advert_pay'])){
			$user_balans = Budjet::getBudjet($user);
			$costs_pay = AdvertPay::getTypeCostAr();
			
			// обьявление показать зеленым
			if (isset($input['advert_pay']['is_green']) && $input['advert_pay']['is_green']){
				if (($user_balans->total_aed - $costs_pay[1]) < 0)
					break;
					
				$advert->is_green = 1;
				$advert->save();
				
				$pay_green = new AdvertPay();
				$pay_green->advert_id = $advert->id;
				$pay_green->type_id = 1;
				$pay_green->deleted_unix = strtotime("+7 day");
				$pay_green->is_close = 0;
				$pay_green->created_unix = time();
				$pay_green->save();
				
				$user_balans->total_aed = $user_balans->total_aed - $costs_pay[1];
				$user_balans->save();
				
				$budjet_history = new BudjetHistory();
				$budjet_history->user_id = $user->id;
				$budjet_history->budjet_id = $user_balans->id;
				$budjet_history->is_spend = 1;
				$budjet_history->aed = $costs_pay[1];
				$budjet_history->note = 'User make your ad green';
				$budjet_history->type_id = 2;
				$budjet_history->save();
			}
			
			// обьявление показать скидку
			if (isset($input['advert_pay']['is_sale']) && $input['advert_pay']['is_sale'] && isset($input['advert_pay']['price_was']) && isset($input['advert_pay']['price_now']) ){
				if (($user_balans->total_aed - $costs_pay[2]) < 0)
					break;
					
				$advert->discount_was_price = $input['advert_pay']['price_was'];
				$advert->discount_price = $input['advert_pay']['price_now'];
				$advert->is_sale = 1;
				$advert->save();
				
				$pay_sale = new AdvertPay();
				$pay_sale->advert_id = $advert->id;
				$pay_sale->type_id = 2;
				$pay_sale->deleted_unix = strtotime("+7 day");
				$pay_sale->is_close = 0;
				$pay_sale->created_unix = time();
				$pay_sale->save();
				
				$user_balans->total_aed = $user_balans->total_aed - $costs_pay[2];
				$user_balans->save();
				
				$budjet_history = new BudjetHistory();
				$budjet_history->user_id = $user->id;
				$budjet_history->budjet_id = $user_balans->id;
				$budjet_history->is_spend = 1;
				$budjet_history->aed = $costs_pay[2];
				$budjet_history->note = 'User make your ad sale';
				$budjet_history->type_id = 3;
				$budjet_history->save();
			}
			
			// показать urgent или hot deal
			if ((isset($input['advert_pay']['is_urgent']) && $input['advert_pay']['is_urgent']) || (isset($input['advert_pay']['is_hot']) && $input['advert_pay']['is_hot'])){
				// показать urgent
				if (isset($input['advert_pay']['is_urgent']) && $input['advert_pay']['is_urgent']){
					if (($user_balans->total_aed - $costs_pay[4]) < 0)
						break;
					
					$advert->urgent = 1;
					$advert->save();
					
					$pay_sale = new AdvertPay();
					$pay_sale->advert_id = $advert->id;
					$pay_sale->type_id = 4;
					$pay_sale->deleted_unix = strtotime("+7 day");
					$pay_sale->is_close = 0;
					$pay_sale->created_unix = time();
					$pay_sale->save();
					
					$user_balans->total_aed = $user_balans->total_aed - $costs_pay[4];
					$user_balans->save();
					
					$budjet_history = new BudjetHistory();
					$budjet_history->user_id = $user->id;
					$budjet_history->budjet_id = $user_balans->id;
					$budjet_history->is_spend = 1;
					$budjet_history->aed = $costs_pay[4];
					$budjet_history->note = 'User make your ad urgent';
					$budjet_history->type_id = 5;
					$budjet_history->save();
				}
				
				// показать hot deal
				if (isset($input['advert_pay']['is_hot']) && $input['advert_pay']['is_hot']){
					if (($user_balans->total_aed - $costs_pay[3]) < 0)
						break;
						
					$advert->hot_price = 1;
					$advert->save();
					
					$pay_sale = new AdvertPay();
					$pay_sale->advert_id = $advert->id;
					$pay_sale->type_id = 3;
					$pay_sale->deleted_unix = strtotime("+7 day");
					$pay_sale->is_close = 0;
					$pay_sale->created_unix = time();
					$pay_sale->save();
					
					$user_balans->total_aed = $user_balans->total_aed - $costs_pay[3];
					$user_balans->save();
					
					$budjet_history = new BudjetHistory();
					$budjet_history->user_id = $user->id;
					$budjet_history->budjet_id = $user_balans->id;
					$budjet_history->is_spend = 1;
					$budjet_history->aed = $costs_pay[3];
					$budjet_history->note = 'User make your ad hot deal';
					$budjet_history->type_id = 4;
					$budjet_history->save();
				}
				
			}
			
			if (isset($input['advert_pay']['is_vip']) && $input['advert_pay']['is_vip'] && isset($input['advert_pay']['vip_count']) ){
				if (($user_balans->total_aed - ($costs_pay[5] * $input['advert_pay']['vip_count'])) < 0)
					break;
					
				$advert->vip = 1;
				$advert->is_vip_counter = $input['advert_pay']['vip_count'];
				$advert->save();
				
				$pay_sale = new AdvertPay();
				$pay_sale->advert_id = $advert->id;
				$pay_sale->type_id = 5;
				$pay_sale->deleted_unix = strtotime("+7 day");
				$pay_sale->is_close = 0;
				$pay_sale->created_unix = time();
				$pay_sale->save();
				
				$user_balans->total_aed = $user_balans->total_aed - ($costs_pay[5] * $input['advert_pay']['vip_count']);
				$user_balans->save();
				
				$budjet_history = new BudjetHistory();
				$budjet_history->user_id = $user->id;
				$budjet_history->budjet_id = $user_balans->id;
				$budjet_history->is_spend = 1;
				$budjet_history->aed =  $costs_pay[5] * $input['advert_pay']['vip_count'];
				$budjet_history->note = 'User make your ad vip';
				$budjet_history->type_id = 6;
				$budjet_history->save();
			}
		}
		
		DB::commit();
        

        return Redirect::back()->with('success', 'Congratulations! Your ad done successful');
    }

	function postLike(){
		$advert = Advert::find(Input::get('id'));
		if (!$advert)
			return '0';
		$advert->setLike();
		
		return $advert->count_likes;
	}
	
	function postDislike () {
		$advert = Advert::find(Input::get('id'));
		if (!$advert)
			return '0';
			
		$advert->deleteLike();
		
		return $advert->count_likes;
	}
	
	/*function postUpdateDialog(){
		if (!Auth::check())
			return Redirect::back()->with('error', 'Please, sign in to edit your article');
		
		$advert_id = Input::get('advert_id');
		$user = Auth::user();
		$advert = Advert::where(array('user_id'=>$user->id, 'id'=>$advert_id))->first();
		
		if (!$advert)
			return '0';
			
		$advert_cat = AdvertCat::where('advert_id', $advert->id)->first();
			
		$ar = array();
		$ar['advert'] = $advert;
		$ar['about'] = $advert->relAbout;
		$ar['photos'] = AdvertFile::where('advert_id', $advert->id)->get();
		$ar['ar_city'] = SysCity::lists('name', 'id');
		$ar['advert_cat'] = $advert_cat;
		$ar['ar_brand'] = SysAdAutoBrand::lists('name', 'id');
		$ar['ar_model'] = SysAdAutoModel::where('brand_id', $advert->auto_brand_id)->lists('name', 'id');
		$ar['ar_year'] = array();
		for ($i = 1900; $i <= 2018; $i++) {
			$ar['ar_year'][$i] = $i;
		}
		krsort($ar['ar_year']);
		$ar['sys_props'] = SysAdvertProp::all();
		$ar['adv_props'] = AdvertProp::where('advert_id', $advert->id)->lists('option_val', 'prop_id');
		$ar['cat_props'] = $this->generatePropAr($advert_cat);
		
		$ar['price_option'] = $this->generatePriceOption($advert_cat);
		
		return View::make('front.ad.edit_dialog', $ar);
	}*/
    function postUpdateDialog() {
        if (!Auth::check())
            return Redirect::back()->with('error', 'Please, sign in to edit your article');

        $advert_id = Input::get('advert_id');
        $user = Auth::user();
        $advert = Advert::where(array('user_id'=>$user->id, 'id'=>$advert_id))->first();

        $advert_cat = AdvertCat::where(array('advert_id'=>$advert_id))->first();
        $advert_propsOb = AdvertProp::where(array('advert_id'=>$advert_id))->get();
        $advert_props = array();
        foreach($advert_propsOb as $ad_prop){
            $advert_props[$ad_prop->prop_id][] = $ad_prop->option_val;
        }

        $ar = array();

        $ar['advert'] = $advert;
        $ar['advert_props'] = $advert_props;
        $ar['photos'] = AdvertFile::where('advert_id', $advert->id)->get();
        $ar['about'] = AdvertAbout::where('advert_id', $advert->id)->first();

        $ar['cat_1'] = $advert_cat->cat1_id;
        $ar['cat_2'] = $advert_cat->cat2_id;
        $ar['cat_3'] = $advert_cat->cat3_id;
        $ar['cat_4'] = $advert_cat->cat4_id;

        $cat_1 = $advert_cat->cat1_id;
        $cat_2 = $advert_cat->cat2_id;
        $cat_3 = $advert_cat->cat3_id;
        $cat_4 = $advert_cat->cat4_id;

        $ar = $this->generateAdBodyTitle($ar);
        $ar = $this->generateOptions($ar);

        if ($cat_1 == 1) { // property ad
            if ($cat_2 == 10) { // Property for sale
                if ($cat_3 == 23) // Residential
                    return View::make('front.ad.add_body.property_sale_residential', $ar);
                if ($cat_3 == 24) // Commercial
                    return View::make('front.ad.add_body.property_sale_commercial', $ar);
                if ($cat_3 == 25) // Land
                    return View::make('front.ad.add_body.property_sale_commercial', $ar);
                if ($cat_3 == 26) // Property Abroad
                    return View::make('front.ad.add_body.property_sale_abroad', $ar);
            }
            else if ($cat_2 == 16) { // Property for rent
                //if ($cat_3 == 27) // Residential
                //return View::make('front.ad.add_body.property_rent_residential', $ar);
                if ($cat_3 == 27) {
                    if (in_array($cat_4, array(125, 912))) // rooms villa, rooms apartment
                        return View::make('front.ad.add_body.property_rent_residential_rooms', $ar);
                    else
                        return View::make('front.ad.add_body.property_rent_residential', $ar);
                }

                if ($cat_3 == 28) // Commercial
                    return View::make('front.ad.add_body.property_rent_commercial', $ar);

                if ($cat_3 == 29) // Property Abroad
                    return View::make('front.ad.add_body.property_rent_abroad', $ar);
            }
        }
        else if ($cat_1 == 2) { // auto ad
            $ar['ar_auto_brands'] = SysAdAutoBrand::orderBy('name', 'asc')->get();
            $ar['ar_auto_models'] = SysAdAutoModel::where(array('brand_id'=>$advert->auto_brand_id))->get();
            $ar['ar_year'] = array();
            for ($i = 1900; $i <= 2018; $i++) {
                $ar['ar_year'][$i] = $i;
            }
            krsort($ar['ar_year']);

            if ($cat_2 == 17){// Auto sale
                if ($cat_3 == 30) // car
                    return View::make('front.ad.add_body.car_sale', $ar);
                if ($cat_3 == 138) // Buses
                    return View::make('front.ad.add_body.car_sale_bus', $ar);
                if ($cat_3 == 139) // Campers
                    return View::make('front.ad.add_body.car_sale_campers', $ar);
                if ($cat_3 == 140)  // Motorbikes
                    return View::make('front.ad.add_body.car_sale_motorbike', $ar);
                if ($cat_3 == 141) // Water transports
                    return View::make('front.ad.add_body.car_sale_water_trans', $ar);
                if ($cat_3 == 142) // Trucks
                    return View::make('front.ad.add_body.car_sale_trucks', $ar);
                if ($cat_3 == 143) // Heavy & Construction Vehicles
                    return View::make('front.ad.add_body.car_sale_heavy', $ar);
                if ($cat_3 == 144) // Planes & Helicopters
                    return View::make('front.ad.add_body.car_sale_planes', $ar);
            }

            if ($cat_2 == 18) // Parking
                return View::make('front.ad.add_body.clean_template', $ar);

            if ($cat_2 == 19) // Plates
                return View::make('front.ad.add_body.clean_template_full', $ar);

            if ($cat_2 == 20) // Auto rent
                return View::make('front.ad.add_body.car_rent', $ar);

            if ($cat_2 == 21){// Auto parts
                if ($cat_3 == 151) // Car Parts
                    return View::make('front.ad.add_body.car_part', $ar);
                if ($cat_3 == 152) // Motorbike & Bike Parts
                    return View::make('front.ad.add_body.car_part_bus', $ar);
                if ($cat_3== 153) // Buses part
                    return View::make('front.ad.add_body.car_part_bus', $ar);
                if ($cat_3 == 156) // Trucks parts
                    return View::make('front.ad.add_body.car_part_bus', $ar);

                if ($cat_3 == 154) // water transport
                    return View::make('front.ad.add_body.car_part_water_transport', $ar);
                if ($cat_3 == 155) // Planes & Helicopters
                    return View::make('front.ad.add_body.car_part_water_transport', $ar);
                if ($cat_3 == 157) // Heavy & Construction Vehicles Parts
                    return View::make('front.ad.add_body.car_part_water_transport', $ar);

                return View::make('front.ad.add_body.car_part', $ar);
            }

            if ($cat_2 == 22) // Auto repair
                return View::make('front.ad.add_body.clean_template', $ar);

        }
        else if ($cat_1 == 3) { // Jobs ad
            if ($cat_2 == 31) // Vacancies
                return View::make('front.ad.add_body.job_vacance', $ar);
            if ($cat_2 == 32) // Jobs abroad
                return View::make('front.ad.add_body.job_abroad', $ar);
            if ($cat_2 == 33) // CV
                return View::make('front.ad.add_body.job_cv', $ar);
        }
        else if ($cat_1 == 4) { // Services ad
            return View::make('front.ad.add_body.clean_template_empty', $ar);
        }
        else if ($cat_1 == 5) { // Consumer Goods ad
            if ($cat_2 == 77) // Collecting & Antiquess
                return View::make('front.ad.add_body.consumer_good_coll_antiq', $ar);

            if ($cat_2 == 78)// pets
                return View::make('front.ad.add_body.consumer_good_pet', $ar);

            if ($cat_2 == 80)// Clothes
                return View::make('front.ad.add_body.consumer_good_clothes', $ar);

            if ($cat_2 == 81)// Shoes
                return View::make('front.ad.add_body.consumer_good_shoe', $ar);

            if (in_array($cat_2, array(87, 86, 88, 92, 89))) // Beauty / Men's grooming / Health Care / Gifts & Souvenirs  / Food & Beverage
                return View::make('front.ad.add_body.clean_template_full', $ar);


            return View::make('front.ad.add_body.consumer_good', $ar);
        }
        else if ($cat_1 == 6) { // Business ad
            if ($cat_2 == 93) // Business for sale
                return View::make('front.ad.add_body.clean_template_half', $ar);

            if ($cat_2 == 94) // Partnership
                return View::make('front.ad.add_body.clean_template_empty', $ar);

            if ($cat_2 == 95) // Startup & Investment
                return View::make('front.ad.add_body.clean_template', $ar);

            if ($cat_2 == 96) // Franchising
                return View::make('front.ad.add_body.clean_template', $ar);

            if ($cat_2 == 97) // Distirbutorship
                return View::make('front.ad.add_body.distirbutorship', $ar);
        }
        else if ($cat_1 == 7) { // Equipments and Materials  ad
            return View::make('front.ad.add_body.consumer_good', $ar);
        }
        else if ($cat_1 == 8) { // Events and  Exebitions ad
            return View::make('front.ad.add_body.event', $ar);
        }
        else if ($cat_1 == 9) { // Found and lost ad
            return View::make('front.ad.add_body.found_lost', $ar);
        }

        return View::make('front.ad.add_body.clean_template', $ar);
    }

	private function generatePropAr($advert_cat){
		$ar = array();
		if ($advert_cat->cat1_id == 1) { // property ad
			if ($advert_cat->cat2_id == 10) { // Property for sale
				if ($advert_cat->cat3_id == 23) // Residential
					$ar = array(26, 30, 27, 31, 28, 29);
				else if ($advert_cat->cat3_id == 24) // Commercial
					$ar = array(27);
				else if ($advert_cat->cat3_id == 25) // Land
					$ar = array(27);
				else if ($advert_cat->cat3_id == 26) // Property Abroad
					$ar = array(26, 30, 27, 31, 28, 29);
			}
			else if ($advert_cat->cat2_id == 16) { // Property for rent
				if ($advert_cat->cat3_id == 27) // Residential
					$ar = array(33, 34, 27, 26); 
				else if ($advert_cat->cat3_id == 28) // Commercial
					$ar = array(33, 27, 34);  
				else if ($advert_cat->cat3_id == 29) // Property Abroad
					$ar = array(33, 26, 30, 27, 31, 28, 29); 
			} 
        }
        else if ($advert_cat->cat1_id == 2) { // auto ad
			if ($advert_cat->cat2_id == 17){// Auto sale
				if ($advert_cat->cat3_id == 30) // car 
					$ar = array(6, 7, 8, 9, 10, 11, 12, 13, 14, 15); 
				else if ($advert_cat->cat3_id == 138) // Buses 
					$ar = array(18, 8, 14, 7, 11, 15, 13);
				else if ($advert_cat->cat3_id == 139) // Campers 
					$ar = array(17, 8, 11, 15, 13);
				else if ($advert_cat->cat3_id == 140) // Motorbikes 
					$ar = array(8, 12, 7, 9, 11, 15, 13);
				else if ($advert_cat->cat3_id == 141) // Water transports 
					$ar = array(17, 21, 11, 13);
				else if ($advert_cat->cat3_id == 142) // Trucks 
					$ar = array(8, 14, 7, 9, 11, 15, 13);
				else if ($advert_cat->cat3_id == 143) // Heavy & Construction Vehicles 
					$ar = array(17, 11, 13);
				else if ($advert_cat->cat3_id == 144) // Planes & Helicopters
					$ar = array(17, 11, 13, 15);
			} 
			
			if ($advert_cat->cat2_id == 18) // Parking
				$ar = array();
				
			if ($advert_cat->cat2_id == 19) // Plates
				$ar = array();
			
            if ($advert_cat->cat2_id == 20) // Auto rent
                $ar = array(4, 5);
				
			if ($advert_cat->cat2_id == 21){// Auto parts
				if ($advert_cat->cat3_id == 151) // Car Parts
					$ar = array(13, 'special_title');
				else if ($advert_cat->cat3_id == 152) // Motorbike & Bike Parts
					$ar = array(13, 'special_title');
				else if ($advert_cat->cat3_id == 153) // Buses part
					$ar = array(13, 'special_title');
				else if ($advert_cat->cat3_id == 156) // Trucks parts
					$ar = array(13, 'special_title');
				else if ($advert_cat->cat3_id == 154) // water transport
					$ar = array(13);
				else if ($advert_cat->cat3_id == 155) // Planes & Helicopters
					$ar = array(13);
				else if ($advert_cat->cat3_id == 157) // Heavy & Construction Vehicles Parts
					$ar = array(13);
			} 
			
			if ($advert_cat->cat2_id == 22) // Auto repair
				$ar = array();
				
        }
        else if ($advert_cat->cat1_id == 3) { // Jobs ad
			if ($advert_cat->cat2_id == 31) // Vacancies
				$ar = array(46, 47, 48, 49, 50, 'price_false');
			else if ($advert_cat->cat2_id == 32) // Jobs abroad
				$ar = array(46, 47, 48, 49, 50, 'price_false');
			else if ($advert_cat->cat2_id == 33) // CV
				$ar = array(35, 36, 37, 38, 41, 39, 42, 40, 43, 44, 45, 'price_false', 'galarea_false', 'youtube_false');
        }
        else if ($advert_cat->cat1_id == 4) { // Services ad
			$ar = array();
        }
        else if ($advert_cat->cat1_id == 5) { // Consumer Goods ad
			if ($advert_cat->cat2_id == 77) // Collecting & Antiquess
				$ar = array(13); 
			else if ($advert_cat->cat2_id == 78)// pets
				$ar = array(22); 	
			else if ($advert_cat->cat2_id == 80)// Clothes
				$ar = array(13, 23);
			else if ($advert_cat->cat2_id == 81)// Shoes
				$ar = array(13, 24);
			else if (in_array($advert_cat->cat2_id, array(87, 86, 88, 92, 89))) // Beauty / Men's grooming / Health Care / Gifts & Souvenirs  / Food & Beverage
				$ar = array();
			else 
				$ar = array(13);
        }
        else if ($advert_cat->cat1_id == 6) { // Business ad
			if ($advert_cat->cat2_id == 93) // Business for sale
				$ar = array();
			
			if ($advert_cat->cat2_id == 94) // Partnership
				$ar = array();
			
			if ($advert_cat->cat2_id == 95) // Startup & Investment
				$ar = array();
			
			if ($advert_cat->cat2_id == 96) // Franchising
				$ar = array();
			
			if ($advert_cat->cat2_id == 97) // Distirbutorship
				$ar = array('price_false');
        }
        else if ($advert_cat->cat1_id == 7) { // Equipments and Materials  ad
			$ar = array(13);
        }
        else if ($advert_cat->cat1_id == 8) { // Events and  Exebitions ad
			$ar = array(51);
        }
        else if ($advert_cat->cat1_id == 9) { // Found and lost ad
			$ar = array(25, 'price_false');
        }
		
		return $ar;
	}
	
	private function generatePriceOption($advert_cat){
		$ar = array(
			'urgent' => false,
			'hot_price' => false,
			'negotiable' => false,
			'exchange' => false,
			'free' => false
		);
		
		if ($advert_cat->cat1_id == 1) { // property ad
			if ($advert_cat->cat2_id == 10) { // Property for sale
				if ($advert_cat->cat3_id == 23){ // Residential
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
				}
				if ($advert_cat->cat3_id == 24){ // Commercial
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
				}
				if ($advert_cat->cat3_id == 25){  // Land
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
				}
				if ($advert_cat->cat3_id == 26){ // Property Abroad
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
				}
			}
			else if ($advert_cat->cat2_id == 16) { // Property for rent
				if ($advert_cat->cat3_id == 27) // Residential
					$ar['negotiable'] = true; 
				if ($advert_cat->cat3_id == 28) // Commercial
					$ar['negotiable'] = true; 
				if ($advert_cat->cat3_id == 29){ // Property Abroad
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
				}
			} 
        }
        else if ($advert_cat->cat1_id == 2) { // auto ad
			if ($advert_cat->cat2_id == 17){// Auto sale
				if ($advert_cat->cat3_id == 30){ // car 
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
				if ($advert_cat->cat3_id == 138){ // Buses 
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
				if ($advert_cat->cat3_id == 139){ // Campers 
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
				if ($advert_cat->cat3_id == 140){ // Motorbikes 
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
				if ($advert_cat->cat3_id == 141){ // Water transports 
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
				if ($advert_cat->cat3_id == 142){ // Trucks 
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
				if ($advert_cat->cat3_id == 143){ // Heavy & Construction Vehicles 
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
				if ($advert_cat->cat3_id == 144){ // Planes & Helicopters
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
			} 
			
			if ($advert_cat->cat2_id == 18) // Parking
				$ar['negotiable'] = true;
				
			if ($advert_cat->cat2_id == 19){ // Plates
				$ar['negotiable'] = true;
				$ar['exchange'] = true;
				$ar['free'] = true;
			}
			
            if ($advert_cat->cat2_id == 20) // Auto rent
                $ar['negotiable'] = true;
				
			if ($advert_cat->cat2_id == 21){// Auto parts
				if ($advert_cat->cat3_id == 151){ // Car Parts
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
				else if ($advert_cat->cat3_id == 152){ // Motorbike & Bike Parts
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
				else if ($advert_cat->cat3_id == 153){ // Buses part
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
				else if ($advert_cat->cat3_id == 156){ // Trucks parts
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
				else if ($advert_cat->cat3_id == 154){ // water transport
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
				else if ($advert_cat->cat3_id == 155){ // Planes & Helicopters
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
				else if ($advert_cat->cat3_id == 157){ // Heavy & Construction Vehicles Parts
					$ar['negotiable'] = true;
					$ar['exchange'] = true;
					$ar['free'] = true;
				}
			} 
			
			if ($advert_cat->cat2_id == 22) // Auto repair
				$ar['negotiable'] = true;
        }
        else if ($advert_cat->cat1_id == 3) { // Jobs ad
			if ($advert_cat->cat2_id == 31) // Vacancies
				$ar['negotiable'] = false;
			if ($advert_cat->cat2_id == 32) // Jobs abroad
				$ar['negotiable'] = false;
			if ($advert_cat->cat2_id == 33) // CV
				$ar['negotiable'] = false;
        }
        else if ($advert_cat->cat1_id == 4) { // Services ad
			$ar['negotiable'] = false;
        }
        else if ($advert_cat->cat1_id == 5) { // Consumer Goods ad
			if ($advert_cat->cat2_id == 77){ // Collecting & Antiquess
				$ar['negotiable'] = true;
				$ar['exchange'] = true;
				$ar['free'] = true;
			}
			else if ($advert_cat->cat2_id == 78){// pets
				$ar['negotiable'] = true;
				$ar['exchange'] = true;
				$ar['free'] = true;
			}
			else if ($advert_cat->cat2_id == 80){// Clothes
				$ar['negotiable'] = true;
				$ar['exchange'] = true;
				$ar['free'] = true;
			}
			else if ($advert_cat->cat2_id == 81){// Shoes
				$ar['negotiable'] = true;
				$ar['exchange'] = true;
				$ar['free'] = true;
			}
			else {
				$ar['negotiable'] = true;
				$ar['exchange'] = true;
				$ar['free'] = true;
			}
			//return View::make('front.ad.add_body.consumer_good', $ar);
        }
        else if ($advert_cat->cat1_id == 6) { // Business ad
			if ($advert_cat->cat2_id == 93){ // Business for sale
				$ar['negotiable'] = true;
				$ar['exchange'] = true;
			}
			if ($advert_cat->cat2_id == 94) // Partnership
				$ar['negotiable'] = false;
			if ($advert_cat->cat2_id == 95) // Startup & Investment
				$ar['negotiable'] = true;
			if ($advert_cat->cat2_id == 96) // Franchising
				$ar['negotiable'] = true;
			if ($advert_cat->cat2_id == 97) // Distirbutorship
				$ar['negotiable'] = false;
        }
        else if ($advert_cat->cat1_id == 7) { // Equipments and Materials  ad
			$ar['negotiable'] = true;
			$ar['exchange'] = true;
			$ar['free'] = true;
        }
        else if ($advert_cat->cat1_id == 8) { // Events and  Exebitions ad
			$ar['free'] = true;
        }
        else if ($advert_cat->cat1_id == 9) { // Found and lost ad
			$ar['free'] = false;
        }
		
		return $ar;
		
	}
	
	function postUpdate()
    {
        if (!Auth::check())
            return Redirect::back()->with('error', 'Please, sign in to edit your article');

        $advert_id = Input::get('advert_id');
        $user = Auth::user();
        $advert = Advert::where(array('user_id' => $user->id, 'id' => $advert_id))->first();

        if (!$advert)
            App::abort(404);

        DB::beginTransaction();
        $input = Input::all();

        if (!Input::has('title') && Input::has('car_type_brand') && Input::has('car_type_model') && isset($input['prop']['17'])){
            $brand = SysAdAutoBrand::findOrFail(Input::get('car_type_brand'));
            $model = SysAdAutoModel::findOrFail(Input::get('car_type_model'));
            $advert->title = $brand->name.' '.$model->name.' '.$input['prop']['17'];
        }
        else
            $advert->title = Input::get('title');

        if (Input::has('car_type_brand'))
            $advert->auto_brand_id = Input::get('car_type_brand');
        if (Input::has('car_type_model'))
            $advert->auto_model_id = Input::get('car_type_model');

        if (Input::has('negotiable') && Input::get('negotiable'))
            $advert->negotiable = 1;
        else
            $advert->negotiable = 0;
        if (Input::has('exchange') && Input::get('exchange'))
            $advert->exchange = 1;
        else
            $advert->exchange = 0;
        if (Input::has('free') && Input::get('free'))
            $advert->free = 1;
        else
            $advert->free = 0;
        if (Input::has('city_id') && Input::get('city_id'))
            $advert->city_id = Input::get('city_id');

        $advert->address = Input::get('address');
        $advert->youtube = Input::get('youtube');

        if (isset($input['ad_img']) && count($input['ad_img']) > 0)
            $advert->photo = $input['ad_img'][0];
        else
            $advert->photo = null;
        if (Input::has('contact_number'))
            $advert->order_number = Input::get('contact_number');
        if (Input::has('price'))
            $advert->price = Input::get('price');


        AdvertFile::where('advert_id', $advert->id)->delete();
        if (isset($input['ad_img']) && count($input['ad_img']) > 0) {
            foreach ($input['ad_img'] as $img) {
                $file = new AdvertFile();
                $file->advert_id = $advert->id;
                $file->file = $img;
                $file->save();
            }

        }

        $about = AdvertAbout::where('advert_id', $advert->id)->first();
        if (!$about) {
            $about = new AdvertAbout();
            $about->advert_id = $advert->id;
        }
        $about->note = Input::get('note');
        $about->save();

        AdvertProp::where('advert_id', $advert->id)->delete();
        if (isset($input['prop']) && count($input['prop'])) {
            foreach ($input['prop'] as $prop_id => $prop_val) {
                $prop = new AdvertProp();
                $prop->advert_id = $advert->id;
                $prop->prop_id = $prop_id;
                $prop->option_val = $prop_val;
                $prop->save();
            }
        }

        //////// платные функции
        if (isset($input['advert_pay'])) {
            $user_balans = Budjet::getBudjet($user);
            $costs_pay = AdvertPay::getTypeCostAr();

            // обьявление показать зеленым
            if (isset($input['advert_pay']['is_green']) && $input['advert_pay']['is_green']) {
                if (($user_balans->total_aed - $costs_pay[1]) < 0)
                    break;

                $advert->is_green = 1;

                $pay_green = new AdvertPay();
                $pay_green->advert_id = $advert->id;
                $pay_green->type_id = 1;
                $pay_green->deleted_unix = strtotime("+7 day");
                $pay_green->is_close = 0;
                $pay_green->created_unix = time();
                $pay_green->save();

                $user_balans->total_aed = $user_balans->total_aed - $costs_pay[1];
                $user_balans->save();

                $budjet_history = new BudjetHistory();
                $budjet_history->user_id = $user->id;
                $budjet_history->budjet_id = $user_balans->id;
                $budjet_history->is_spend = 1;
                $budjet_history->aed = $costs_pay[1];
                $budjet_history->note = 'User make your ad green';
                $budjet_history->type_id = 2;
                $budjet_history->save();
            } else {
                $advert->is_green = 0;
            }

            // обьявление показать скидку
            if (isset($input['advert_pay']['is_sale']) && $input['advert_pay']['is_sale'] && isset($input['advert_pay']['price_was']) && isset($input['advert_pay']['price_now'])) {
                if (($user_balans->total_aed - $costs_pay[2]) < 0)
                    break;

                $advert->discount_was_price = $input['advert_pay']['price_was'];
                $advert->discount_price = $input['advert_pay']['price_now'];
                $advert->is_sale = 1;

                $pay_sale = new AdvertPay();
                $pay_sale->advert_id = $advert->id;
                $pay_sale->type_id = 2;
                $pay_sale->deleted_unix = strtotime("+7 day");
                $pay_sale->is_close = 0;
                $pay_sale->created_unix = time();
                $pay_sale->save();

                $user_balans->total_aed = $user_balans->total_aed - $costs_pay[2];
                $user_balans->save();

                $budjet_history = new BudjetHistory();
                $budjet_history->user_id = $user->id;
                $budjet_history->budjet_id = $user_balans->id;
                $budjet_history->is_spend = 1;
                $budjet_history->aed = $costs_pay[2];
                $budjet_history->note = 'User make your ad sale';
                $budjet_history->type_id = 3;
                $budjet_history->save();
            } elseif (empty($input['advert_pay']['is_sale'])) {
                $advert->is_sale = 0;
            }

            if (empty($input['advert_pay']['is_urgent'])) {
                $advert->urgent = 0;
            }
            // показать urgent или hot deal
            if ((isset($input['advert_pay']['is_urgent']) && $input['advert_pay']['is_urgent']) || (isset($input['advert_pay']['is_hot']) && $input['advert_pay']['is_hot'])) {
                // показать urgent
                if (isset($input['advert_pay']['is_urgent']) && $input['advert_pay']['is_urgent']) {
                    if (($user_balans->total_aed - $costs_pay[4]) < 0)
                        break;

                    $advert->urgent = 1;

                    $pay_sale = new AdvertPay();
                    $pay_sale->advert_id = $advert->id;
                    $pay_sale->type_id = 4;
                    $pay_sale->deleted_unix = strtotime("+7 day");
                    $pay_sale->is_close = 0;
                    $pay_sale->created_unix = time();
                    $pay_sale->save();

                    $user_balans->total_aed = $user_balans->total_aed - $costs_pay[4];
                    $user_balans->save();

                    $budjet_history = new BudjetHistory();
                    $budjet_history->user_id = $user->id;
                    $budjet_history->budjet_id = $user_balans->id;
                    $budjet_history->is_spend = 1;
                    $budjet_history->aed = $costs_pay[4];
                    $budjet_history->note = 'User make your ad urgent';
                    $budjet_history->type_id = 5;
                    $budjet_history->save();
                }

            }



            // показать hot deal
            if (isset($input['advert_pay']['is_hot']) && $input['advert_pay']['is_hot']) {
                if (($user_balans->total_aed - $costs_pay[3]) < 0)
                    break;

                $advert->hot_price = 1;

                $pay_sale = new AdvertPay();
                $pay_sale->advert_id = $advert->id;
                $pay_sale->type_id = 3;
                $pay_sale->deleted_unix = strtotime("+7 day");
                $pay_sale->is_close = 0;
                $pay_sale->created_unix = time();
                $pay_sale->save();

                $user_balans->total_aed = $user_balans->total_aed - $costs_pay[3];
                $user_balans->save();

                $budjet_history = new BudjetHistory();
                $budjet_history->user_id = $user->id;
                $budjet_history->budjet_id = $user_balans->id;
                $budjet_history->is_spend = 1;
                $budjet_history->aed = $costs_pay[3];
                $budjet_history->note = 'User make your ad hot deal';
                $budjet_history->type_id = 4;
                $budjet_history->save();
            }
            elseif (empty($input['advert_pay']['is_hot'])) {
                $advert->hot_price = 0;
            }


        if (isset($input['advert_pay']['is_vip']) && $input['advert_pay']['is_vip'] && isset($input['advert_pay']['vip_count'])) {
            if (($user_balans->total_aed - ($costs_pay[5] * $input['advert_pay']['vip_count'])) < 0)
                return Redirect::back()->withErrors('Sorry, you don\'t have enough money!');

            $advert->vip = 1;
            $advert->is_vip_counter = $input['advert_pay']['vip_count'];

            $pay_sale = new AdvertPay();
            $pay_sale->advert_id = $advert->id;
            $pay_sale->type_id = 5;
            $pay_sale->deleted_unix = strtotime("+7 day");
            $pay_sale->is_close = 0;
            $pay_sale->created_unix = time();
            $pay_sale->save();

            $user_balans->total_aed = $user_balans->total_aed - ($costs_pay[5] * $input['advert_pay']['vip_count']);
            $user_balans->save();

            $budjet_history = new BudjetHistory();
            $budjet_history->user_id = $user->id;
            $budjet_history->budjet_id = $user_balans->id;
            $budjet_history->is_spend = 1;
            $budjet_history->aed = $costs_pay[5] * $input['advert_pay']['vip_count'];
            $budjet_history->note = 'User make your ad vip';
            $budjet_history->type_id = 6;
            $budjet_history->save();
        } elseif (empty($input['advert_pay']['is_vip'])) {
            $advert->vip = 0;
        }
    }

        if (!$advert->save()) {
            DB::rollback();
            return Redirect::back()->withErrors($advert->getErrors());
        }
		DB::commit();
		
        return Redirect::back()->with('success', 'Congratulations! Your ad done successful');
	}
	
	function getDelete($advert_id){
		if (!Auth::check())
			return Redirect::back()->with('error', 'Please, sign in to edit your article');
		
		$user = Auth::user();
		$advert = Advert::where(array('user_id'=>$user->id, 'id'=>$advert_id))->first();
		
		if (!$advert)
			App::abort(404);
		$advert->delete();
		
		 /*return Redirect::back()->with('success', 'Congratulations! Your ad deleted successful');*/
	}
	
	function postDelete(){
		if (!Auth::check())
			return '0';
		
		$user = Auth::user();
		$advert = Advert::where(array('user_id'=>$user->id, 'id'=>Input::get('advert_id')))->first();
		
		if (!$advert)
			return '0';
		
		$advert->delete();
		
		return '1';
	}
	
	function getReAdd($advert_id){
		if (!Auth::check())
			return Redirect::back()->with('error', 'Please, sign in to edit your article');
			
		$user = Auth::user();
		$advert = Advert::where(array('user_id'=>$user->id, 'id'=>$advert_id))->first();
		
		if (!$advert)
			App::abort(404);
		
		$time =  time() - (48 * 60 * 60);
		if ($advert->created_unix > $time)
			return Redirect::back()->with('error', '<center>Sorry, you may refresh your ad after 48 hours,</center><center>since it was placed/since last update</center>');
		
		$advert->ololo_for_ololo_very_important_note_delete = 0;
		$advert->created_unix = time();
		$advert->is_renew = 1;
		$advert->save();
		
		return Redirect::back()->with('success', '<center>Your ad has been renewed for the next</center><center>30 days.</center> <center>Congratulations!</center>');
	}
	
	function postTop() {
		if (!Auth::check())
			return Redirect::back()->with('error', 'Please, sign in to edit your article');
			
		$user = Auth::user();
		$advert = Advert::where(array('user_id'=>$user->id, 'id'=>$advert_id))->first();
		if (!$advert)
			App::abort(404);
		
		
	}

}
