<?php
class AjaxController extends BaseController {

	public function anyCityByCountry($country_id = 0){
		$res = SysCity::where('country_id', $country_id)->lists('name', 'id');
		echo json_encode($res);
	}

	public function anyCompanyCatByType($type_id = 0){
		$res = SysCompanyCat::where('type_id', $type_id)->lists('name', 'id');
		echo json_encode($res);
	}

	public function anyCompanySubcatByCat($parent_id = 0){
		$res = SysCompanySubcat::where('parent_id', $parent_id)->lists('name', 'id');
		echo json_encode($res);
	}
	
	function anyAdvertCat ($parent_id = 0) {
		$res = SysAdvertCat::where('parent_id', $parent_id)->lists('name', 'id');
		echo json_encode($res);
	}



}
