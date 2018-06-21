<?php
class BannerController extends BaseController {

    function getIndex () {
		$ar = array();
		$ar['title'] = 'Banners';
        $ar['items'] = SysAdBannerPartners::orderBy('id','desc')->paginate(25);	
		$ar['wish_date'] = SysAdBannerPartners::getWishDate();
		$ar['wish_day'] = ModelSnipet::formatDate($ar['wish_date'], 'd');
		$ar['wish_month'] = ModelSnipet::formatDate($ar['wish_date'], 'm');
		$ar['wish_year'] = ModelSnipet::formatDate($ar['wish_date'], 'Y');
		
		//echo $ar['wish_date']; exit();
		

        return View::make('front.advert-us.index', $ar);
    }

    function postItem () {

        $bann = new SysAdBannerPartners();

        $bann->name = Input::get('name');
        $bann->location = Input::get('location');
        $bann->contact = Input::get('contact');
        
        $bann->recipient = Input::get('recipient');

        $bann->email = Input::get('email');
        $bann->person = Input::get('person');
        $bann->days = Input::get('days');
		$bann->days = Input::get('days');

		if (Input::hasFile('license'))
			$bann->license = ModelSnipet::setImage(Input::file('license'), 'images', 'large');
		if (Input::hasFile('banner'))
			$bann->banner = ModelSnipet::setImage(Input::file('banner'), 'images', 'large');
		$bann->save();
		
		
        if (!$bann->save())
           return Redirect::back()->withErrors($bann->getErrors());

       	$email_to = "yeldos.sdu@gmail.com";
    	MailSend::sendBannerEmail($bann);   	
       
		return Redirect::action('BannerController@getIndex');
    }

    function postBannerMessage(){
    	
    	$email = "yeldos.sdu@gmail.com";
    
		MailSend::sendBanner($email);
		
		return Redirect::back()->with('success', 'Banner message has been sent');
    }

}
