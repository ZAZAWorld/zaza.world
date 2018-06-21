<?php
class CronTask extends Eloquent {
	protected $table = 'cron_task';
    protected $fillable = array('name', 'created_unix', 'type_id');
	
	public static function boot() {
		$res = parent::boot();
		static::created(function($model){
			$model->setCreatedUnixTime();
			
            return true;
        });
		
		return $res;
	}
	
	function setCreatedUnixTime (){
		$this->created_unix = time();
		$this->save();
	}
	
	static function getStandartTask(){
		return array(
			1 => 'destroy old advert',
			2 => 'company onlain index',
			3 => 'advert pay check',
			4 => 'banner check',
			5 => 'top company'
		);
	}
	
	static function checkBanner(){
		$time = time() - (60 * 60 * 24);
		$ololo_value = static::where('type_id', 4)->where('created_unix', '>', $time)->count();
		if ($ololo_value > 0)
			return true;
			
		$el_type_ar = static::getStandartTask();
		
		$el = new CronTask();
		$el->created_unix = time();
		$el->type_id = 4;
		$el->name = $el_type_ar[4];
		$el->save();
		
		$elems = SysAdBannerPartners::where('status_id', 2)->where('publish_unix', '>', time())->get();
		foreach ($elems as $el) {
			$el->status_id = 4;
			$el->close_unix = time() - (60 * 60 * 24 * $el->days);
			$el->save();
		}
		
		$elems = SysAdBannerPartners::where('status_id', 4)->where('close_unix', '>', time())->get();
		foreach ($elems as $el) {
			$el->status_id = 5;
			$el->save();
		}
	
		
		return true;
		
		
	}
	
	static function checkTopCompany(){
		$time = time() - (59 * 60);
		$ololo_value = static::where('type_id', 5)->where('created_unix', '>', $time)->count();
		if ($ololo_value > 0)
			return true;
		
		$el_type_ar = static::getStandartTask();
		
		$el = new CronTask();
		$el->created_unix = time();
		$el->type_id = 5;
		$el->name = $el_type_ar[5];
		$el->save();
		
		Company::where('is_top', 1)->where('count_top', '<', 1)->update('is_top', 0);
		
		return true;
	}
	
	static function checkAdvertRenewReminder(){
		$time = time() - (60 * 60 * 24);
		$ololo_value = static::where('type_id', 1)->where('created_unix', '>', $time)->count();
		if ($ololo_value > 0)
			return true;
			
		$el_type_ar = static::getStandartTask();
		
		$el = new CronTask();
		$el->created_unix = time();
		$el->type_id = 1;
		$el->name = $el_type_ar[1];
		$el->save();
		
		$ololo_time = time() - (60 * 60 * 24 * 30);
		
		$res = Advert::where('created_unix', '<', $ololo_time)->where('ololo_for_ololo_very_important_note_delete', 0)->get();
		foreach ($res as  $ad){
			$ad->sendLetterRemenderForRenew();
		}
		
		$ololo_time = time() - (60 * 60 * 24 * 30 * 2);

		$res = Advert::where('created_unix', '<', $ololo_time)->where('ololo_for_ololo_very_important_note_delete', 1)->get();
		foreach ($res as  $ad){
            $ad->sendLetterRemenderForRenew();
		}

        $ololo_time = time() - (60 * 60 * 24 * 30 * 3);

        $res = Advert::where('created_unix', '<', $ololo_time)->where('ololo_for_ololo_very_important_note_delete', 1)->get();
        foreach ($res as  $ad){
            $ad->delete();
        }
		
		return true;
		
		
	}
	
	static function checkCompanyOnlainIndex () {
		$time = time() - (59 * 60 * 24);
		$ololo_value = static::where('type_id', 2)->where('created_unix', '>', $time)->count();
		if ($ololo_value > 0)
			return true;
			
		$el_type_ar = static::getStandartTask();
		
		$el = new CronTask();
		$el->created_unix = time();
		$el->type_id = 2;
		$el->name = $el_type_ar[2];
		$el->save();
		
		$companies = Company::where('id', '>', 0)->get();
		foreach ($companies as $company) {
			$total = UserOnlianStat::where('user_id', $company->user_id)->where('is_close', 1)->sum('duration');
			$company->onlain_index = round($total /(60 * 60));
			$company->save();
		}
		
		return true;
			
	}
	
	static function checkPayAdvert () {
		$time = time() - (59 * 60);
		$ololo_value = static::where('type_id', 3)->where('created_unix', '>', $time)->count();
		if ($ololo_value > 0)
			return true;
			
		$el_type_ar = static::getStandartTask();
		
		$el = new CronTask();
		$el->created_unix = time();
		$el->type_id = 3;
		$el->name = $el_type_ar[3];
		$el->save();
		
		$time = time();
		
		$elems = AdvertPay::where('is_close', 0)->get();
		foreach ($elems as $el) {
			$advert = $el->relAdvert; 
			if (!$advert)
				continue;
				
			if ($el->type_id == 5){
				
				
				if ($advert->is_vip_counter < 0){
					$advert->vip = 0;
					$advert->save();
					
					$el->is_close = 1;
					$el->save();
				}
					
				
				continue;
			}
				
			
			if ($el->deleted_unix > $time)
				continue;
			
			$advert = $el->relAdvert;
			
			if ($el->type_id == 1){
				$advert->is_green = 0;
			}
			
			if ($el->type_id == 2){
				$advert->is_sale = 0;
			}
			
			if ($el->type_id == 3){
				$advert->hot_price = 0;
			}
			
			if ($el->type_id == 4){
				$advert->urgent = 0;
			}
			
			$advert->save();
			
			$el->is_close = 1;
			$el->save();
		}
		
		return true;
	}
}
